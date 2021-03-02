import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-recommended-products-list',
  templateUrl: './recommended-products-list.component.html',
  styleUrls: ['./recommended-products-list.component.scss']
})
export class RecommendedProductsListComponent implements OnInit {

  recommendedProducts: { name: string, imagePath: string, price: number, routerLink: string }[] = [
    {
      name: 'Kingston 500GB M.2 PCIe NVMe A2000',
      imagePath: 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2019/8/pr_2019_8_9_13_42_46_312_02.jpg',
      price: 299.00,
      routerLink: '#'
    },
    {
      name: 'Patriot 16GB (2x8GB) 3200MHz CL16 Viper 4 Blackout',
      imagePath: 'https://cdn.x-kom.pl/i/setup/images/prod/big/product-new-big,,2019/8/pr_2019_8_29_9_49_41_592_00.jpg',
      price: 259.00,
      routerLink: '#'
    },
    {
      name: 'be quiet! Pure Loop 280mm 2x140mm',
      imagePath: 'http://www.guru3d.com/index.php?ct=articles&action=file&id=25578&admin=0a8fcaad6b03da6a6895d1ada2e171002a287bc1',
      price: 459.00,
      routerLink: '#'
    }
  ];

  constructor() {
  }

  ngOnInit(): void {
  }

}
