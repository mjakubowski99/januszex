<?php

namespace app\controllers;

use app\database\Database;
use app\controllers\ProductController;

class AdminController extends Controller{

    public function getAccountList(){
        $this->view("adminAccountList");
    }

    public function postAccountList(){
        $database = new Database();
        $sql = "SELECT ID, name, surname, email FROM users";
        $result = $database->executeMany($sql);

        echo json_encode($result);
    }

    public function getErrorList(){
        $this->view("adminErrorList");
    }

    public function postErrorList(){
        $database = new Database();
        $sql = "SELECT ID, user_id, error_message FROM error_reports";
        $result = $database->executeMany($sql);

        echo json_encode($result);
    }

    public function getOrderDetails(){
        $this->view("adminOrderDetails", 1);
    }

    public function postOrderDetails(){
        $database = new Database();
        $orderID = strip_tags($_POST["orderId"]);
        $values = [':order_id' => $orderID];

        $sql = "SELECT orders.ID, orders.order_date, orders.user_id, orders.status, users.name, users.surname, address.street, address.home_number, address.flat_number, address.postoffice_code, address.city, orders_parts.product_id, products.product_name, orders_parts.quantity, products.price, orders.full_amount
                FROM orders
                INNER JOIN users 
                ON orders.user_id = users.ID
                INNER JOIN address
                ON users.address_id = address.ID
                INNER JOIN  orders_parts
                ON orders.ID = orders_parts.order_id
                INNER JOIN products
                ON orders_parts.product_id = products.ID
                WHERE orders.ID = :order_id";
        $result = $database->executeMany($sql, $values);

        echo json_encode($result);
    }

    public function getOrdersList(){
        $this->view("adminOrdersList");
    }

    public function postOrdersList(){
        $database = new Database();
        $sql = "SELECT ID, user_id, order_date, full_amount, status FROM orders";
        $result = $database->executeMany($sql);

        echo json_encode($result);
    }

    /*public function postDeleteCustomer(){
        $database = new Database();
        $userID = strip_tags($_POST["userID"]);
        $values = [':userID' => $userID];
        $sql = "DELETE FROM users
                WHERE users.ID = :userID";
        $result = $database->executeMany($sql, $values);

        echo json_encode($result);      
    }*/

    public function getProductOperation(){
        $this->view("adminProducts");
    }

    public function postProductOperation(){
        $database = new Database();
        $option = strip_tags($_POST["option"]);
        if($option == "Add"){
            $name = strip_tags($_POST["name"]);
            $path = strip_tags($_POST["path"]);
            $price = strip_tags($_POST["price"]);
            $quantity = strip_tags($_POST["quantity"]);
            $category = strip_tags($_POST["category"]);
            $subcategory = strip_tags($_POST["subcategory"]);
            $description = strip_tags($_POST["description"]);

            $values = [':name' => $name,
                       ':description' => $description,
                       ':price' => $price,
                       ':quantity'=> $quantity,
                       ':path' => $path,
                       ':category' => $category,
                       ':subcategory' => $subcategory];

            $sql = "INSERT INTO products(ID, product_name, description, price, quantity, photo_path, average_raiting, category, subcategory) VALUES
                    (0, :name, :description, :price, :quantity, :path, 1, :category, :subcategory);";

            $database->insert($sql, $values);

            
        }
        elseif($option == "Edit"){
            $id = strip_tags($_POST["productID"]);
            $name = strip_tags($_POST["name"]);
            $path = strip_tags($_POST["path"]);
            $price = strip_tags($_POST["price"]);
            $quantity = strip_tags($_POST["quantity"]);
            $category = strip_tags($_POST["category"]);
            $subcategory = strip_tags($_POST["subcategory"]);
            $description = strip_tags($_POST["description"]);
            
            $values = [':id' => $id,
                       ':name' => $name,
                       ':description' => $description,
                       ':price' => $price,
                       ':quantity'=> $quantity,
                       ':path' => $path,
                       ':category' => $category,
                       ':subcategory' => $subcategory];

            $sql = "UPDATE products
                    SET product_name = :name, description = :description, price = :price, quantity = :quantity, photo_path = :path, average_raiting = 1, category = :category, subcategory = :subcategory
                    WHERE ID = :id;";

            $result = $database->update($sql, $values);

            echo json_encode($result);
        }
        elseif($option == "List"){
            $productController = new ProductController();
            $productController->postProductsList();
        }
    }
}



?>