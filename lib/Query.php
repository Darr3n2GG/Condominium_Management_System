<?php
// Data structure for a mysql query

class Query {
    const ASC = "ASC";
    const DESC = "DESC";
    public string $table = "";
    public array $columns = [];
    public array $conditions = [];
    public string $limit = "";
    public array $orderBy = [];

    public function setConditions(array $conditions): void {
        for ($i = 0; $i < sizeof($conditions); $i++) {
            $condition = $conditions[$i];
            $this->conditions[$i] = [
                "column" => $condition[0],
                "operator" => $condition[1],
                "is_null" => $condition[2]
            ];
        }
    }

    public function setOrderBy(string $column, string $direction): void {
        $this->orderBy = ["column" => $column, "direction" => $direction];
    }
}
