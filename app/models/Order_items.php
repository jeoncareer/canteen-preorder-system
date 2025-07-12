<?php
class Order_items
{
    use Model;
    protected $table = 'order_items';

    protected $allowedColumns = [
        'id',
        'order_id',
        'item_id',
        'quantity'
    ];
}
