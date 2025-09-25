<?php


class Managers
{
    use Model;

    protected $table = 'managers';

    protected $allowedColumns = [
        'id',
        'name',
        'email',
        'phone',
        'adress',
        'experience',
        'canteen_id',



    ];
}
