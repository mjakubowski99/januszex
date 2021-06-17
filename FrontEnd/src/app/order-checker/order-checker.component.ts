import {Component, OnInit} from '@angular/core';
import {AccountService} from '../services/account.service';

@Component({
  selector: 'app-order-checker',
  templateUrl: './order-checker.component.html',
  styleUrls: ['./order-checker.component.scss']
})
export class OrderCheckerComponent implements OnInit {
  isChecked = false;
  isPaymentSuccessful: boolean = null;

  constructor(private accountService: AccountService) {
  }

  ngOnInit(): void {
    this.accountService.getLastOrder().subscribe(x => {
      this.accountService.updatePaymentStatus(x.payu_order_id).subscribe(y => {
        if (y.status === 'COMPLETED') {
          this.isPaymentSuccessful = true;
        } else {
          this.isPaymentSuccessful = false;
        }
        this.isChecked = true;
      });
    });
  }
}
