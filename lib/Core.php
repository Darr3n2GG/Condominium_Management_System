<?php
class Core {
    private $DATABASE_HOST = "localhost";
    private $DATABASE_USER = "root";
    private $DATABASE_PASS = "";
    private $DATABASE_NAME = "exampledb";
    public $conn = null;
    public $stmt = null;

    function __construct() {
        $this->conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

        if (mysqli_connect_errno()) {
            exit("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    function __destruct() {
        if ($this->conn) { $this->conn->close(); }
        if($this->stmt) { $this->stmt->close(); }
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
}
?>