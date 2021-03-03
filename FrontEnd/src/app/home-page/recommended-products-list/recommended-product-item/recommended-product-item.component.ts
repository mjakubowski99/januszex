import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-recommended-product-item',
  templateUrl: './recommended-product-item.component.html',
  styleUrls: ['./recommended-product-item.component.scss']
})
export class RecommendedProductItemComponent implements OnInit {
  @Input() properties: { name: string, imagePath: string, price: number, routerLink: string };

  constructor() { }

  ngOnInit(): void {
  }

}
