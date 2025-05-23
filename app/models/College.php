<?php


class College
{
    use Model;

    protected $table = 'college';

    protected $allowedColumns = [
        'id',
        'college_name'
    ];


    
}