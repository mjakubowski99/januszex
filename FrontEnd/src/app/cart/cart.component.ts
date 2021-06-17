import {Component, OnInit} from '@angular/core';
import {CartService} from '../services/cart.service';
import {CartItem} from '../models/cart-item';
import {Product} from '../models/product';
import {BuyService} from '../services/buy.service';
import {BuyItem} from '../models/buy-item';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.scss']
})
export class CartComponent implements OnInit {
  cartItems: CartItem[];

  constructor(private cartService: CartService, private buyService: BuyService) {
  }

  ngOnInit(): void {
    this.cartItems = this.cartService.getAllProducts();
  }

  public onDeleteItem(product: Product): void {
    this.cartService.deleteItem(product);
    this.cartItems = this.cartService.getAllProducts();
  }

  public onBuyNow(): void {
    const buyItems: BuyItem[] = this.cartItems.map( x => ({
      id: x.product.id,
      quantity: x.quantity,
    }));

    this.buyService.buyCard(buyItems);
  }

  public fullAmount(): number {
    let result = 0;
    this.cartItems.forEach(x => {
      result += x.quantity * x.product.price;
    });
    return result;
  }
}
