<?php
require_once __DIR__.'/../autoloader.php';
require_once __DIR__.'/SampleDatabaseData.php';

use app\database\Database;

class RefreshDatabase{

    public function delete(){
        $db = new Database();

        $query = "DELETE from verify_tokens";
        $db->delete($query);

        $query = "DELETE from recommended_sets";
        $db->delete($query);

        $query = "DELETE from fitting_sets";
        $db->delete($query);

        $query = "DELETE from carts";
        $db->delete($query);

        $query = "DELETE from historical_orders";
        $db->delete($query);

        $query = "DELETE from carts";
        $db->delete($query);

        $query = "DELETE from orders_parts";
        $db->delete($query);

        $query = "DELETE from orders";
        $db->delete($query);

        $query = "DELETE from carts";
        $db->delete($query);

        $query = "DELETE from error_reports";
        $db->delete($query);

        $query = "DELETE from set_description";
        $db->delete($query);

        $query = "DELETE from products";
        $db->delete($query);

        $query = "DELETE from administrators";
        $db->delete($query);

        $query = "DELETE from users";
        $db->delete($query);

        $query = "DELETE from address";
        $db->delete($query);
    }

   public function refresh(){
       $this->delete();
       ( new SampleDatabaseData() )->fillAllTables();
    }
}

$database = new RefreshDatabase();
$database->refresh();