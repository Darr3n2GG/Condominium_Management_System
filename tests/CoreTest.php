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
        
        $result = $this->core->select($query, $params);
        
        $this->assertIsArray($result);
    }

    // public function testInsert() {
    //     $query = "INSERT INTO accounts (username) VALUES (?)";
    //     $params = ["Test Name"];
        
    //     $this->core->insert($query, $params);
        
    //     $query = "SELECT * FROM accounts WHERE username = ?";
    //     $expected_results = $this->core->select($query, $params);

    //     $this->assertEquals($expected_results);
    //     $this->core->remove("DELETE FROM accounts WHERE username = ?", ['Test Name']);
    // }

    public function testUpdate() {
        $query = "UPDATE accounts SET username = ? WHERE id = ?";
        $params = ["Updated Name", 1];

        $this->core->update($query, $params);
        
        $result = $this->core->select("SELECT * FROM accounts WHERE id = ?", [1]);
        $this->assertEquals("Updated Name", $result[0]["username"]);
    }

    public function testRemove() {
        $query = "DELETE FROM accounts WHERE id = ?";
        $params = [1];

        $this->core->remove($query, $params);
        
        $result = $this->core->select("SELECT * FROM accounts WHERE id = ?", [1]);
        $this->assertCount(0, $result);
    }

    protected function tearDown(): void {
        $this->core = null;
    }
}
?>