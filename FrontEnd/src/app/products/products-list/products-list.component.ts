import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {Product} from '../../models/product';
import {ProductService} from '../../services/product.service';

@Component({
  selector: 'app-products-list',
  templateUrl: './products-list.component.html',
  styleUrls: ['./products-list.component.scss']
})
export class ProductsListComponent implements OnInit {
  allProducts: Product[] = [];
  productsAfterFilter: Product[] = [];

  constructor(private bookService: ProductService, private activatedRoute: ActivatedRoute) {
  }

  public ngOnInit(): void {

    this.bookService.getProducts().subscribe(productsResponse => {
      this.allProducts = productsResponse.map(productResponse => ({
        id: productResponse.ID,
        name: productResponse.product_name,
        description: productResponse.description,
        price: productResponse.price,
        quantity: productResponse.quantity,
        photoPath: productResponse.photo_path,
        category: productResponse.category,
        subcategory: productResponse.subcategory
      }));
      this.activatedRoute.queryParams.subscribe(x => {
        const searchValue: string = x.searchValue ?? '';
        const category: string = x.category ?? '';
        this.productsAfterFilter = this.allProducts.filter(product => {
          return product.category.toUpperCase().match(category.toUpperCase()) && product.name.toUpperCase().match(searchValue.toUpperCase());
        });
      });
    });
  }
}
