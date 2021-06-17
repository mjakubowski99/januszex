import {Injectable} from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import {Router} from '@angular/router';
import {CustomMessageService} from './custom-message.service';
import {Observable, of} from 'rxjs';
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

  public getOrderDetails(orderId: number): Observable<any>  {
    const formData = new FormData();
    formData.append('orderId', orderId.toString());
    return this.http.post(`${environment.api}account/orderdetails`, formData);
  }
  public getLastOrder(): Observable<any>{
    return this.http.get(`${environment.api}last_order/retrieve`);
  }

  public updatePaymentStatus(payuOrderId: string): Observable<any>{
    let param = new HttpParams();
    param = param.append('order_id', payuOrderId);
    return this.http.get(`${environment.api}order/retrieve`, {params: param});
  }
}
