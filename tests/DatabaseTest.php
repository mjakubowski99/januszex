<?php declare(strict_types=1);
require __DIR__.'/../autoloader.php';
require __DIR__.'/../creator/RefreshDatabase.php';

use PHPUnit\Framework\TestCase;
use app\database\Database;
use app\config\DatabaseConnector;

final class DatabaseTest extends TestCase
{
    public function testConnection(){
        $conn = ( new DatabaseConnector() )->getConnection();
        $this->assertTrue($conn instanceof PDO);
    }

    public function testSafeDeleteDataFromDatabase(): void
    {
        $refresh = new RefreshDatabase();
        $refresh->delete();

        $db = new Database();
        $query = "SELECT count(*) as count FROM users";
        $row = $db->execute($query);

        $this->assertEquals(0, $row['count']);
    }

   public function testRefreshDatabaseData(){
        $refresh = new RefreshDatabase();
        $refresh->refresh();

        $db = new Database();
        $query = "SELECT count(*) as count FROM users";
        $row = $db->execute($query);

        $this->assertGreaterThan(0, $row['count']);
    }

}