import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Converter} from './converter';
import {RegistrationFormData} from '../models/registration-form-data';
import {LoginFormData} from '../models/login-form-data';
import {BehaviorSubject, Observable} from 'rxjs';
import {UserData} from '../models/user-data';
import {environment} from './../../environments/environment';
import {tap} from 'rxjs/operators';
import jwtDecode from 'jwt-decode';


@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  user = new BehaviorSubject<UserData>(null);
  private tokenExpirationTimer: any;

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
        const token = resData.jwt_token;
        const decodeToken = jwtDecode<any>(token);
        // this.handleAuthentication(decodeToken.email, token, decodeToken.exp - decodeToken.iat);
        this.handleAuthentication(decodeToken.email, token, new Date(decodeToken.exp * 1000));
      })
    );
  }

  private handleAuthentication(
    email: string,
    token: string,
    expirationDate: Date
  ): void {
    const user = new UserData(email, token, expirationDate);
    this.user.next(user);
    this.autoLogout(expirationDate.getTime() - new Date().getTime());
    localStorage.setItem('userData', JSON.stringify(user));
  }

  // private handleAuthentication(
  //   email: string,
  //   token: string,
  //   expiresIn: number
  // ): void {
  //   const expirationDate = new Date(new Date().getTime() + expiresIn * 1000);
  //   const user = new UserData(email, token, expirationDate);
  //   this.user.next(user);
  //   this.autoLogout(expiresIn * 1000);
  //   localStorage.setItem('userData', JSON.stringify(user));
  // }

  autoLogin(): void {
    const userData: {
      email: string;
      _token: string;
      _tokenExpirationDate: string;
    } = JSON.parse(localStorage.getItem('userData'));
    if (!userData) {
      console.log('Brak danych potrzebnych do zalogowania w localStorage');
      return;
    }

    const loadedUser = new UserData(
      userData.email,
      userData._token,
      new Date(userData._tokenExpirationDate)
    );

    if (loadedUser.token) {
      console.log('Zalogowano automatycznie na podstawie localStorage');
      this.user.next(loadedUser);
      const expirationDuration = new Date(userData._tokenExpirationDate).getTime() - new Date().getTime();
      this.autoLogout(expirationDuration);
    } else {
      console.log('dane użytkownika w localStorage nie są już ważne');
    }
  }


  public logout(): void {
    console.log('Wylogowanie');
    this.user.next(null);
    // this.router.navigate(['/auth']);
    localStorage.removeItem('userData');
    if (this.tokenExpirationTimer) {
      clearTimeout(this.tokenExpirationTimer);
    }
    this.tokenExpirationTimer = null;
  }

  private autoLogout(expirationDuration: number): void {
    this.tokenExpirationTimer = setTimeout(() => {
      console.log('Automatyczne wywołanie wylogowania');
      this.logout();
    }, expirationDuration);
  }
}
