import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {ButtonModule} from 'primeng/button';
import {InputTextModule} from 'primeng/inputtext';


import {HeaderComponent} from './header/header.component';

import {HomePageComponent} from './home-page/home-page.component';
import {CategoriesListComponent} from './home-page/categories-list/categories-list.component';
import {RecommendedProductsListComponent} from './home-page/recommended-products-list/recommended-products-list.component';
import {RecommendedProductItemComponent} from './home-page/recommended-products-list/recommended-product-item/recommended-product-item.component';

import {AuthorizationPageComponent} from './authorization-page/authorization-page.component';

import {CartComponent} from './cart/cart.component';
import {LoginFormComponent} from './authorization-page/login-form/login-form.component';
import {RegistrationFormComponent} from './authorization-page/registration-form/registration-form.component';
import {RegistrationConfirmEmailFormComponent} from './authorization-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authorization-page/registration-confirmation/registration-confirmation.component';
import { ResetPasswordEmailFormComponent } from './authorization-page/reset-password-email-form/reset-password-email-form.component';
import { ResetPasswordConfirmEmailFormComponent } from './authorization-page/reset-password-confirm-email-form/reset-password-confirm-email-form.component';
import { ResetPasswordNewPasswordFormComponent } from './authorization-page/reset-password-new-password-form/reset-password-new-password-form.component';
import { ResetPasswordConfirmationComponent } from './authorization-page/reset-password-confirmation/reset-password-confirmation.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    HomePageComponent,
    CategoriesListComponent,
    RecommendedProductsListComponent,
    RecommendedProductItemComponent,
    AuthorizationPageComponent,
    CartComponent,
    LoginFormComponent,
    RegistrationFormComponent,
    RegistrationConfirmEmailFormComponent,
    RegistrationConfirmationComponent,
    ResetPasswordEmailFormComponent,
    ResetPasswordConfirmEmailFormComponent,
    ResetPasswordNewPasswordFormComponent,
    ResetPasswordConfirmationComponent
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
