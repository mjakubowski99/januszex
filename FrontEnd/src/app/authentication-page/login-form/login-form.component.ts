import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthenticationService} from '../../services/authentication.service';
import {LoginFormData} from '../../models/login-form-data';

@Component({
  selector: 'app-login-form',
  templateUrl: './login-form.component.html',
  styleUrls: ['./login-form.component.scss']
})
export class LoginFormComponent implements OnInit {
  loginForm: FormGroup;

  constructor(private authenticationService: AuthenticationService) {
    this.loginForm = new FormGroup({
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', [Validators.required, Validators.minLength(8)])
    });
  }

  ngOnInit(): void {
  }

  public onSubmit(): void {
    const loginFormData: LoginFormData = {
      email: this.loginForm.value.email,
      password: this.loginForm.value.password
    };

    this.authenticationService.login(loginFormData).subscribe((response) => {
      //console.log(response);
    });
  }
}
