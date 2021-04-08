import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthenticationService} from '../../services/authentication.service';

@Component({
  selector: 'app-reset-password-email-form',
  templateUrl: './reset-password-email-form.component.html',
  styleUrls: ['./reset-password-email-form.component.scss']
})
export class ResetPasswordEmailFormComponent implements OnInit {
  resetPasswordEmailForm: FormGroup;

  constructor(private authenticationService: AuthenticationService)  { }

  ngOnInit(): void {
    this.resetPasswordEmailForm = new FormGroup({
      email: new FormControl('', [Validators.required, Validators.email])
    });
  }

  public onSubmit(): void  {
    const email = this.resetPasswordEmailForm.value.email;
    this.authenticationService.resetPassword(email).subscribe();
  }
}
