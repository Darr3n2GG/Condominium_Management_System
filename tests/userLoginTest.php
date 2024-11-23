<?php
use PHPUnit\Framework\TestCase;


class UserLoginTest extends TestCase {
    function testGet() {
        $userLogin = new userLogin;

        $expectedResult = [
            "id" => 1,
            "password" => "test"
        ];

        $result = $userLogin->get("test");

        $this->assertSame($expectedResult, $result);
    }

    // function testGetWithInvalidUsername() {
    //     // Act
    //     $result = $_CORE->userLogin->get("1");

    //     // Assert
    //     $this->assertNull($result);
    // }
}
?>
