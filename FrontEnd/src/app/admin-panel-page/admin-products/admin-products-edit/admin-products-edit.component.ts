import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AdminService} from '../../../services/admin.service';
import {ProductFormData} from '../../../models/product-form-data';
import {Product} from '../../../models/product';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-admin-products-edit',
  templateUrl: './admin-products-edit.component.html',
  styleUrls: ['./admin-products-edit.component.scss']
})
export class AdminProductsEditComponent implements OnInit {
  editProductForm: FormGroup;
  inputProductId: number;
  currentProduct: Product;

  constructor(private adminServices: AdminService, private router: Router, private activatedRoute: ActivatedRoute) {
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
          this.getProduct();
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
      console.log(response);
    });
  }

  public onChangeRoute(): void
  {
    this.router.navigate([`admin/products/edit/${this.inputProductId}`]);
  }

  public getProduct(): void {
    // this.adminServices.getProduct(this.inputProductId).subscribe(response => {
    //   console.log(response);
    //   this.currentProduct = {
    //     id: +response.ID,
    //     name: response.product_name,
    //     category: response.category,
    //     subcategory: response.subcategory,
    //     price: +response.price,
    //     description: response.description,
    //     photoPath: response.photo_path,
    //     quantity: +response.quantity
    //   };
    // });
    this.currentProduct = {
      id: 1,
      name: 'Myszka',
      category: 'Kategoria',
      subcategory: 'Subkategoria',
      price: 213.42,
      description: 'opis',
      photoPath: 'https://f01.esfr.pl/foto/7/43240474201/f9ca8c5e596c93a85842a59997e3c3c8/hama-mysz-bezprzewodowa-mw-300-antracyt,43240474201_8.jpg',
      quantity: 2
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
  }
}
