import {Component, OnDestroy, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthenticationService} from '../services/authentication.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit, OnDestroy {
  searchForm: FormGroup;
  isAuthenticated = false;
  private userSub: Subscription;

  constructor(private authenticationService: AuthenticationService) {
    this.searchForm = new FormGroup({
      searchValue: new FormControl(null, Validators.required)
    });
  }

  ngOnInit(): void {
    this.userSub = this.authenticationService.user.subscribe(user => {
      this.isAuthenticated = !!user;
    });
  }

  ngOnDestroy(): void {
    this.userSub.unsubscribe();
  }

  onSubmit(): void {
    console.log(this.searchForm);
    this.searchForm.reset();
  }

  public onLogout(): void {
    this.authenticationService.logout();
  }
}
