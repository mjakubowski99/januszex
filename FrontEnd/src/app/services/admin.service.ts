import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {CustomMessageService} from './custom-message.service';
import {Observable} from 'rxjs';
import {environment} from '../../environments/environment';
import {ProductFormData} from '../models/product-form-data';
import {Converter} from './converter';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  constructor(private http: HttpClient, private messageService: CustomMessageService) {
  }

  getErrors(): Observable<any> {
    return this.http.post(`${environment.api}admin/errors`, '');
  }

  getUsers(): Observable<any> {
    return this.http.post(`${environment.api}admin/customers`, '');
  }

  getOrders(): Observable<any> {
    return this.http.post(`${environment.api}admin/orders`, '');
  }

  getOrderDetails(id: number): Observable<any> {
    const formData = new FormData();
    formData.append('orderId', id.toString());
    return this.http.post(`${environment.api}admin/orderdetails`, formData);
  }

  getProducts(): Observable<any> {
    const option = new FormData();
    option.append('option', 'List');
    return this.http.post(`${environment.api}admin/products`, option);
  }

  addProduct(productFormData: ProductFormData): Observable<any> {
    const formData = Converter.objectToFormData(productFormData);
    formData.append('option', 'Add');
    return this.http.post(`${environment.api}admin/products`, formData);
  }

  editProduct(id: number, productFormData: ProductFormData): Observable<any> {
    const formData = Converter.objectToFormData(productFormData);
    formData.append('option', 'Edit');
    formData.append('productID', id.toString());
    return this.http.post(`${environment.api}admin/products`, formData);
  }
}
