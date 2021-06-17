import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AuthenticationService} from '../services/authentication.service';
import {ActivatedRoute, Router} from '@angular/router';
import {BaseComponent} from '../shared/components/base.component';
import {takeUntil} from 'rxjs/operators';
import {UserData} from '../models/user-data';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent extends BaseComponent implements OnInit {
  searchForm: FormGroup;
  isAuthenticated = false;
  user: UserData = null;

  constructor(private authenticationService: AuthenticationService, private router: Router, private activatedRoute: ActivatedRoute) {
    super();
    this.searchForm = new FormGroup({
      searchValue: new FormControl(null, Validators.required)
    });

    this.activatedRoute.queryParams.subscribe(x => {
      this.searchForm = new FormGroup({
        searchValue: new FormControl(x.searchValue ?? '')
      });
    });
  }

  ngOnInit(): void {
    this.authenticationService.user$.pipe(takeUntil(this.unsubscriber))
      .subscribe(user => {
        this.user = user;
        this.isAuthenticated = !!user;
    });
  }

  onSubmit(): void {
    const searchValue = this.searchForm.value.searchValue;
    this.router.navigate(['/products'], {queryParams: {searchValue}});

    this.router.navigate(['/products'], {
      queryParams: {searchValue},
      queryParamsHandling: 'merge',
    });
  }

  public onLogout(): void {
    this.authenticationService.logout();
  }
}
