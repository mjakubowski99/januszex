import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {CustomMessageService} from './custom-message.service';
import {Observable} from 'rxjs';
import {ChangePasswordFormData} from '../models/change-password-form-data';
import {Converter} from './converter';
import {environment} from '../../environments/environment';
import {tap} from 'rxjs/operators';
import {AddressFormData} from '../models/address-form-data';

@Injectable({
  providedIn: 'root'
})
export class AccountService {


  constructor(private http: HttpClient, private router: Router, private messageService: CustomMessageService) {
  }

  public changePassword(changePasswordFormData: ChangePasswordFormData): Observable<any> {
    const formData = Converter.objectToFormData(changePasswordFormData);
    return this.http.post(`${environment.api}changePassword`, formData).pipe(
      tap(resData => {
        this.messageService.pushInfoMessage('', resData.message);
      })
    );
  }

  public getAddressData(): Observable<any> {
    return this.http.get(`${environment.api}userAddress`).pipe(
      tap(resData => {
        console.log(resData);
      })
    );
  }


  public changeAddressData(addressFormData: AddressFormData): Observable<any> {
    const formData = Converter.objectToFormData(addressFormData);
    return this.http.post(`${environment.api}changeAddress`, formData).pipe(
      tap(resData => {
        console.log(resData);
      })
    );
  }

  public getOrders(): Observable<any> {
    return this.http.get(`${environment.api}userOrders`).pipe(
      tap(resData => {
        console.log(resData);
      })
    );
  }
}
