<?php
// Data structure for a mysql query

class Query {
    public string $table;
    public array $columns;
    public Conditions $conditions;
    public string $limit;
    public OrderBy $orderBy;
}

class Conditions extends ArrayObject {
    public $conditions;

    public function __construct(Condition ...$conditions) {
        $this->conditions = $conditions;
    }
}

class Condition {
    public $column;
    public $operator;
}

class OperatorCondition extends Condition {
    public function __construct(string $column, string $operator) {
        $this->column = $column;
        $this->operator = $operator;
    }
}

class NullCondition extends Condition {
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
