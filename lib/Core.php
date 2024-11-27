<?php

// Core class for database functions like Insert, update, delete, select.

class Core {
    private $conn = null;

    public function __construct(
            $DATABASE_HOST = "localhost",
            $DATABASE_USER = "root",
            $DATABASE_PASSWORD = "",
            $DATABASE_NAME = "exampledb") {
        try {
            $this->conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, 
                                        $DATABASE_PASSWORD, $DATABASE_NAME);
            if ($this->conn->connect_error) {
                throw New Exception("Failed to connect to MySQL: " . $this->conn->connect_error);
            }
        }

        catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function __destruct() {
        if ($this->conn) { $this->conn->close(); }
    }

    public function Select($query, $params=null) : array {
        $stmt = $this->executeStatement($query, $params);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
        $stmt->close();
        return $result;
    }

    public function Insert($query, $params=null) {
        $stmt = $this->executeStatement($query, $params);
        $stmt->close();
    }

    public function Update($query, $params=null) : void {
        $this->executeStatement($query, $params)->close();
    }

    public function Remove($query, $params=null) : void {
        $this->executeStatement($query ,$params)->close();
    }

    private function executeStatement($query, $params=null) {
        try {
            if(!$stmt = $this->conn->prepare($query)) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            $stmt->execute($params);
            return $stmt;
        }
        
        catch (Exception $e) {
            echo "Message : " . $e->getMessage();
        }
    }
}
?>