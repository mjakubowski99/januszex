import {Component, OnInit} from '@angular/core';
import {AdminService} from '../../services/admin.service';

@Component({
  selector: 'app-admin-orders',
  templateUrl: './admin-orders.component.html',
  styleUrls: ['./admin-orders.component.scss']
})
export class AdminOrdersComponent implements OnInit {
  orders: any = [];

  constructor(private adminService: AdminService) {
  }

  ngOnInit(): void {
    this.adminService.getOrders().subscribe((response: any[]) => {
      this.orders = response.map(resOrders => ({
        orderId: +resOrders.ID,
        customerId: +resOrders.user_id,
        date: new Date(resOrders.order_date),
        price: resOrders.full_amount,
        status: resOrders.status
      }));
    });
  }

}
