import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';

import {AdminService} from '../../../services/admin.service';
import {ProductFormData} from '../../../models/product-form-data';

@Component({
  selector: 'app-admin-products-add',
  templateUrl: './admin-products-add.component.html',
  styleUrls: ['./admin-products-add.component.scss']
})
export class AdminProductsAddComponent implements OnInit {
  addProductForm: FormGroup;

  constructor(private adminServices: AdminService) {
  }

  ngOnInit(): void {
    this.addProductForm = new FormGroup({
      name: new FormControl('', [Validators.required]),
      category: new FormControl('', [Validators.required]),
      subcategory: new FormControl('', [Validators.required]),
      price: new FormControl('', [Validators.required]),
      description: new FormControl(''),
      photoPath: new FormControl('', [Validators.required]),
      quantity: new FormControl('', [Validators.required])
    });
  }

  public onSubmit(): void {
    if (this.addProductForm.invalid) {
      this.addProductForm.markAllAsTouched();
      return;
    }
    const addProductFormData: ProductFormData = {
      name: this.addProductForm.value.name,
      path: this.addProductForm.value.photoPath,
      price: this.addProductForm.value.price,
      category: this.addProductForm.value.category,
      subcategory: this.addProductForm.value.subcategory,
      description: this.addProductForm.value.description,
      quantity: this.addProductForm.value.quantity,
    };
    console.log(this.addProductForm.value);
    this.adminServices.addProduct(addProductFormData).subscribe(response => {
      console.log(response);
    });
  }
}
