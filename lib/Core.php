<?php
class Core {
    public $conn = null;
    public $stmt = null;

    function __construct() {
        $this->conn = mysqli_connect($DATABASE_HOST = "localhost", $DATABASE_USER = "root", $DATABASE_PASS = "", $DATABASE_NAME = "exampledb");

        if (mysqli_connect_errno()) {
            exit("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    function __destruct() {
        $this->conn->close();
    }

    function exec($query, $params=[]) : void{
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($params);
    }

    function getResult($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->get_result();
    }

    function fetchRow($results) {
        return $results->fetch_assoc();
    }

    function fetchAll($sql, $data=null) {
        $this->exec($sql, $data);
        return $this->stmt->fetchAll();
    }
    
}
?>