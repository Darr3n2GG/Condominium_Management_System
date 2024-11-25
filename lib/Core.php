<?php
class Core {
    private $conn = null;

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

    public function select($query, $params=null) : array {
        $stmt = $this->execute_statement($query, $params);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
        $stmt->close();

        return $result;
    }

    public function insert($query, $params=null) : string {
        $stmt = $this->execute_statement($query, $params)->close();

        return $this->conn->insert_id();
    }

    public function update($query, $params=null) : void {
        $this->execute_statement($query, $params)->close();
    }

    public function remove($query, $params=null) : void {
        $this->execute_statement($query ,$params)->close();
    }

    private function execute_statement($query, $params=null) {
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