import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {HomePageComponent} from './home-page/home-page.component';
import {AuthorizationPageComponent} from './authentication-page/authorization-page.component';
import {CartComponent} from './cart/cart.component';
import {RegistrationConfirmEmailFormComponent} from './authentication-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authentication-page/registration-confirmation/registration-confirmation.component';
import {ResetPasswordEmailFormComponent} from './authentication-page/reset-password-email-form/reset-password-email-form.component';
import {ResetPasswordConfirmEmailFormComponent} from './authentication-page/reset-password-confirm-email-form/reset-password-confirm-email-form.component';
import {ResetPasswordNewPasswordFormComponent} from './authentication-page/reset-password-new-password-form/reset-password-new-password-form.component';
import {ResetPasswordConfirmationComponent} from './authentication-page/reset-password-confirmation/reset-password-confirmation.component';
import {AdminPageComponent} from './admin-page/admin-page.component';
import {ErrorsComponent} from './admin-page/errors/errors.component';

const routes: Routes = [
  {path: 'home', component: HomePageComponent},
  {
    path: 'authentication', children: [
      {path: '', component: AuthorizationPageComponent},
      {
        path: 'registration', children: [
          {path: 'confirmEmail', component: RegistrationConfirmEmailFormComponent},
          {path: 'confirmation', component: RegistrationConfirmationComponent}
        ]
      },
      {
        path: 'resetPassword', children: [
          {path: 'emailForm', component: ResetPasswordEmailFormComponent},
          {path: 'confirmEmailForm', component: ResetPasswordConfirmEmailFormComponent},
          {path: 'newPasswordForm', component: ResetPasswordNewPasswordFormComponent},
          {path: 'confirmation', component: ResetPasswordConfirmationComponent}
        ]
      }
    ]
  },
  {
    path: 'admin', component: AdminPageComponent, children: [
      {path: 'products', component: AdminPageComponent},
      {path: 'orders', component: AdminPageComponent},
      {path: 'accounts', component: AdminPageComponent},
      {path: 'errors', component: ErrorsComponent},
      {path: '', redirectTo: 'products', pathMatch: 'full'}
    ]
  },
  {path: 'cart', component: CartComponent},
  {path: '', redirectTo: 'home', pathMatch: 'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
