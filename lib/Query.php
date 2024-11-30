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
    public function __call($func, $argv) {
        if (!is_callable($func) || substr($func, 0, 6) !== 'array_') {
            throw new BadMethodCallException(__CLASS__ . '->' . $func);
        }
        return call_user_func_array($func, array_merge(array($this->getArrayCopy()), $argv));
    }
}

class Condition {
    public $column;
    public $operator;
    public $direction;

    public function __construct(string $column, string $operator) {
        $this->column = $column;
        $this->operator = $operator;
    }
}

class NullCondition extends Condition {
    // overrides parent class construct function
    public function __construct(string $column) {
        $this->column = $column;
    }
}

class OrderBy extends Condition {
    const ASC = "ASC";
    const DESC = "DESC";

    // overrides parent class construct function
    public function __construct($column, $direction) {
        $this->$column = $column;
        $this->direction = $direction;
    }
}
