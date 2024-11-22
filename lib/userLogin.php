<?php
class userLogin extends Ext {
    function get($username) {
        return $this->Core->fetch("SELECT id, password FROM accounts WHERE username = ?", [$username]);
    }
}
?>