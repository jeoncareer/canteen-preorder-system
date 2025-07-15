<?php



class Orders
{
    use Model;


    protected $table = "orders";

    protected $allowedColumns = [
        'id',
        'canteen_id',
        'student_id',
        'time',
        'status',
        'total'
    ];
}
