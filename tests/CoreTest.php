<?php
use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase {
    private $core;

    protected function setUp(): void {
        $this->core = new Core;
    }

    public function testConnection() {
        $reflection = new ReflectionClass($this->core);
        $connProperty = $reflection->getProperty('conn');
        $connProperty->setAccessible(true);
        $this->assertNotNull($connProperty->getValue($this->core), "Database connection should be established.");
    }

    public function testSelect() {
        $query = "SELECT * FROM accounts WHERE id = ?";
        $params = [1];
        
        $result = $this->core->Select($query, $params);
        
        $this->assertIsArray($result);
    }

    // public function testInsert() {
    //     $query = "INSERT INTO accounts (username) VALUES (?)";
    //     $params = ["Test Name"];
        
    //     $this->core->Insert($query, $params);
        
    //     $query = "SELECT * FROM accounts WHERE username = ?";
    //     $expected_results = $this->core->Select($query, $params);

    //     $this->assertEquals($expected_results);
    //     $this->core->Remove("DELETE FROM accounts WHERE username = ?", ['Test Name']);
    // }

    public function testUpdate() {
        $query = "UPDATE accounts SET username = ? WHERE id = ?";
        $params = ["Updated Name", 1];

        $this->core->Update($query, $params);
        
        $result = $this->core->Select("SELECT * FROM accounts WHERE id = ?", [1]);
        $this->assertEquals("Updated Name", $result[0]["username"]);
    }

    public function testRemove() {
        $query = "DELETE FROM accounts WHERE id = ?";
        $params = [1];

        $this->core->Remove($query, $params);
        
        $result = $this->core->Select("SELECT * FROM accounts WHERE id = ?", [1]);
        $this->assertCount(0, $result);
    }

    protected function tearDown(): void {
        $this->core = null;
    }
}
?>