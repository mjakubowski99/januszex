import {Component, OnInit} from '@angular/core';
import {AccountService} from '../../services/account.service';
import {Order} from '../../models/order';
import {ChangePasswordFormData} from '../../models/change-password-form-data';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-account-orders-list',
  templateUrl: './account-orders-list.component.html',
  styleUrls: ['./account-orders-list.component.scss']
})
export class AccountOrdersListComponent implements OnInit {
  orders: Order[] = [];

  constructor(private accountService: AccountService, private route: ActivatedRoute) {
  }

  ngOnInit(): void {
    const resOrders = this.route.snapshot.data.accountGetOrders;

    if (resOrders.message === 'No orders for this user') {
      return;
    }
    this.orders = resOrders.map(resOrder => ({
      orderId: resOrder.order_id,
      date: new Date(resOrder.order_date),
      price: resOrder.price,
      status: resOrder.status
    }));
  }
}
