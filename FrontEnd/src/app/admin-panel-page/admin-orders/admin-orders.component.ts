import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-admin-orders',
  templateUrl: './admin-orders.component.html',
  styleUrls: ['./admin-orders.component.scss']
})
export class AdminOrdersComponent implements OnInit {
  orders: any;
  constructor() {
    this.orders = [
      {
        orderId: 4,
        customerId: 4,
        date: new Date(12321),
        price: 123.1,
        status: 'xxxxxxx',
      },
      {
        orderId: 1,
        customerId: 4,
        date: new Date(12421412214),
        price: 11123.1,
        status: 'Zrealizowane',
      },
      {
        orderId: 2,
        customerId: 4,
        date: new Date(),
        price: 999.1,
        status: 'Anulowane',
      },
      {
        orderId: 3,
        customerId: 4,
        date: new Date(),
        price: 12414.1,
        status: 'Weryfikacja płatności',
      },
    ];
  }

  ngOnInit(): void {
  }

}
