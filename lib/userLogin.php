<?php
require_once("Core.php");

class userLogin extends Core {
    function login($username, $password) {
        $this->getIdAndPasswordFrom($username);
    }
    function getIdAndPasswordFrom($username) : array{
        $results = $this->getResult("SELECT id, password FROM accounts WHERE username = ?",[$username]);
        $row = $this->fetchRow($results);
        return $row;    
    }
}
?>