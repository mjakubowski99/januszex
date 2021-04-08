import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-admin-errors',
  templateUrl: './admin-errors.component.html',
  styleUrls: ['./admin-errors.component.scss']
})
export class AdminErrorsComponent implements OnInit {

  errors: any;
  constructor() {
    this.errors = [
      {
        errorId: 3,
        userId: 3,
        errorMessage: 'Nic nie działa kurła!!!!'
      },
      {
        errorId: 1,
        userId: null,
        errorMessage: 'Przecioż tu nic nie ma!! kurłaaaa Pioter idziem na ryby!!!!'
      },
      {
        errorId: 2,
        userId: null,
        errorMessage: 'Tylko ten formularz dzała poprawnie kurłaaa!!!!'
      },
    ];
  }

  ngOnInit(): void {
  }

}
