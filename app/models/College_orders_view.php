<?php
class College_orders_view{


    use Model;
    protected $table = 'college_orders_view';
    protected $allowedColumns = [
        'id',
        'canteen_id',
        'order_id',
        'college_name',
        'canteen_name',
        'college_email',
        'canteen_email'
    ];
}