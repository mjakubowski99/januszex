<?php

require_once __DIR__.'/../autoloader.php';
use app\config\DatabaseConnector;


class DatabaseCreator{
        public $db_conn;
        public $connection;

        public function __construct(){
            $this->db_conn = new DatabaseConnector();
            $this->connection = $this->db_conn->getConnection();
        }
        
        public function createUsersTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS users(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                name varchar(50) NOT NULL,
                                surname varchar(50) NOT NULL,
                                email varchar(50) NOT NULL,
                                password varchar(255) NOT NULL,
                                verified boolean NOT NULL,
                                address_id bigint NOT NULL, #FK
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_UserAddress FOREIGN KEY (address_id)
                                REFERENCES address(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createAddressTable(){
            try{
                $sql_statement= "CREATE table IF NOT EXISTS address(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                city varchar(50) NOT NULL,
                                street varchar(50) NOT NULL,
                                home_number varchar(5) NOT NULL,
                                flat_number varchar(5),
                                postoffice_name varchar(50) NOT NULL,
                                postoffice_code varchar(6) NOT NULL,
                                PRIMARY KEY (ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createErrorReportsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS error_reports(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                error_message varchar(200) NOT NULL,
                                user_id bigint NOT NULL, #FK
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_UsersReports FOREIGN KEY (user_id)
                                REFERENCES users(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createAdministratorsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS administrators(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                name varchar(45) NOT NULL,
                                password varchar(255) NOT NULL,
                                token varchar(50) NOT NULL,
                                PRIMARY KEY (ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createOrdersTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS orders(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                user_id BIGINT NOT NULL, #FK
                                product_id BIGINT NOT NULL, #FK
                                address_id BIGINT NOT NULL, #FK
                                order_date datetime NOT NULL,
                                order_id BIGINT NOT NULL,
                                quantity int NOT NULL,
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_UserOrder FOREIGN KEY (user_id)
                                REFERENCES users(ID),
                                CONSTRAINT FK_OrderAddress FOREIGN KEY (address_id)
                                REFERENCES address(ID),
                                CONSTRAINT FK_ProductOrder FOREIGN KEY (product_id)
                                REFERENCES products(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createCartsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS carts(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                user_id BIGINT NOT NULL, #FK
                                product_id BIGINT NOT NULL, #FK
                                quantity int NOT NULL,
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_UserCart FOREIGN KEY (user_id)
                                REFERENCES users(ID),
                                CONSTRAINT FK_ProductCart FOREIGN KEY (product_id)
                                REFERENCES products(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createHistoricalOrdersTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS historical_orders(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                user_id BIGINT NOT NULL, #FK
                                product_id BIGINT NOT NULL, #FK
                                order_date datetime NOT NULL,
                                quantity int NOT NULL,
                                order_id BIGINT,
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_HistricalUserOrder FOREIGN KEY (user_id)
                                REFERENCES users(ID),
                                CONSTRAINT FK_HistoricalProductOrder FOREIGN KEY (product_id)
                                REFERENCES products(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createProductsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS products(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                name varchar(45) NOT NULL,
                                description varchar(200) NOT NULL,
                                price double NOT NULL,
                                photo_path varchar(100) NOT NULL,
                                average_raiting smallint NOT NULL,
                                specification varchar(100) NOT NULL,
                                PRIMARY KEY (ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createFittingSetsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS fitting_sets(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                product_id BIGINT NOT NULL, #FK
                                fitting_product_id BIGINT NOT NULL, #FK
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_ProductIdFitting FOREIGN KEY (product_id)
                                REFERENCES products(ID),
                                CONSTRAINT FK_ProductFitting FOREIGN KEY (fitting_product_id)
                                REFERENCES products(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createRecommendedSetsTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS recommended_sets(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                product_id BIGINT NOT NULL, #FK
                                set_id BIGINT NOT NULL, #FK
                                PRIMARY KEY (ID),
                                CONSTRAINT FK_ProductRecommended FOREIGN KEY (product_id)
                                REFERENCES products(ID),
                                CONSTRAINT FK_SetsId FOREIGN KEY (set_id)
                                REFERENCES set_description(ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createSetDescriptionTable(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS set_description(
                                ID BIGINT NOT NULL AUTO_INCREMENT,
                                description varchar(45) NOT NULL,
                                PRIMARY KEY (ID)
                                );";
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }

        public function createVerifyTokens(){
            try{
                $sql_statement = "CREATE table IF NOT EXISTS verify_tokens(
                                  ID BIGINT NOT NULL AUTO_INCREMENT,
                                  token varchar(100) NOT NULL,
                                  user_id bigint NOT NULL,
                                  expire DATETIME NOT NULL,
                                  PRIMARY KEY (ID),
                                  FOREIGN KEY (user_id) REFERENCES Users(ID)
                                 );"; 
                $this->connection->exec($sql_statement);
            } catch(PDOException $e){
                echo json_encode([
                    'message' => $e->getMessage()
                ]);
    
                die();
            }
        }



        public function createAllTables(){
            $this->createAddressTable();
            $this->createAdministratorsTable();
            $this->createProductsTable();
            $this->createSetDescriptionTable();
            $this->createUsersTable();
            $this->createErrorReportsTable();
            $this->createOrdersTable();
            $this->createHistoricalOrdersTable();
            $this->createCartsTable();
            $this->createFittingSetsTable();
            $this->createRecommendedSetsTable();
            $this->createVerifyTokens();
        }
}

    $creator = new DatabaseCreator();
    $creator->createAllTables();
    //$creator->createAddressTable();
    //$creator->createUsersTable();