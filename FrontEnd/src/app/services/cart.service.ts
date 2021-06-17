import {Injectable} from '@angular/core';
import {Product} from '../models/product';
import {CartItem} from '../models/cart-item';

@Injectable({
  providedIn: 'root'
})

export class CartService {
  cartItems: CartItem[] = [];

  constructor() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems'));
    if (cartItems) {
      this.cartItems = cartItems;
    }
  }

  addItem(product: Product, quantity: number): void {
    this.deleteItem(product);
    const newItem: CartItem = {product, quantity};
    this.cartItems.push(newItem);
    localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
  }

  deleteItem(product: Product): void {
    const index = this.cartItems.findIndex(x => x.product === product);
    if (index > -1) {
      this.cartItems.splice(index, 1);
    }
    localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
  }

  getAllProducts(): CartItem[] {
    return this.cartItems;
  }
}
