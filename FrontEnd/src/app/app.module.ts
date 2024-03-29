import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';

import {AppRoutingModule} from './app-routing.module';

import {AppComponent} from './app.component';

import {HeaderComponent} from './header/header.component';

import {AccountPanelPageComponent} from './account-panel-page/account-panel-page.component';
import {AccountPanelNaviagtionBarComponent} from './account-panel-page/account-panel-naviagtion-bar/account-panel-naviagtion-bar.component';
import {AccountOrdersListComponent} from './account-panel-page/account-orders-list/account-orders-list.component';
import {AccountOrderDetailsComponent} from './account-panel-page/account-order-details/account-order-details.component';
import {AccountChangePasswordFormComponent} from './account-panel-page/account-change-password-form/account-change-password-form.component';
import {AccountAddressDataComponent} from './account-panel-page/account-address-data/account-address-data.component';

import {AdminPanelNaviagtionBarComponent} from './admin-panel-page/admin-panel-naviagtion-bar/admin-panel-naviagtion-bar.component';
import {AdminProductsComponent} from './admin-panel-page/admin-products/admin-products.component';
import {AdminOrdersComponent} from './admin-panel-page/admin-orders/admin-orders.component';
import {AdminCustomersComponent} from './admin-panel-page/admin-customers/admin-customers.component';
import {AdminErrorsComponent} from './admin-panel-page/admin-errors/admin-errors.component';
import {AdminPanelPageComponent} from './admin-panel-page/admin-panel-page.component';

import {AuthenticationPageComponent} from './authentication-page/authentication-page.component';
import {LoginFormComponent} from './authentication-page/login-form/login-form.component';
import {RegistrationFormComponent} from './authentication-page/registration-form/registration-form.component';
import {RegistrationConfirmEmailFormComponent} from './authentication-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authentication-page/registration-confirmation/registration-confirmation.component';
import {ResetPasswordEmailFormComponent} from './authentication-page/reset-password-email-form/reset-password-email-form.component';
import {ResetPasswordConfirmationComponent} from './authentication-page/reset-password-confirmation/reset-password-confirmation.component';

import {HomePageComponent} from './home-page/home-page.component';
import {CategoriesListComponent} from './home-page/categories-list/categories-list.component';
import {RecommendedProductsListComponent} from './home-page/recommended-products-list/recommended-products-list.component';
import {RecommendedProductItemComponent} from './home-page/recommended-products-list/recommended-product-item/recommended-product-item.component';

import {CartComponent} from './cart/cart.component';

import {AuthInterceptor} from './interceptors/auth.interceptor';
import {CustomMessageService} from './services/custom-message.service';

import {NgxErrorsModule} from '@hackages/ngxerrors';

import {ButtonModule} from 'primeng/button';
import {InputTextModule} from 'primeng/inputtext';
import {TableModule} from 'primeng/table';
import {MessageService} from 'primeng/api';
import {ToastModule} from 'primeng/toast';
import {DropdownModule} from 'primeng/dropdown';
import {CheckboxModule} from 'primeng/checkbox';

import {AdminProductsListComponent} from './admin-panel-page/admin-products/admin-products-list/admin-products-list.component';
import {AdminProductsEditComponent} from './admin-panel-page/admin-products/admin-products-edit/admin-products-edit.component';
import {AdminProductsAddComponent} from './admin-panel-page/admin-products/admin-products-add/admin-products-add.component';
import {MenubarModule} from 'primeng/menubar';
import {DataViewModule} from 'primeng/dataview';
import {InputTextareaModule} from 'primeng/inputtextarea';
import {AdminOrderDetailsComponent} from './admin-panel-page/admin-order-details/admin-order-details.component';
import {ProductDetailComponent} from './products/product-detail/product-detail.component';
import {ProductsListComponent} from './products/products-list/products-list.component';
import {InputNumberModule} from 'primeng/inputnumber';
import { OrderCheckerComponent } from './order-checker/order-checker.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    HomePageComponent,
    CategoriesListComponent,
    RecommendedProductsListComponent,
    RecommendedProductItemComponent,
    AuthenticationPageComponent,
    CartComponent,
    LoginFormComponent,
    RegistrationFormComponent,
    RegistrationConfirmEmailFormComponent,
    RegistrationConfirmationComponent,
    ResetPasswordEmailFormComponent,
    ResetPasswordConfirmationComponent,
    AdminPanelPageComponent,
    AccountPanelPageComponent,
    AccountPanelNaviagtionBarComponent,
    AccountOrdersListComponent,
    AccountOrderDetailsComponent,
    AccountChangePasswordFormComponent,
    AccountAddressDataComponent,
    AdminPanelNaviagtionBarComponent,
    AdminProductsComponent,
    AdminOrdersComponent,
    AdminCustomersComponent,
    AdminErrorsComponent,
    AdminProductsListComponent,
    AdminProductsEditComponent,
    AdminProductsAddComponent,
    AdminOrderDetailsComponent,
    ProductDetailComponent,
    ProductsListComponent,
    OrderCheckerComponent
  ],
  imports: [
    BrowserModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    ButtonModule,
    InputTextModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    TableModule,
    NgxErrorsModule,
    ToastModule,
    DropdownModule,
    MenubarModule,
    DataViewModule,
    InputTextareaModule,
    InputNumberModule,
    CheckboxModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true
    },
    MessageService,
    CustomMessageService
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}
