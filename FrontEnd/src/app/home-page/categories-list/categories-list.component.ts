import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrls: ['./categories-list.component.scss']
})
export class CategoriesListComponent implements OnInit {

  categories: { categoryName: string, iconClass: string, routerLink: string }[] = [
    {categoryName: 'Obudowy', iconClass: 'case-icon', routerLink: '#'},
    {categoryName: 'Chłodzenia', iconClass: 'cooling-fan-icon', routerLink: '#'},
    {categoryName: 'Procesory', iconClass: 'cpu-processor-icon', routerLink: '#'},
    {categoryName: 'Stacje dysków', iconClass: 'dvd-icon', routerLink: '#'},
    {categoryName: 'Karty graficzne', iconClass: 'graphics-card-icon', routerLink: '#'},
    {categoryName: 'Dyski twarde', iconClass: 'hard-drive-icon', routerLink: '#'},
    {categoryName: 'Monitory', iconClass: 'monitor-icon', routerLink: '#'},
    {categoryName: 'Płyty główne', iconClass: 'motherboard-icon', routerLink: '#'},
    {categoryName: 'Zasilacze', iconClass: 'psu-icon', routerLink: '#'},
    {categoryName: 'Pamięć Ram', iconClass: 'ram-icon', routerLink: '#'},
  ];

  constructor() {
  }

  ngOnInit(): void {
  }

}
