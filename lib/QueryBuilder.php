<?php
// Object for building mysql queries using query data

require_once("Query.php");

class QueryBuilder {
    private $queryData;

    public function __construct(Query $query) {
        $this->queryData = $query;
    }

    public function create() {
        $columns = $this->setupColumns($this->queryData->columns);
        $placeholders = implode(", ", array_fill(0, count($this->queryData->columns), "?"));
        return "INSERT INTO {$this->queryData->table} ($columns) VALUES ($placeholders)";
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

    public function update() {
        $setClause = $this->setupSetClause($this->queryData->columns);
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

    private function setupConditions($conditions) {
        for ($i = 0; $i < sizeof($conditions); $i++) {
            $condition = $conditions[$i];
            if ($condition["is_null"]) {
                $conditions[$i] = $condition["column"] . " IS NULL";
            } else {
                $conditions[$i] = $conditions["column"] . " " . $conditions["operator"] . " ?";
            }
        }
        return $conditions;
    }

    private function setupColumns($columns = ["*"]) {
        $columns = sizeof($columns) > 0 ? implode(", ", $columns) : $columns[0];
        return $columns;
    }

    private function setupOrderBy($orderBy) {
        $orderBy = $orderBy["column"] . " " . $orderBy["direction"];
        return $orderBy;
    }

    private function setupSetClause($columns) {
        if (sizeof($columns) > 0) {
            $setClause = implode(", ", array_map(fn($col) => "$col = ?", $columns));
        } else {
            $setClause = implode("", array_map(fn($col) => "$col = ?", $columns));
        }
        return $setClause;
    }
}
