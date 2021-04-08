import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-admin-customers',
  templateUrl: './admin-customers.component.html',
  styleUrls: ['./admin-customers.component.scss']
})
export class AdminCustomersComponent implements OnInit {
  customers: any;
  constructor() {
    this.customers = [
      {
        id: 4,
        name: 'Piotr',
        surname: 'Korniak',
        email: 'pk@o2.pl'
      },
      {
        id: 1,
        name: 'Janusz',
        surname: 'Tracz',
        email: 'pogromcaSocjalistow@plebania.pl'
      },
      {
        id: 3,
        name: 'Mikołaj',
        surname: 'Xcioang',
        email: 'Mikołaj@o2.pl'
      }
    ];
  }

  ngOnInit(): void {
  }

}
