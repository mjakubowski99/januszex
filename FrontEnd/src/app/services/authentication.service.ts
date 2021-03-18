import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Converter} from './converter';
import {RegistrationFormData} from '../models/registration-form-data';
import {LoginFormData} from '../models/login-form-data';
import {BehaviorSubject, Observable} from 'rxjs';
import {UserData} from '../models/user-data';
import { environment } from './../../environments/environment';
import {tap} from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  user = new BehaviorSubject<UserData>(null);

  constructor(private http: HttpClient) {
  }

  register(registrationFormData: RegistrationFormData): Observable<any> {
    const formData = Converter.objectToFormData(registrationFormData);
    return this.http.post(`${environment.api}register`, formData);
  }

  login(loginFormData: LoginFormData): Observable<any> {
    const formData = Converter.objectToFormData(loginFormData);
    return this.http.post(`${environment.api}login`, formData).pipe(
      tap(resData => {
        this.user.next(new UserData(resData.jwt_token));
      })
    );
  }
}
