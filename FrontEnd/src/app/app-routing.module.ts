import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {HomePageComponent} from './home-page/home-page.component';
import {AuthorizationPageComponent} from './authorization-page/authorization-page.component';
import {CartComponent} from './cart/cart.component';
import {RegistrationConfirmEmailFormComponent} from './authorization-page/registration-confirm-email-form/registration-confirm-email-form.component';
import {RegistrationConfirmationComponent} from './authorization-page/registration-confirmation/registration-confirmation.component';
import {ResetPasswordEmailFormComponent} from './authorization-page/reset-password-email-form/reset-password-email-form.component';
import {ResetPasswordConfirmEmailFormComponent} from './authorization-page/reset-password-confirm-email-form/reset-password-confirm-email-form.component';
import {ResetPasswordNewPasswordFormComponent} from './authorization-page/reset-password-new-password-form/reset-password-new-password-form.component';
import {ResetPasswordConfirmationComponent} from './authorization-page/reset-password-confirmation/reset-password-confirmation.component';

const routes: Routes = [
  {path: 'home', component: HomePageComponent},
  {
    path: 'authorization', children: [
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
  {path: 'cart', component: CartComponent},
  {path: '', redirectTo: 'home', pathMatch: 'full'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
