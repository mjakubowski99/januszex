import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {ButtonModule} from 'primeng/button';
import {InputTextModule} from 'primeng/inputtext';



import { HeaderComponent } from './header/header.component';

import { HomePageComponent } from './home-page/home-page.component';
import { CategoriesListComponent } from './home-page/categories-list/categories-list.component';
import { RecommendedProductsListComponent } from './home-page/recommended-products-list/recommended-products-list.component';
import { RecommendedProductItemComponent } from './home-page/recommended-products-list/recommended-product-item/recommended-product-item.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    HomePageComponent,
    CategoriesListComponent,
    RecommendedProductsListComponent,
    RecommendedProductItemComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ButtonModule,
    InputTextModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
}
