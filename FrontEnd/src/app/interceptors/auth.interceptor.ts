import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor, HttpHeaders
} from '@angular/common/http';

import { take, exhaustMap } from 'rxjs/operators';
import { Observable } from 'rxjs';
import {AuthenticationService} from '../services/authentication.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {

  constructor(private authenticationService: AuthenticationService) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    return this.authenticationService.user$.pipe(
      take(1),
      exhaustMap(user => {
        if (!user) {
          return next.handle(request);
        }
        const modifiedReq = request.clone({
          headers: new HttpHeaders().append('Authorization', `Bearer ${user.token}`)
        });
        return next.handle(modifiedReq);
      })
    );
  }
}
