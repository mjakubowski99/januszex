import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {ButtonModule} from 'primeng/button';
import {InputTextModule} from 'primeng/inputtext';
import { HttpClientModule } from '@angular/common/http';


import {HeaderComponent} from './header/header.component';

import {HomePageComponent} from './home-page/home-page.component';
import {CategoriesListComponent} from './home-page/categories-list/categories-list.component';
import {RecommendedProductsListComponent} from './home-page/recommended-products-list/recommended-products-list.component';
import {RecommendedProductItemComponent} from './home-page/recommended-products-list/recommended-product-item/recommended-product-item.component';

import {AuthorizationPageComponent} from './authentication-page/authorization-page.component';

import {CartComponent} from './cart/cart.component';
import {LoginFormComponent} from './authentication-page/login-form/login-form.component';
import {RegistrationFormComponent} from './authentication-page/registration-form/registration-form.component';
import {RegistrationConfirmEmailFormComponent} from './authentication-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authentication-page/registration-confirmation/registration-confirmation.component';
import {ResetPasswordEmailFormComponent} from './authentication-page/reset-password-email-form/reset-password-email-form.component';
import {ResetPasswordConfirmEmailFormComponent} from './authentication-page/reset-password-confirm-email-form/reset-password-confirm-email-form.component';
import {ResetPasswordNewPasswordFormComponent} from './authentication-page/reset-password-new-password-form/reset-password-new-password-form.component';
import {ResetPasswordConfirmationComponent} from './authentication-page/reset-password-confirmation/reset-password-confirmation.component';
import {AdminPageComponent} from './admin-page/admin-page.component';
import {ErrorsComponent} from './admin-page/errors/errors.component';


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
    ResetPasswordConfirmationComponent,
    AdminPageComponent,
    ErrorsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ButtonModule,
    InputTextModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
}
