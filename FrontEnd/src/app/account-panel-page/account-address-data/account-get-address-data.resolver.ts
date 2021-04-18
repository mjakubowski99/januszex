import {Injectable} from '@angular/core';
import {
  Router, Resolve,
  RouterStateSnapshot,
  ActivatedRouteSnapshot
} from '@angular/router';
import {Observable, of} from 'rxjs';
import {AccountService} from '../../services/account.service';

@Injectable({
  providedIn: 'root'
})
export class AccountGetAddressDataResolver implements Resolve<any> {
  constructor(private accountService: AccountService) {
  }

  resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> {
    return this.accountService.getAddressData();
  }
}
