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
                             (1, 'Jan', 'Kowalski', 'Jan.Kowalski@wp.pl', :password, 1, 1),
                             (2, 'Janusz', 'Polak', 'Janusz.Polak@wp.pl', :password, 1, 2),
                             (3, 'Mateusz', 'Nowak', 'Mateusz.Nowak@wp.pl', :password, 1, 3),
                             (4, 'Piotr', 'Kowal', 'Piotr.Kowal@wp.pl', :password, 1, 4),
                             (5, 'Teresa', 'Kiełbasa', 'Teresa.Kiełbasa@wp.pl', :password, 1, 5),
                             (6, 'Mariola', 'Parówa', 'Mariola.Parówa@wp.pl', :password, 0, 6),
                             (7, 'Jakub', 'Księżyc', 'Jakub.Księżyc@wp.pl', :password, 1, 7),
                             (8, 'Stanisław', 'Psikuta', 'Stanisław.Psikuta@wp.pl', :password, 1, 8),
                             (9, 'Cezary', 'Michota', 'Cezary.Michota@wp.pl', :password, 0, 9),
                             (10, 'Wiktor', 'Kowal', 'Wiktor.Kowal@wp.pl', :password, 1, 10);";
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
                             (1, 'Lublin', 'Kolorowa', 34, '', 'Lublin', '00-000'),
                             (2, 'Warszawa', 'Jagodowa', 31, '', 'Lublin', '00-000'),
                             (3, 'Poznań', 'Borówkowa', 22, '', 'Lublin', '00-000'),
                             (4, 'Zamość', 'Jarzynowa', 3, '', 'Lublin', '00-000'),
                             (5, 'Gdańsk', 'Prusa', 1, '', 'Lublin', '00-000'),
                             (6, 'Katowice', 'Pochmurna', 13, '2C', 'Lublin', '00-000'),
                             (7, 'Gliwice', 'Fantastyczna', 34, '1D', 'Lublin', '00-000'),
                             (8, 'Zabrze', 'Fabryczna', 44, '', 'Lublin', '00-000'),
                             (9, 'Gdynia', 'Kraśnicka', 12, '', 'Lublin', '00-000'),
                             (10, 'Lublin', 'Lwowska', 32, '', 'Lublin', '00-000');";
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
                             (1, 'Błąd logowanie', 1),
                             (2, 'Brak kodu na emailu', 2),
                             (3, 'Błędna walidacja przy logowaniu maila', 3),
                             (4, 'Nieoczekiwany błąd', 4),
                             (5, 'Brak możliwości zmiany adresu', 5),
                             (6, 'Nie wczytujący się obrazek', 6),
                             (7, 'Niezdefiniowany', 7),
                             (8, 'Brak przejścia do płatności', 8),
                             (9, 'Puste zamówienie', 9),
                             (10, 'Usunięty koszyk', 10);";
            
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
                             (1, 'Radeon R9', '4GB pamięci', 2399, 3, 'path1', 1, 'Karta graficzna', 'Nvidia'),
                             (2, 'Intel i5', '4 rdzenie', 999, 10, 'path2', 2, 'Procesor', 'Intel'),
                             (3, 'Speakers', '8 głośników', 399, 28, 'path3', 3, 'Głośniki', 'Realtek'),
                             (4, 'Radeon R9 RS3', '8GB', 2999, 34, 'path4', 4, 'Karta graficzna', 'Nvidia'),
                             (5, 'Intel Atom', '1 rdzeń', 2399, 22, 'path5', 5, 'Procesor', 'Intel'),
                             (6, 'Intel i7', '4 rdzenie', 299, 11, 'path6', 6, 'Procesor', 'Intel'),
                             (7, 'Intel i9', '8 rdzeni', 2999, 32, 'path7', 7, 'Procesor', 'Intel'),
                             (8, 'Mysz gamingowa', '9 przycisków', 99, 33, 'path8', 8, 'Mysz', 'Genesis'),
                             (9, 'Intel Wireless i7892', 'Obsługuje wszystkie standardy WiFi', 2399, 9, 'path9', 9, 'Karta sieciowa', 'Intel'),
                             (10, 'Klawiatura gamingowa', 'Klawiatura mechaniczna', 99, 10, 'path10', 11, 'Klawiatura', 'Genesis');";
            
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
    }
}

$sample = new SampleDatabaseData();
$sample->fillAllTables();
