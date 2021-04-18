import {Component, OnInit} from '@angular/core';


interface Option {
  name: string;
  routeLink: string;
}

@Component({
  selector: 'app-admin-products',
  templateUrl: './admin-products.component.html',
  styleUrls: ['./admin-products.component.scss']
})
export class AdminProductsComponent implements OnInit {
  options: Option[];

  ngOnInit(): void {
    this.options = [
      {name: 'Lista produktów', routeLink: 'list'},
      {name: 'Dodaj produkt', routeLink: 'add'},
      {name: 'Edytuj produkt', routeLink: 'edit'}
    ];
  }


}
