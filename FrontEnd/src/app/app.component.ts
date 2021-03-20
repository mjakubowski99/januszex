import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from './services/authentication.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  constructor(private authenticationService: AuthenticationService) {
  }

  public ngOnInit(): void {
    this.authenticationService.autoLogin();
    if (this.authenticationService.user.value) {
      console.log('');
      console.log('');
      console.log('');
      console.log(this.authenticationService.user.value.email);
      console.log(this.authenticationService.user.value.token);
      console.log('');
      console.log('');
      console.log('');
    }
  }
}
