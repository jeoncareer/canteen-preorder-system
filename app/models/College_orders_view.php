<?php
class College_orders_view
{


    use Model;
    protected $table = 'college_orders_view';
    public function __construct()
    {

        $this->order_column = 'time';
    }
    protected $allowedColumns = [
        'id',
        'college_id',
        'canteen_id',
        'order_id',
        'college_name',
        'canteen_name',
        'college_email',
        'canteen_email'
    ];
}
