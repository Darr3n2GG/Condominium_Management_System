<?php
// Core class for CRUD functions.

require_once("QueryBuilder.php");

class Core {
    private $conn;
    private $QueryBuilder;

    public function __construct(
        $HOST = "localhost",
        $USER = "root",
        $PASSWORD = "",
        $NAME = "condodb"
    ) {
        try {
            $this->conn = new mysqli(
                $HOST,
                $USER,
                $PASSWORD,
                $NAME
            );
            if ($this->conn->connect_error) {
                throw new Exception("Failed to connect to MySQL: " . $this->conn->connect_error);
            }

            $this->QueryBuilder = new QueryBuilder;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function create($table, array $params = null): void {
        $query = $this->QueryBuilder
            ->table($table)
            ->insert($params);
        $stmt = $this->executeStatement($query);
        if (!$stmt) {
            throw new Exception("No rows were inserted.");
        }
        $stmt->close();
    }

    public function read($table, array $params = null, array $conditions = null): array {
        $query = $this->QueryBuilder
            ->table($table)
            ->select($params)
            ->where($conditions[0], $conditions[1], $conditions[2]);
        $stmt = $this->executeStatement($query, $params);
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function update($query, $params = null): void {
        $stmt = $this->executeStatement($query, $params);
        if (!$stmt) {
            throw new Exception("No rows were updated.");
        }
        $stmt->close();
    }

    public function delete($query, $params = null): void {
        $this->executeStatement($query, $params)->close();
    }

    private function executeStatement($query, $params = null) {
        try {
            if (!$stmt = $this->conn->prepare($query)) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }
            $stmt->execute($params);
            return $stmt;
        } catch (Exception $e) {
            echo "Message : " . $e->getMessage();
        }
    }
}
