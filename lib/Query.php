<?php
// Data structure for a mysql query

class Query {
    public string $table;
    public array $columns;
    public array $conditions; //Format is: ["column" => "", "operator" => ""]
    public string $limit;
    public array $orderBy; // Format is: ["column" => "", "direction" => ""]
}
