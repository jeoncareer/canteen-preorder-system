<?php

class Canteen_orders_view
{
    use Model;
    protected $table = 'canteen_orders_view';
    public function __construct()
    {
        
        $this->order_column = 'time';
    }
    protected $allowedColumns = [
        'canteen_id',
        'order_id',
        'time',
        'total',
        'status'

    ];
}