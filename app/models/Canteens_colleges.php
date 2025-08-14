<?php
class Canteens_colleges
{
    use Model;
    protected $table = 'order_items';

    protected $allowedColumns = [
        'canteen_id',
        'college_id',
      'canteen_name',
      'college_name',
      'canteen_email',
      'college_email',

    ];
}
