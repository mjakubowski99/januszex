import { Component, OnInit } from '@angular/core';
import {AdminService} from '../../services/admin.service';
import {ActivatedRoute} from '@angular/router';
import {AccountService} from '../../services/account.service';

@Component({
  selector: 'app-account-order-details',
  templateUrl: './account-order-details.component.html',
  styleUrls: ['./account-order-details.component.scss']
})
export class AccountOrderDetailsComponent implements OnInit {

  currentOrder: any;

  constructor(private accountService: AccountService, private activatedRoute: ActivatedRoute) {
  }

  ngOnInit(): void {
    const snapshot = this.activatedRoute.snapshot;
    const orderId = +snapshot.params.id;
    this.accountService.getOrderDetails(orderId).subscribe(response => {
      this.currentOrder = {
        id: +response.ID,
        orderData: new Date(response.order_date),
        userId: +response.user_id,
        status: response.status,
        fullAmount: +response.full_amount,
        address: {
          name: response.address[0].name,
          surname: response.address[0].surname,
          city: response.address[0].city,
          street: response.address[0].street,
          homeNumber: +response.address[0].home_number,
          flatNumber: +response.address[0].flat_number,
          postofficeCode: response.address[0].postoffice_code,
          postofficeCity: response.address[0].postoffice_city
        },
        products: response.products.map(product => ({
          productId: +product.product_id,
          productName: product.product_name,
          quantity: +product.quantity,
          price: +product.price
        }))
      };
    });
  }
}
