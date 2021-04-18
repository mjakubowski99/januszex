import {Component, OnInit} from '@angular/core';
import {AdminService} from '../../services/admin.service';

@Component({
  selector: 'app-admin-customers',
  templateUrl: './admin-customers.component.html',
  styleUrls: ['./admin-customers.component.scss']
})
export class AdminCustomersComponent implements OnInit {
  customers: any[] = [];

  constructor(private adminService: AdminService) {
  }

  ngOnInit(): void {
    this.adminService.getUsers().subscribe((response: any) => {
      this.customers = response.map(resCustomers => ({
        id: resCustomers.ID,
        name: resCustomers.name,
        surname: resCustomers.surname,
        email: resCustomers.email
      }));
    });
  }

}
