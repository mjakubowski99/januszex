import {Component, OnInit} from '@angular/core';
import {Product} from '../../models/product';
import {ActivatedRoute, Router} from '@angular/router';
import {ProductService} from '../../services/product.service';
import {CartService} from '../../services/cart.service';
import {BuyService} from '../../services/buy.service';
import {BuyItem} from '../../models/buy-item';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.scss']
})
export class ProductDetailComponent implements OnInit {
  currentProduct: Product;

  constructor(private router: Router, private activatedRoute: ActivatedRoute, private bookService: ProductService, private cartService: CartService, private buyService: BuyService) {
  }

  ngOnInit(): void {
    const snapshot = this.activatedRoute.snapshot;
    const productId = snapshot.params.id;
    this.getProduct(productId);
  }

  public getProduct(productId: number): void {
    this.bookService.getProduct(productId).subscribe(response => {
      this.currentProduct = {
        id: +response.ID,
        name: response.product_name,
        category: response.category,
        subcategory: response.subcategory,
        price: +response.price,
        description: response.description,
        photoPath: response.photo_path,
        quantity: +response.quantity
      };
    });
  }

  public onAddToCart(value: number): void {
    this.cartService.addItem(this.currentProduct, value);
  }

  public onBuy(value: number): void {
    const buyItems: BuyItem[] = [
      {
        id: this.currentProduct.id,
        quantity: value,
      }
    ];
    this.buyService.buyCard(buyItems);
  }
}
