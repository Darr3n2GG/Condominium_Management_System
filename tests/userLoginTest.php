<?php
use PHPUnit\Framework\TestCase;

class UserLoginTest extends TestCase {
    // function setUp() : void {
    //     require_once "lib/CORE-Go.php";
    //     $_CORE->load("userLogin");
    // }

    function testGet() {
        // Arrange
        require_once "lib/CORE-Go.php";
        $_CORE->load("userLogin");
        $expectedResult = [
            "id" => 1,
            "password" => "test"
        ];

        $result = $_CORE->userLogin->get("test");

        $this->assertSame($expectedResult, $result);
    }

    function testGetWithInvalidUsername() {
        // Act
        $result = $_CORE->userLogin->get("1");

        // Assert
        $this->assertNull($result);
    }
}
?>
