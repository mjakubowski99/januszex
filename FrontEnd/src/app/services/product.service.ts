import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {CustomMessageService} from './custom-message.service';
import {Observable} from 'rxjs';
import {environment} from '../../environments/environment';
import {Product} from '../models/product';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  constructor(private http: HttpClient, private messageService: CustomMessageService) {
  }

  getProduct(id: number): Observable<any> {
    return this.http.get(`${environment.api}products/${id}`);
  }

  getProducts(): Observable<any> {
    return this.http.post<Product[]>(`${environment.api}/products`, null);
  }
}
