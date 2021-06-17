import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrls: ['./categories-list.component.scss']
})
export class CategoriesListComponent implements OnInit {

  categories: { categoryName: string, iconClass: string}[] = [
    {categoryName: 'Obudowa', iconClass: 'case-icon'},
    {categoryName: 'Chłodzenie', iconClass: 'cooling-fan-icon'},
    {categoryName: 'Procesor', iconClass: 'cpu-processor-icon'},
    // {categoryName: 'Stacje dysków', iconClass: 'dvd-icon', routerLink: '#'},
    {categoryName: 'Karta graficzna', iconClass: 'graphics-card-icon'},
    {categoryName: 'Dysk twardy', iconClass: 'hard-drive-icon'},
    {categoryName: 'Monitor', iconClass: 'monitor-icon'},
    {categoryName: 'Płyta główna', iconClass: 'motherboard-icon'},
    {categoryName: 'Zasilacz', iconClass: 'psu-icon'},
    {categoryName: 'Pamięć Ram', iconClass: 'ram-icon'},
  ];

  constructor(private router: Router) {
  }

  ngOnInit(): void {
  }

  public onClick(categoryName: string): void {
    this.router.navigate(['/products'], {
      queryParams: {
        category: categoryName
      },
      queryParamsHandling: 'merge',
    });
  }
}
