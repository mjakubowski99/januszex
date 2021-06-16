import {Component, OnInit} from '@angular/core';
import {AbstractControl, FormControl, FormGroup, ValidationErrors, ValidatorFn, Validators} from '@angular/forms';
import {AccountService} from '../../services/account.service';
import {ChangePasswordFormData} from '../../models/change-password-form-data';

@Component({
  selector: 'app-account-change-password-form',
  templateUrl: './account-change-password-form.component.html',
  styleUrls: ['./account-change-password-form.component.scss']
})
export class AccountChangePasswordFormComponent implements OnInit {
  changePasswordForm: FormGroup;

  constructor(private accountService: AccountService) {
  }

  ngOnInit(): void {
    this.changePasswordForm = new FormGroup({
      oldPassword: new FormControl('', [Validators.required, Validators.minLength(8)]),
      newPasswordGroup: new FormGroup({
        newPassword: new FormControl('', [Validators.required, Validators.minLength(8)]),
        confirmNewPassword: new FormControl('', [Validators.required, Validators.minLength(8)]),
      }, this.passwordMatchValidator())
    });
  }

  public onSubmit(): void {
    // 'actual-password': string;
    // 'new-password': string;
    // 'repeat-new-password': string;
    const changePasswordFormData: ChangePasswordFormData = {
      'actual-password': this.changePasswordForm.value.oldPassword,
      'new-password': this.changePasswordForm.value.newPasswordGroup.newPassword,
      'repeat-new-password': this.changePasswordForm.value.newPasswordGroup.newPassword,
    };
    this.accountService.changePassword(changePasswordFormData).subscribe();
  }

  passwordMatchValidator(): ValidatorFn {
    return (passwordGroup: AbstractControl): ValidationErrors | null => {
      const password = passwordGroup.value.password;
      const confirmPassword = passwordGroup.value.confirmPassword;

      return password === confirmPassword ? null : {passwordMismatch: true};
    };
  }
}
