<?php
use PHPUnit\Framework\TestCase;


class UserLoginTest extends TestCase {
    function testGetId() {
        $userLogin = new userLogin;

        $expectedResult = 1;

        $row = $userLogin->get("test");
        $result = $row["id"];

        $this->assertEquals($expectedResult, $result);
    }

    function testGetPassword() {
        $userLogin = new userLogin;

        $expectedResult = "test";

        $row = $userLogin->get("test");
        $result = $row["password"];

        $this->assertTrue(password_verify($expectedResult, $result));
    }
}
?>
