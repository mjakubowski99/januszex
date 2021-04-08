import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from './services/authentication.service';
import {HttpClient} from '@angular/common/http';
import {environment} from './../environments/environment';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  constructor(private authenticationService: AuthenticationService, private http: HttpClient) {
  }

  public ngOnInit(): void {

    setInterval(() => {
      this.pingApi();
    }, 60 * 1000);

    this.authenticationService.autoLogin();
    if (this.authenticationService.user$.value) {
      console.log('');
      console.log('');
      console.log('');
      console.log(this.authenticationService.user$.value.email);
      console.log(this.authenticationService.user$.value.token);
      console.log('');
      console.log('');
      console.log('');
    }
  }

  pingApi(): void {
    this.http.get(environment.api).subscribe();
  }
}
