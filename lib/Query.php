<?php
// Data structure for a mysql query

class Query {
    public string $table = "";
    public array $columns = [];
    public array $conditions = [];
    public string $limit = "";
    public OrderBy $orderBy;

    public function setConditions($conditions): void {
        $this->conditions = $conditions;
    }
}

abstract class Condition {
    public $column;
    public $operator;

    public function __construct(string $column, string $operator) {
        $this->column = $column;
        $this->operator = $operator;
    }
}

class NullCondition {
    public $column;

    public function __construct(string $column) {
        $this->column = $column;
    }
}

class OrderBy {
    const ASC = "ASC";
    const DESC = "DESC";
    public $column;
    public $direction;

    public function __construct($column, $direction) {
        $this->$column = $column;
        $this->direction = $direction;
    }
}
