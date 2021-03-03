import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  searchForm: FormGroup;

  constructor() {
  }

  ngOnInit(): void {
    this.searchForm = new FormGroup({
      searchValue: new FormControl(null, Validators.required)
    });
  }

  onSubmit(): void {
    console.log(this.searchForm);
    this.searchForm.reset();
  }
}
