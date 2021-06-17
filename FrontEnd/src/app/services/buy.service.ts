import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {BuyItem} from '../models/buy-item';
import {environment} from './../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class BuyService {

  constructor(private http: HttpClient) {
  }

  buyCard(buyItems: BuyItem[]): void {
    const headerDict = {
      'Access-Control-Allow-Headers': '*',
    };
    this.http.post(`${environment.api}payu/create/order`, {products : buyItems}, {headers: headerDict}).subscribe((x: any) => {
      window.location.href = x.message;
    });
  }
}
