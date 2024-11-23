<?php
require_once("Core.php");

class userLogin extends Core {
    function login($username, $password) {
        $this->get($username);
    }s
    function get($username) : array{
        $results = $this->get_result("SELECT id, password FROM accounts WHERE username = ?",[$username]);
        $row = $results->fetch_assoc();
        return $row;    
    }
}
?>