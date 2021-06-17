import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AdminService} from '../../../services/admin.service';
import {ProductFormData} from '../../../models/product-form-data';
import {Product} from '../../../models/product';
import {ActivatedRoute, Router} from '@angular/router';
import {CustomMessageService} from '../../../services/custom-message.service';
import {ProductService} from '../../../services/product.service';

@Component({
  selector: 'app-admin-products-edit',
  templateUrl: './admin-products-edit.component.html',
  styleUrls: ['./admin-products-edit.component.scss']
})
export class AdminProductsEditComponent implements OnInit {
  editProductForm: FormGroup;
  inputProductId: number;
  currentProduct: Product;

  constructor(private adminServices: AdminService, private router: Router, private activatedRoute: ActivatedRoute, private customMessageService: CustomMessageService, private productService: ProductService) {
  }

  ngOnInit(): void {
    this.editProductForm = new FormGroup({
      name: new FormControl('', [Validators.required]),
      category: new FormControl('', [Validators.required]),
      subcategory: new FormControl('', [Validators.required]),
      price: new FormControl('', [Validators.required]),
      description: new FormControl(''),
      photoPath: new FormControl('', [Validators.required]),
      quantity: new FormControl('', [Validators.required])
    });
    this.activatedRoute.params.subscribe(params => {
        const id = params.id;
        if (id !== null && id !== undefined) {
          this.getProduct(id);
        }
      }
    );
  }

  public onSubmit(): void {
    const editProductFormData: ProductFormData = {
      name: this.editProductForm.value.name,
      path: this.editProductForm.value.photoPath,
      price: this.editProductForm.value.price,
      category: this.editProductForm.value.category,
      subcategory: this.editProductForm.value.subcategory,
      description: this.editProductForm.value.description,
      quantity: this.editProductForm.value.quantity,
    };
    this.adminServices.editProduct(this.currentProduct.id, editProductFormData).subscribe(response => {
      if (response === null) {
        this.customMessageService.pushSuccessMessage('Powodzenia', 'Produkt został zmieniony');
      }
    });
  }

  public onChangeRoute(): void
  {
    this.router.navigate([`admin/products/edit/${this.inputProductId}`]);
  }

  public getProduct(productId: number): void {
    this.productService.getProduct(productId).subscribe(response => {
      this.currentProduct = {
        id: +response.ID,
        name: response.product_name,
        category: response.category,
        subcategory: response.subcategory,
        price: +response.price,
        description: response.description,
        photoPath: response.photo_path,
        quantity: +response.quantity
      };
      this.editProductForm.patchValue({
        name: this.currentProduct.name,
        category: this.currentProduct.category,
        subcategory: this.currentProduct.subcategory,
        price: this.currentProduct.price,
        description: this.currentProduct.description,
        photoPath: this.currentProduct.photoPath,
        quantity: this.currentProduct.quantity
      });
    });
  }
}
