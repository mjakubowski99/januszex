import {Component, OnDestroy, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthenticationService} from '../services/authentication.service';
import {Subscription} from 'rxjs';
import {Router} from '@angular/router';
import {BaseComponent} from '../shared/components/base.component';
import {takeUntil} from 'rxjs/operators';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent extends BaseComponent implements OnInit {
  searchForm: FormGroup;
  isAuthenticated = false;

  constructor(private authenticationService: AuthenticationService, private router: Router) {
    super();
    this.searchForm = new FormGroup({
      searchValue: new FormControl(null, Validators.required)
    });
  }

  ngOnInit(): void {
    this.authenticationService.user$.pipe(takeUntil(this.unsubscriber))
      .subscribe(user => {
      this.isAuthenticated = !!user;
    });
  }

  onSubmit(): void {
    console.log(this.searchForm);
    this.searchForm.reset();
  }

  public onLogout(): void {
    this.authenticationService.logout();
  }
}
