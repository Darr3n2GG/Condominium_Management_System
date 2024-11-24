<?php
use PHPUnit\Framework\TestCase;


class UserLoginTest extends TestCase {
    function testGetId() {
        $UserLogin = new UserLogin;

        $expectedResult = 1;

        $result = $UserLogin->get_id_from("test");

        $this->assertEquals($expectedResult, $result);
    }

    function testGetPassword() {
        $UserLogin = new UserLogin;

        $expectedResult = "test";

        $result = $UserLogin->get_password_from("test");

        $this->assertTrue(password_verify($expectedResult, $result));
    }
}
?>
