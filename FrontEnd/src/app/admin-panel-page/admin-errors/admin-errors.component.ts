import {Component, OnInit} from '@angular/core';
import {AdminService} from '../../services/admin.service';

@Component({
  selector: 'app-admin-errors',
  templateUrl: './admin-errors.component.html',
  styleUrls: ['./admin-errors.component.scss']
})
export class AdminErrorsComponent implements OnInit {

  errors: any[] = [];

  constructor(private adminService: AdminService) {
  }

  ngOnInit(): void {
    console.log(this.errors);
    this.adminService.getErrors().subscribe((response: any[]) => {
      this.errors = response.map(resErrors => ({
        errorId: +resErrors.ID,
        userId: +resErrors.user_id,
        errorMessage: resErrors.error_message
      }));
    });
  }
}
