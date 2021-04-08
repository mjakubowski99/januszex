import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AddressFormData} from '../../models/address-form-data';
import {AccountService} from '../../services/account.service';
import {AddressData} from '../../models/address-data';

@Component({
  selector: 'app-account-address-data',
  templateUrl: './account-address-data.component.html',
  styleUrls: ['./account-address-data.component.scss']
})
export class AccountAddressDataComponent implements OnInit {
  newAddressDataForm: FormGroup;
  currentAddressData: AddressData;

  constructor(private accountService: AccountService) {
  }

  ngOnInit(): void {
    const lettersAndWhitespaceRegEx = RegExp(/^[\s\p{L}]*$/u);
    const lettersDashAndWhitespaceRegEx = RegExp(/^[-\s\p{L}]*$/u);
    const lettersNumbersDashAndWhitespaceRegEx = RegExp(/^[-\d\s\p{L}]*$/u);
    this.newAddressDataForm = new FormGroup({
      name: new FormControl('', [Validators.required, Validators.pattern(lettersAndWhitespaceRegEx)]),
      surname: new FormControl('', [Validators.required, Validators.pattern(lettersDashAndWhitespaceRegEx)]),
      city: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      street: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      homeNumber: new FormControl('', [Validators.required, Validators.pattern(/^[1-9][\d\p{L}]*$/u)]),
      flatNumber: new FormControl('', [Validators.required, Validators.pattern(/^[1-9][\d]*$/u)]),
      postOfficeName: new FormControl('', [Validators.required, Validators.pattern(lettersNumbersDashAndWhitespaceRegEx)]),
      postOfficeCode: new FormControl('', [Validators.required, Validators.pattern('[0-9]{2}-[0-9]{3}')]),
    });
    this.getAddress();
  }

  public onSubmit(): void {
    const newAddressData: AddressFormData = {
      name: this.newAddressDataForm.value.name,
      surname: this.newAddressDataForm.value.surname,
      city: this.newAddressDataForm.value.city,
      street: this.newAddressDataForm.value.street,
      home_number: this.newAddressDataForm.value.homeNumber,
      flat_number: this.newAddressDataForm.value.flatNumber,
      postoffice_name: this.newAddressDataForm.value.postOfficeName,
      postoffice_code: this.newAddressDataForm.value.postOfficeCode
    };
    this.accountService.changeAddressData(newAddressData).subscribe(resData => {
      if (resData.message === 'Success') {
        this.getAddress();
      }
    });
  }

  private getAddress(): void {
    this.accountService.getAddressData().subscribe(resData => {
        this.currentAddressData = {
          name: resData.name,
          surname: resData.surname,
          city: resData.city,
          street: resData.street,
          homeNumber: resData.home_number,
          flatNumber: resData.flat_number,
          postOfficeName: resData.postoffice_name,
          postOfficeCode: resData.postoffice_code
        };
      }
    );
  }
}
