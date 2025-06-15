<?php

class Categories
{
    use Model;

    protected $table = 'categories';

    protected $allowedColumns = [
        'id',
        'canteen_id',
        'name'
    ];
}
