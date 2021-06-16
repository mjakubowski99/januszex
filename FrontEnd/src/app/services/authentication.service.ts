import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Converter} from './converter';
import {RegistrationFormData} from '../models/registration-form-data';
import {LoginFormData} from '../models/login-form-data';
import {BehaviorSubject, Observable, of} from 'rxjs';
import {UserData} from '../models/user-data';
import {environment} from './../../environments/environment';
import {mergeMap, tap} from 'rxjs/operators';
import jwtDecode from 'jwt-decode';
import {Router} from '@angular/router';
import {CustomMessageService} from './custom-message.service';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  user$ = new BehaviorSubject<UserData>(null);
  private tokenExpirationTimer: any;

  constructor(private http: HttpClient, private router: Router, private messageService: CustomMessageService) {
  }

  register(registrationFormData: RegistrationFormData): Observable<any> {
    const formData = Converter.objectToFormData(registrationFormData);
    return this.http.post(`${environment.api}register`, formData).pipe(
      mergeMap((resData: any) => {
        console.log(resData);
        if (resData.message === 'Rejestracja powiodla sie. Sprawdz podany adres e-mail w celu aktywacji konta') {
          const loginFormData: LoginFormData = {
            email: registrationFormData.email,
            password: registrationFormData.password
          };
          return this.login(loginFormData).pipe(
            tap(response => {
              console.log(response);
              this.router.navigate(['/authentication/registration/confirmEmail']);
            })
          );
        } else {
          this.messageService.pushErrorMessage('Błąd', resData.error_message);
          return of(resData);
        }
      })
    );
  }

  login(loginFormData: LoginFormData): Observable<any> {
    const formData = Converter.objectToFormData(loginFormData);
    return this.http.post(`${environment.api}login`, formData).pipe(
      tap(resData => {
        console.log(resData);
        if (!resData.jwt_token) {
          this.messageService.pushErrorMessage('Błąd', resData.message);
          return;
        }
        const token = resData.jwt_token;
        const decodedToken = jwtDecode<any>(token);
        console.log(decodedToken);
        this.handleAuthentication(decodedToken.email, token, new Date(decodedToken.exp * 1000));

        this.router.navigate(['/home']);
      })
    );
  }

  private handleAuthentication(
    email: string,
    token: string,
    expirationDate: Date
  ): void {
    const user = new UserData(email, token, expirationDate);
    this.user$.next(user);
    this.autoLogout(expirationDate.getTime() - new Date().getTime());
    localStorage.setItem('userData', JSON.stringify(user));
  }

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
      this.user$.next(loadedUser);
      const expirationDuration = new Date(userData._tokenExpirationDate).getTime() - new Date().getTime();
      this.autoLogout(expirationDuration);
    } else {
      console.log('dane użytkownika w localStorage nie są już ważne');
    }
  }


  public logout(): void {
    console.log('Wylogowanie');
    this.user$.next(null);
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

  public resendEmailCode(): Observable<any> {
    return this.http.post(`${environment.api}resendVerification`, '').pipe(
      tap(resData => {
        this.messageService.pushInfoMessage('', resData.message);
      })
    );
  }

  public confirmEmail(confirmEmailCode: string): Observable<any> {
    const confirmEmailCodeInForm = new FormData();
    confirmEmailCodeInForm.append('token', confirmEmailCode);
    return this.http.post(`${environment.api}registerVerify`, confirmEmailCodeInForm).pipe(
      tap(resData => {
        console.log(resData);
        if (resData.message === 'Successful') {
          this.messageService.pushSuccessMessage('Sukces', 'Pomyślnie zweryfikowano adres email!');
          this.router.navigate(['/authentication/registration/confirmation']);
        }else{
          this.messageService.pushErrorMessage('Błąd', resData.message);
        }
      })
    );
  }

  public resetPassword(email: string): Observable<any> {
    const emailFormData = new FormData();
    emailFormData.append('email', email);
    return this.http.post(`${environment.api}resetPassword`, emailFormData).pipe(
      tap(resData => {
        this.messageService.pushInfoMessage('', resData);
      })
    );
  }
}
