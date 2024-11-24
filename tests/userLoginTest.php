<?php
use PHPUnit\Framework\TestCase;


class UserLoginTest extends TestCase {
    function testGetId() {
        $userLogin = new userLogin;

        $expectedResult = 1;

        $row = $userLogin->getIdAndPasswordFrom("test");
        $result = $row["id"];

        $this->assertEquals($expectedResult, $result);
    }

    function testGetPassword() {
        $userLogin = new userLogin;

        $expectedResult = "test";

        $row = $userLogin->getIdAndPasswordFrom("test");
        $result = $row["password"];

        $this->assertTrue(password_verify($expectedResult, $result));
    }
}
?>
