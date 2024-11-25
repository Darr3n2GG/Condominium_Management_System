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

    public function testGetResultWithValidQuery() {
        $query = "SELECT * FROM accounts WHERE id = ?";
        $params = [1];
        
        $result = $this->core->get_result($query, $params);
        
        $this->assertInstanceOf(mysqli_result::class, $result);
        
        $this->assertGreaterThan(0, $result->num_rows, "Expected at least one result.");
    }

    protected function tearDown(): void {
        $this->core = null;
    }
}
?>