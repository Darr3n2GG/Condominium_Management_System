<?php
class Core {
    public $error = "";
    public $con = null;
    public $stmt = null;
    public $loaded = [];

    function __construct() {
        $this->con = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

        if (mysqli_connect_errno()) {
            exit("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    function __destruct() {
        if ($this->stmt) {
            $this->stmt->close();
        }
        if ($this->con) {
            $this->con->close();
        }
    }

    function exec($sql, $data=null) : void {
        $this->stmt = $this->con->prepare($sql);
        $this->stmt->execute($data);
    }

    function fetch($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->fetch();
    }

    function fetchAll($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->fetchAll();
    }

    function fetchAllAndArrangeByString($sql, $data=null, string $arrange=null) {
        $data = [];

        while ($r = $this->stmt->fetch()) {
            $data[$r[$arrange]] = $row;
        }

        return $data;
    }

    function fetchAllAndArrangeByArray($sql, $data=null, array $arrange=null) {
        $data = [];

        while ($r = $this->stmt->fetch()) {
            $data[$r[$arrange[0]]] = $r[$arrange[1]];
        }

        return $data;
    }

    function load($module) : void {
        if (isset($this->loaded[$module])) {
            return;
        }

        $file = PATH_LIB . "$module.php";
        if (file_exists($file)) {
            require $file;
            $this->loaded[$module] = new $module($this);
        } else {
            throw new Exception("$module module not found!");
        }
    }

    function __get($name) {
        if (isset($this->loaded[$name])) {
            return $this->loaded[$name];
        }
    }
}

class Ext {
    public $Core;
    public $error;

    function __construct($core) {
        $this->Core =& $core;
        $this->error =& $core->error;
    }
    
    function __get($name) {
        if (isset($this->Core->loaded[$name])) {
            return $this->Core->loaded[$name]; 
        }
    }
}
?>
