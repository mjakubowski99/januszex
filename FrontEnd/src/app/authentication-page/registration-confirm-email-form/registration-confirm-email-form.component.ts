import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from '../../services/authentication.service';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'app-registration-confirm-email-form',
  templateUrl: './registration-confirm-email-form.component.html',
  styleUrls: ['./registration-confirm-email-form.component.scss']
})
export class RegistrationConfirmEmailFormComponent implements OnInit {
  confirmEmailForm: FormGroup;

  constructor(private authenticationService: AuthenticationService) {
  }

  ngOnInit(): void {
    this.confirmEmailForm = new FormGroup({
      code: new FormControl('', [Validators.required])
    });
  }

  onResendCode(): void {
    this.authenticationService.resendEmailCode().subscribe();
  }

  onSubmit(): void {
    const code = this.confirmEmailForm.value.code;
    this.authenticationService.confirmEmail(code).subscribe()
  }
}
