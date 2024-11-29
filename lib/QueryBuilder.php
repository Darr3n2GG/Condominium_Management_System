<?php
require_once("Query.php");

class QueryBuilder {
    private $queryData;

    public function __construct(Query $query) {
        $this->queryData = $query;
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        return "INSERT INTO {$this->queryData->table} ($columns) VALUES ($placeholders)";
    }

    public function update($data) {
        $setClause = implode(", ", array_map(fn($col) => "$col = ?", array_keys($data)));
        $query = "UPDATE {$this->queryData->table} SET $setClause";
        if ($this->queryData->conditions) {
            $conditions = $this->setupConditions($this->queryData->conditions);
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        return $query;
    }

    public function delete() {
        $query = "DELETE FROM {$this->queryData->table}";
        if ($this->queryData->conditions) {
            $conditions = $this->setupConditions($this->queryData->conditions);
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        return $query;
    }

    public function read() {
        $columns = $this->setupColumns($this->queryData->columns);
        $query = "SELECT {$columns} FROM {$this->queryData->table}";
        if ($this->queryData->conditions) {
            $conditions = $this->setupConditions($this->queryData->conditions);
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        if ($this->queryData->orderBy) {
            $orderBy = $this->setupOrderBy($this->queryData->orderBy);
            $query .= " ORDER BY {$orderBy}";
        }
        if ($this->queryData->limit) {
            $query .= " LIMIT {$this->queryData->limit}";
        }
        return $query;
    }

    private function setupConditions($conditions) {
        for ($i = 0; $i < sizeof($conditions) - 1; $i++) {
            $conditions[$i] = $conditions["column"] . " "  . $conditions["operator"] . " ?";
        }
        return $conditions;
    }

    private function setupColumns($columns = "*") {
        $columns = is_array($columns) ? implode(", ", $columns) : $columns;
        return $columns;
    }

    private function setupOrderBy($orderBy) {
        $orderBy = $orderBy["column"] . " " . $orderBy["direction"];
        return $orderBy;
    }
}
