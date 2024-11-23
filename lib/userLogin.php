<?php
class userLogin extends Core {
    function get($username) {
        return $this->fetch("SELECT id, password FROM accounts WHERE username = ?", [$username]);
    }
}
?>