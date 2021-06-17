import { Injectable } from '@angular/core';
import {
  CanActivate,
  CanDeactivate,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
  UrlTree,
  Router
} from '@angular/router';
import { Observable } from 'rxjs';
import {AuthenticationService} from '../services/authentication.service';
import {map, tap} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate, CanDeactivate<unknown> {
  constructor(private authenticationService: AuthenticationService, private router: Router) {
  }

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this.authenticationService.user$.pipe(
      map(user => !user),
      tap(isAccessAllowed => {
        if (!isAccessAllowed) {
          this.router.navigate(['/home']);
          console.warn('AuthenticationGuard: cannot active');
        }
      })
    );
  }
  canDeactivate(
    component: unknown,
    currentRoute: ActivatedRouteSnapshot,
    currentState: RouterStateSnapshot,
    nextState?: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this.authenticationService.user$.pipe(
      map(user => !!user),
      tap(isAccessAllowed => {
        if (!isAccessAllowed) {
          console.warn('AuthenticationGuard: cannot deactivate');
        }
      })
    );
  }

}
