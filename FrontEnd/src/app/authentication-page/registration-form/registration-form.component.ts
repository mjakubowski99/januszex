import {Component, OnInit} from '@angular/core';
import {AbstractControl, FormControl, FormGroup, ValidationErrors, ValidatorFn, Validators} from '@angular/forms';
import {AuthenticationService} from '../../services/authentication.service';
import {RegistrationFormData} from '../../models/registration-form-data';

@Component({
  selector: 'app-registration-form',
  templateUrl: './registration-form.component.html',
  styleUrls: ['./registration-form.component.scss']
})
export class RegistrationFormComponent implements OnInit {
  registrationForm: FormGroup;

  constructor(private authenticationService: AuthenticationService) {
    const lettersAndWhitespaceRegEx = RegExp(/^[\s\p{L}]*$/u);
    const lettersDashAndWhitespaceRegEx = RegExp(/^[-\s\p{L}]*$/u);
    const lettersNumbersDashAndWhitespaceRegEx = RegExp(/^[-\d\s\p{L}]*$/u);
    this.registrationForm = new FormGroup({
      email: new FormControl('', [Validators.required, Validators.email]),
      passwordGroup: new FormGroup({
        password: new FormControl('', [Validators.required, Validators.minLength(8)]),
        confirmPassword: new FormControl('', [Validators.required, Validators.minLength(8)]),
      }, this.passwordMatchValidator()),
      name: new FormControl('', [Validators.required, Validators.pattern(lettersAndWhitespaceRegEx)]),
      surname: new FormControl('', [Validators.required, Validators.pattern(lettersDashAndWhitespaceRegEx)]),
      city: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      street: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      homeNumber: new FormControl('', [Validators.required, Validators.pattern(/^[1-9][\d\p{L}]*$/u)]),
      flatNumber: new FormControl('', [Validators.required, Validators.pattern(/^[1-9][\d]*$/u)]),
      postOfficeName: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      postOfficeCode: new FormControl('', [Validators.required, Validators.pattern('[0-9]{2}-[0-9]{3}')]),
    });
  }

  ngOnInit(): void {
  }

  public onSubmit(): void {
    if (this.registrationForm.invalid) {
      this.registrationForm.markAllAsTouched();
      return;
    }
    const registrationFormData: RegistrationFormData = {
      email: this.registrationForm.value.email,
      password: this.registrationForm.value.passwordGroup.password,
      confirm: this.registrationForm.value.passwordGroup.confirmPassword,
      name: this.registrationForm.value.name,
      surname: this.registrationForm.value.surname,
      city: this.registrationForm.value.city,
      street: this.registrationForm.value.street,
      home_number: this.registrationForm.value.homeNumber,
      flat_number: this.registrationForm.value.flatNumber,
      postoffice_name: this.registrationForm.value.postOfficeName,
      postoffice_code: this.registrationForm.value.postOfficeCode
    };
    this.authenticationService.register(registrationFormData).subscribe((response) => {
      console.log(response);
    });
  }

  passwordMatchValidator(): ValidatorFn {
    return (passwordGroup: AbstractControl): ValidationErrors | null => {
      const password = passwordGroup.value.password;
      const confirmPassword = passwordGroup.value.confirmPassword;

      return password === confirmPassword ? null : {passwordMismatch: true};
    };
  }
}
