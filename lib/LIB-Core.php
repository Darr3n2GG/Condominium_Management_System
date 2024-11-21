<?php
class Core {
    public $error = "";
    public $con = null;
    public $stmt = null;
    public $loaded = [];

    public function __construct() {
        $this->con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

        if (mysqli_connect_errno()) {
            exit("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    public function __destruct() {
        if ($this->stmt) {
            $this->stmt->close();
        }
        if ($this->con) {
            $this->con->close();
        }
    }

    public function exec($sql, $data=null) : void {
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($data);
    }

    public function fetch($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->fetch();
    }

    public function fetchAll($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->fetchAll();
    }

    public function fetchAndArrangeByString($sql, $data=null, string $arrange=null) {
        $data = [];

        while ($r = $this->stmt->fetch()) {
            $data[$r[$arrange]] = $row;
        }

        return $data;
    }

    public function fetchAndArrangeByArray($sql, $data=null, array $arrange=null) {
        $data = [];

        while ($r = $this->stmt->fetch()) {
            $data[$r[$arrange[0]]] = $r[$arrange[1]];
        }

        return $data;
    }

    public function load($module) : void {
        if (isset($this->loaded[$module])) {
            return;
        }

        $file = PATH_LIB . "LIB-$module.php";
        if (file_exists($file)) {
            require $file;
            $this->loaded[$module] = new $module($this);
        } else {
            throw new Exception("$module module not found!");
        }
    }

    public function __get($name) {
        if (isset($this->loaded[$name])) {
            return $this->loaded[$name];
        }
    }
}

class Ext {
    public $Core;
    public $error;

    public function __construct($core) {
        $this->Core =& $core;
        $this->error =& $core->error;
    }
    
    public function __get($name) {
        if (isset($this->Core->loaded[$name])) {
            return $this->Core->loaded[$name]; 
        }
    }
}
?>
