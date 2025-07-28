<?php

//Main model trait


trait Model
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    // function test()
    // {
    //     $query = "select * from users";
    //     $result = $this->query($query);
    //     show($result);
    // }

    public function findAll()
    {

        $query = " select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset ";


        return $this->query($query);
    }


    public function where($data, $data_not = [], $limit = '')
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }
        $query = trim($query, " AND ");

        $query .= " order by $this->order_column $this->order_type ";

        if (!empty($limit)) {
            $query .= " limit $this->limit offset $this->offset ";
        }

        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        //remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
            foreach ($data_not as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data_not[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }
        $query = trim($query, " AND ");
        $query .= " limit $this->limit offset $this->offset ";
        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        }
    }

    public function insert($data)
    {
        //remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        //shxow($query);
        return $this->query($query, $data, true);
    }

    public function update($whereConditions = [], $data = [])
    {
        // Remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        // Build SET part
        $query = "UPDATE {$this->table} SET ";
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
        }
        $query .= implode(", ", $setParts);

        // Build WHERE clause
        if (!empty($whereConditions)) {
            $whereParts = [];
            foreach ($whereConditions as $key => $value) {
                $whereParts[] = "$key = :where_$key";
                $data["where_$key"] = $value; // Use separate param name to avoid conflict
            }
            $query .= " WHERE " . implode(" AND ", $whereParts);
        }

        //show($query); // For debugging
        $this->query($query, $data);

        return true;
    }




    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";

        $this->query($query, $data);
    }

    public function get_enum($table_name, $column_name)
    {

        $query = "SELECT COLUMN_TYPE 
                  FROM INFORMATION_SCHEMA.COLUMNS
                  WHERE TABLE_NAME = '" . $table_name . "'
                  AND COLUMN_NAME = '" . $column_name . "'";
        $result = $this->query($query);
        return $result;
    }


    public function count($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select COUNT(*) as count from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }
        $query = trim($query, " AND ");


        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }


    public function join($joins = [], $where = [], $selectColumns = '*', $order_type = '', $order_by = '', $limit = '')
    {
        $query = "SELECT {$selectColumns} FROM {$this->table} ";

        // Build JOINs
        foreach ($joins as $table => $onCondition) {
            $query .= "JOIN {$table} ON {$onCondition} ";
        }

        // Build WHERE clause
        if (!empty($where)) {
            $query .= "WHERE ";
            foreach ($where as $condition => $value) {
                // Check if condition includes a space (i.e., has an operator)
                if (preg_match('/(.+)\s(>=|<=|<>|!=|=|>|<|LIKE)$/i', $condition, $matches)) {
                    $column = $matches[1];
                    $operator = $matches[2];
                } else {
                    $column = $condition;
                    $operator = '=';
                }

                $placeholder = str_replace(['.', ' '], '_', $column);
                $query .= "$column $operator :$placeholder AND ";
                $where[$placeholder] = $value;
                unset($where[$condition]);
            }

            $query = rtrim($query, ' AND ');
        }

        if (!empty($order_by)) {
            $this->order_column = $order_by;
        }

        if (!empty($order_type)) {
            $this->order_type = $order_type;
        }

        // Optional ordering

        $query .= " ORDER BY {$this->order_column} {$this->order_type}";

        if (!empty($limit)) {
            $this->limit = $limit;
            $query .= " LIMIT {$this->limit} OFFSET {$this->offset}";
        }
        //show($query);
        return $this->query($query, $where);

        // example

        // $results = $cart->join(
        //     ['items', 'students'],
        //     ['cart.item_id = items.id', 'cart.student_id = students.id'],
        //     ['cart.student_id' => 11], // where condition
        //     'cart.*, items.item_name, students.name'
        // );
    }
}
