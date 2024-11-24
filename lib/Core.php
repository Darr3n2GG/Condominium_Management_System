<?php
class Core {
    private $conn = null;
    private $stmt = null;

    public function __construct($DATABASE_HOST = "localhost", $DATABASE_USER = "root", $DATABASE_PASSWORD = "", $DATABASE_NAME = "exampledb") {
        try {
            $this->conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME);

            if (mysqli_connect_errno()) {
                throw New Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }

        catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function __destruct() {
        if ($this->conn) { $this->conn->close(); }
    }

    private function execute_statement($query, $params=null) : void {
        try {
            $this->stmt = $this->conn->prepare($query);
            if($this->stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            $this->stmt->execute($params);
        }
        
        catch (Exception $e) {
            echo "Message :" . $e->getMessage();
        }
    }

    public function get_result($query, $params=null) {
        try {
            $this->execute_statement($query, $params);
            $results = $this->stmt->get_result();
            if (!$results) {
                throw New Exception("No results");
            }

            return $results;
        } 
        
        catch (Exception $e) {
            echo "Message :" . $e->getMessage();
        }
    }

    function fetchAll($query, $params=null) {
        $this->execute_statement($query, $params);
        return $this->stmt->fetchAll();
    }
}
?>