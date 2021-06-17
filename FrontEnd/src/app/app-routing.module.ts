import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {HomePageComponent} from './home-page/home-page.component';
import {AuthenticationPageComponent} from './authentication-page/authentication-page.component';
import {CartComponent} from './cart/cart.component';
import {RegistrationConfirmEmailFormComponent} from './authentication-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authentication-page/registration-confirmation/registration-confirmation.component';
import {ResetPasswordEmailFormComponent} from './authentication-page/reset-password-email-form/reset-password-email-form.component';
import {ResetPasswordConfirmationComponent} from './authentication-page/reset-password-confirmation/reset-password-confirmation.component';
import {AdminPanelPageComponent} from './admin-panel-page/admin-panel-page.component';
import {AccountPanelPageComponent} from './account-panel-page/account-panel-page.component';
import {AccountAddressDataComponent} from './account-panel-page/account-address-data/account-address-data.component';
import {AccountOrdersListComponent} from './account-panel-page/account-orders-list/account-orders-list.component';
import {AccountOrderDetailsComponent} from './account-panel-page/account-order-details/account-order-details.component';
import {AccountChangePasswordFormComponent} from './account-panel-page/account-change-password-form/account-change-password-form.component';
import {AdminProductsComponent} from './admin-panel-page/admin-products/admin-products.component';
import {AdminOrdersComponent} from './admin-panel-page/admin-orders/admin-orders.component';
import {AdminCustomersComponent} from './admin-panel-page/admin-customers/admin-customers.component';
import {AdminErrorsComponent} from './admin-panel-page/admin-errors/admin-errors.component';
import {AccountGetOrdersResolver} from './account-panel-page/account-orders-list/account-get-orders.resolver';
import {AccountGetAddressDataResolver} from './account-panel-page/account-address-data/account-get-address-data.resolver';
import {AdminProductsEditComponent} from './admin-panel-page/admin-products/admin-products-edit/admin-products-edit.component';
import {AdminProductsAddComponent} from './admin-panel-page/admin-products/admin-products-add/admin-products-add.component';
import {AdminProductsListComponent} from './admin-panel-page/admin-products/admin-products-list/admin-products-list.component';
import {AdminOrderDetailsComponent} from './admin-panel-page/admin-order-details/admin-order-details.component';
import {ProductDetailComponent} from './products/product-detail/product-detail.component';
import {ProductsListComponent} from './products/products-list/products-list.component';
import {AuthGuard} from './guards/auth.guard';
import {OrderCheckerComponent} from './order-checker/order-checker.component';

const routes: Routes = [
  {path: 'home', component: HomePageComponent},
  {path: 'orderCheck', component: OrderCheckerComponent},
  {
    path: 'authentication', canDeactivate: [AuthGuard],
    canActivate: [AuthGuard], children: [
      {path: '', component: AuthenticationPageComponent},
      {
        path: 'registration', children: [
          {path: 'confirmEmail', component: RegistrationConfirmEmailFormComponent},
          {path: 'confirmation', component: RegistrationConfirmationComponent}
        ]
      },
      {
        path: 'resetPassword', children: [
          {path: 'emailForm', component: ResetPasswordEmailFormComponent},
          {path: 'confirmation', component: ResetPasswordConfirmationComponent}
        ]
      }
    ]
  },
  {
    path: 'products', children: [
      {path: '', component: ProductsListComponent},
      {path: ':id', component: ProductDetailComponent}
    ]
  },
  {
    path: 'account', component: AccountPanelPageComponent, children: [
      {
        path: 'addressData',
        component: AccountAddressDataComponent,
        resolve: {
          accountGetAddressData: AccountGetAddressDataResolver
        }
      },
      {
        path: 'ordersList',
        component: AccountOrdersListComponent,
        resolve: {
          accountGetOrders: AccountGetOrdersResolver
        }
      },
      {path: 'orderDetails/:id', component: AccountOrderDetailsComponent},
      {path: 'changePassword', component: AccountChangePasswordFormComponent},
      {path: '', redirectTo: 'addressData', pathMatch: 'full'}
    ]
  },
  {
    path: 'admin', component: AdminPanelPageComponent, children: [
      {path: 'products', component: AdminProductsComponent, children: [
          {path: 'list', component: AdminProductsListComponent},
          {path: 'add', component: AdminProductsAddComponent},
          {path: 'edit', component: AdminProductsEditComponent},
          {path: 'edit/:id', component: AdminProductsEditComponent},
          {path: '', redirectTo: 'list', pathMatch: 'full'}
        ]},
      {path: 'orders', component: AdminOrdersComponent},
      {path: 'orders/:id', component: AdminOrderDetailsComponent},
      {path: 'customers', component: AdminCustomersComponent},
      {path: 'errors', component: AdminErrorsComponent},
      {path: '', redirectTo: 'products', pathMatch: 'full'}
    ]
  },
  {path: 'cart', component: CartComponent},
  {path: '', redirectTo: 'authentication', pathMatch: 'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
