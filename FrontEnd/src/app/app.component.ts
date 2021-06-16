import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from './services/authentication.service';
import {HttpClient} from '@angular/common/http';
import {environment} from './../environments/environment';
import {NavigationCancel, NavigationEnd, NavigationError, NavigationStart, Router, RouterEvent} from '@angular/router';
import {filter, map, tap} from 'rxjs/operators';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  loading = true;

  constructor(private authenticationService: AuthenticationService, private http: HttpClient, private router: Router) {
    router.events.subscribe((routerEvent: RouterEvent) => {
      this.checkRouterEvent(routerEvent);
    });
  }

  public ngOnInit(): void {
    setInterval(() => {
      this.pingApi();
    }, 60 * 1000);
    this.authenticationService.autoLogin();
    this.testToken();
    this.onNavigationStarted(newRoute => console.log(`new route: ${newRoute}`));
  }

  private onNavigationStarted(callback: ((newRoute: string) => void)): void {
    this.router.events
      .pipe(
        filter((event) => event instanceof NavigationStart),
        map((event: NavigationStart) => event.url),
        tap(newRoute => callback.bind(this)(newRoute))
      )
      .subscribe();
  }

  checkRouterEvent(routerEvent: RouterEvent): void {
    if (routerEvent instanceof NavigationStart) {
      this.loading = true;
    }

    if (routerEvent instanceof NavigationEnd ||
      routerEvent instanceof NavigationCancel ||
      routerEvent instanceof NavigationError) {
      this.loading = false;
    }
  }

  pingApi(): void {
    this.http.get(environment.api).subscribe();
  }

  testToken(): void {
    if (this.authenticationService.user$.value) {
      console.log('');
      console.log(this.authenticationService.user$.value.email);
      console.log(this.authenticationService.user$.value.token);
      console.log('');
    }
  }
}
