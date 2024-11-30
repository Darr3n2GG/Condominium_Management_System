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
        if (isset($this->queryData->conditions)) {
            $query = $this->appendWhereQuery($query, $this->queryData->conditions);
        }
        if (isset($this->queryData->orderBy)) {
            $query = $this->appendOrderByQuery($query, $this->queryData->orderBy);
        }
        if (isset($this->queryData->limit)) {
            $query .= " LIMIT {$this->queryData->limit}";
        }
        return $query;
    }

    public function update() {
        $set_clause = $this->setupSetClause($this->queryData->columns);
        $query = "UPDATE {$this->queryData->table} SET $set_clause";
        if (isset($this->queryData->conditions)) {
            $query = $this->appendWhereQuery($query, $this->queryData->conditions);
        }
        return $query;
    }

    public function delete() {
        $query = "DELETE FROM {$this->queryData->table}";
        if (isset($this->queryData->conditions)) {
            $query = $this->appendWhereQuery($query, $this->queryData->conditions);
        }
        return $query;
    }

    private function appendWhereQuery($query, $conditions) {
        $array_of_conditions = $this->setupConditions($conditions);
        $query .= " WHERE " . implode(" AND ", $array_of_conditions);
        return $query;
    }

    private function appendOrderByQuery($query, $orderBy) {
        $order_by = $this->setupOrderBy($orderBy);
        $query .= " ORDER BY {$order_by}";
        return $query;
    }

    private function setupConditions(Conditions $conditions) {
        for ($i = 0; $i < sizeof($conditions); $i++) {
            $condition = $conditions[$i];
            if ($condition instanceof NullCondition) {
                $array_of_conditions[$i] = $condition->column . " IS NULL";
            } else {
                $array_of_conditions[$i] = $condition->column . " " . $condition->operator . " ?";
            }
        }
        return $array_of_conditions;
    }

    private function setupColumns($columns = ["*"]) {
        $columns = sizeof($columns) > 0 ? implode(", ", $columns) : $columns[0];
        return $columns;
    }

    private function setupOrderBy(OrderBy $orderBy) {
        $order_by = $orderBy->column . " " . $orderBy->direction;
        return $order_by;
    }

    private function setupSetClause($columns) {
        $set_clause = implode(", ", array_map(fn($col) => "$col = ?", $columns));
        return $set_clause;
    }
}
