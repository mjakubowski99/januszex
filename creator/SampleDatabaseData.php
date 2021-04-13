<?php
require_once __DIR__.'/../autoloader.php';
use app\config\DatabaseConnector;


class SampleDatabaseData{
    public $db_conn;
    public $connection;

    public function __construct(){
        $this->db_conn = new DatabaseConnector();
        $this->connection = $this->db_conn->getConnection();
    }

    public function fillUserTable(){
        try{
            $hash = password_hash('silnehasło123', PASSWORD_DEFAULT);
            $values = [':password' => $hash];
            
            $sql_statement = "INSERT INTO users (ID, name, surname, email, password, verified, address_id) VALUES
                             (0, 'Jan', 'Kowalski', 'Jan.Kowalski@wp.pl', :password, 1, 1),
                             (0, 'Janusz', 'Polak', 'Janusz.Polak@wp.pl', :password, 1, 2),
                             (0, 'Mateusz', 'Nowak', 'Mateusz.Nowak@wp.pl', :password, 1, 3),
                             (0, 'Piotr', 'Kowal', 'Piotr.Kowal@wp.pl', :password, 1, 4),
                             (0, 'Teresa', 'Kiełbasa', 'Teresa.Kiełbasa@wp.pl', :password, 1, 5),
                             (0, 'Mariola', 'Parówa', 'Mariola.Parówa@wp.pl', :password, 0, 6),
                             (0, 'Jakub', 'Księżyc', 'Jakub.Księżyc@wp.pl', :password, 1, 7),
                             (0, 'Stanisław', 'Psikuta', 'Stanisław.Psikuta@wp.pl', :password, 1, 8),
                             (0, 'Cezary', 'Michota', 'Cezary.Michota@wp.pl', :password, 0, 9),
                             (0, 'Wiktor', 'Kowal', 'Wiktor.Kowal@wp.pl', :password, 1, 10);";
            $stmt = $this->connection->prepare($sql_statement);
            $stmt->execute(array(':password'=>$hash));
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillAddressTable(){
        try{
            $sql_statement = "INSERT INTO address (ID, city, street, home_number, flat_number, postoffice_name, postoffice_code) VALUES
                             (0, 'Lublin', 'Kolorowa', 34, '', 'Lublin', '00-000'),
                             (0, 'Warszawa', 'Jagodowa', 31, '', 'Lublin', '00-000'),
                             (0, 'Poznań', 'Borówkowa', 22, '', 'Lublin', '00-000'),
                             (0, 'Zamość', 'Jarzynowa', 3, '', 'Lublin', '00-000'),
                             (0, 'Gdańsk', 'Prusa', 1, '', 'Lublin', '00-000'),
                             (0, 'Katowice', 'Pochmurna', 13, '2C', 'Lublin', '00-000'),
                             (0, 'Gliwice', 'Fantastyczna', 34, '1D', 'Lublin', '00-000'),
                             (0, 'Zabrze', 'Fabryczna', 44, '', 'Lublin', '00-000'),
                             (0, 'Gdynia', 'Kraśnicka', 12, '', 'Lublin', '00-000'),
                             (0, 'Lublin', 'Lwowska', 32, '', 'Lublin', '00-000');";
            $this->connection->exec($sql_statement);
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillErrorsTable(){
        try{
            $sql_statement = "INSERT INTO error_reports (ID, error_message, user_id) VALUES
                             (0, 'Błąd logowanie', 1),
                             (0, 'Brak kodu na emailu', 2),
                             (0, 'Błędna walidacja przy logowaniu maila', 3),
                             (0, 'Nieoczekiwany błąd', 4),
                             (0, 'Brak możliwości zmiany adresu', 5),
                             (0, 'Nie wczytujący się obrazek', 6),
                             (0, 'Niezdefiniowany', 7),
                             (0, 'Brak przejścia do płatności', 8),
                             (0, 'Puste zamówienie', 9),
                             (0, 'Usunięty koszyk', 10);";
            
            $this->connection->exec($sql_statement);
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillProductTable(){
        try{
            $sql_statement = "INSERT INTO products(ID, product_name, description, price, quantity, photo_path, average_raiting, category, subcategory) VALUES
                             (0, 'Radeon R9', '4GB pamięci', 2399, 3, 'path1', 1, 'Karta graficzna', 'Nvidia'),
                             (0, 'Intel i5', '4 rdzenie', 999, 10, 'path2', 2, 'Procesor', 'Intel'),
                             (0, 'Speakers', '8 głośników', 399, 28, 'path3', 3, 'Głośniki', 'Realtek'),
                             (0, 'Radeon R9 RS3', '8GB', 2999, 34, 'path4', 4, 'Karta graficzna', 'Nvidia'),
                             (0, 'Intel Atom', '1 rdzeń', 2399, 22, 'path5', 5, 'Procesor', 'Intel'),
                             (0, 'Intel i7', '4 rdzenie', 299, 11, 'path6', 6, 'Procesor', 'Intel'),
                             (0, 'Intel i9', '8 rdzeni', 2999, 32, 'path7', 7, 'Procesor', 'Intel'),
                             (0, 'Mysz gamingowa', '9 przycisków', 99, 33, 'path8', 8, 'Mysz', 'Genesis'),
                             (0, 'Intel Wireless i7892', 'Obsługuje wszystkie standardy WiFi', 2399, 9, 'path9', 9, 'Karta sieciowa', 'Intel'),
                             (0, 'Klawiatura gamingowa', 'Klawiatura mechaniczna', 99, 10, 'path10', 11, 'Klawiatura', 'Genesis');";
            
            $this->connection->exec($sql_statement);
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillOrdersTable(){
        try{
            $sql_statement = "INSERT INTO orders (ID, user_id, address_id, order_date, full_amount, status) VALUES
                             (0, 1, 1, '2021-04-08', 5396, 'W trakcie'),
                             (0, 2, 2, '2021-04-08', 999, 'Dostarczone'),
                             (0, 3, 3, '2021-04-08', 399, 'Nieoplacone'),
                             (0, 4, 4, '2021-04-08', 2999, 'W trakcie'),
                             (0, 5, 5, '2021-04-08', 2399, 'W trakcie'),
                             (0, 6, 6, '2021-04-08', 299, 'W trakcie'),
                             (0, 7, 7, '2021-04-08', 8997, 'Dostarczone'),
                             (0, 8, 8, '2021-04-08', 99, 'W trakcie'),
                             (0, 9, 9, '2021-04-08', 2399, 'W trakcie'),
                             (0, 10, 10, '2021-04-08', 99, 'Nieoplacone');";
            
            $this->connection->exec($sql_statement);
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillOrdersPartsTable(){
        try{
            $sql_statement = "INSERT INTO orders_parts(ID, product_id, order_id, quantity) VALUES
                             (0, 1, 1, 1),
                             (0, 2, 2, 1),
                             (0, 3, 3, 1),
                             (0, 4, 4, 1),
                             (0, 5, 5, 1),
                             (0, 6, 6, 1),
                             (0, 7, 7, 3),
                             (0, 8, 8, 1),
                             (0, 9, 9, 1),
                             (0, 10, 10, 1),
                             (0, 2, 1, 3);";
            
            $this->connection->exec($sql_statement);
        } catch(PDOException $e){
            echo json_encode([
                'message' => $e->getMessage()
            ]);

            die();
        }
    }

    public function fillAllTables(){
        $this->fillAddressTable();
        $this->fillUserTable();
        $this->fillErrorsTable();
        $this->fillProductTable();
        $this->fillOrdersTable();
        $this->fillOrdersPartsTable();

    }
}
$fill = new SampleDatabaseData();
$fill->fillAllTables();
?>