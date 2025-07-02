<?php

class Cart
{
    use Model;

    protected $table = 'cart';

    protected $allowedColumns = [
        'item_id',
        'student_id',
        'count'
    ];
}
