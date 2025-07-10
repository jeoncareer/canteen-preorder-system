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


    public function where($data, $data_not = [])
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
        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset ";

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

    public function update($id, $data, $id_column = 'id')
    {
        //remove unwanted data
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $query = "update $this->table set ";
        $keys = array_keys($data);

        foreach ($keys as $key) {
            $query .= $key . "= :" . $key . ",";
        }

        $data[$id_column] = $id;
        $query = trim($query, ",");
        $query .= " where " . $id_column . "= :" . $id_column . ";";
        show($query);
        $this->query($query, $data);


        return false;
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


    public function join($mainTable, $joins = [], $where = [], $selectColumns = '*', $order_type = '', $order_by = '')
    {
        $query = "SELECT {$selectColumns} FROM {$mainTable} ";

        // Build JOINs
        foreach ($joins as $table => $onCondition) {
            $query .= "JOIN {$table} ON {$onCondition} ";
        }

        // Build WHERE clause
        if (!empty($where)) {
            $query .= "WHERE ";
            foreach ($where as $key => $value) {
                $placeholder = str_replace('.', '_', $key);  // cart.student_id → cart_student_id
                $query .= "$key = :$placeholder AND ";
                $where[$placeholder] = $value;               // new key-value pair
                unset($where[$key]);                         // remove old key
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
        $query .= " ORDER BY {$this->order_column} {$this->order_type} LIMIT {$this->limit} OFFSET {$this->offset}";
        show($query);
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
