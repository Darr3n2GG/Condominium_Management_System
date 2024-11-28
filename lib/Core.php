<?php

// Core class for database functions like Insert, update, delete, select.

class Core {
    private $conn = null;

    public function __construct(
            $HOST = "localhost",
            $USER = "root",
            $PASSWORD = "",
            $NAME = "exampledb") {
        try {
            $this->conn = mysqli_connect($HOST, $USER, 
                                        $PASSWORD, $NAME);
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

    public function Insert($query, $params=null) : void {
        $stmt = $this->executeStatement($query, $params);
        if (!$stmt) {
            throw new Exception("No rows were inserted.");
        }
        $stmt->close();
    }

    public function Update($query, $params=null) : void {
        $stmt = $this->executeStatement($query, $params);
        $count = $stmt->num_rows;
        if ($count == 0) {
            throw new Exception("No rows were updated.");
        }
        $stmt->close();
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