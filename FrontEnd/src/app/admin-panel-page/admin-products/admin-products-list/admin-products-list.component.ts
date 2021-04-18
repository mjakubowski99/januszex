import {Component, OnInit} from '@angular/core';
import {AdminService} from '../../../services/admin.service';
import {Product} from '../../../models/product';

@Component({
  selector: 'app-admin-products-list',
  templateUrl: './admin-products-list.component.html',
  styleUrls: ['./admin-products-list.component.scss']
})
export class AdminProductsListComponent implements OnInit {
  products: Product[] = [];
  constructor(private adminService: AdminService) {
  }

  ngOnInit(): void {
    this.adminService.getProducts().subscribe((response: any) => {
      this.products = response.map(resProducts => ({
        id: +resProducts.ID,
        name: resProducts.product_name,
        category: resProducts.category,
        subcategory: resProducts.subcategory,
        price: +resProducts.price,
        description: resProducts.description,
        photoPath: resProducts.photo_path,
        quantity: +resProducts.quantity
      }));
    });
  }
}
