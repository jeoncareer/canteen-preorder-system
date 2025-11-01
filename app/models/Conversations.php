<?php


class Conversations
{
    use Model;

    protected $table = 'conversations';

    protected $allowedColumns = [
        'id',
        'student_id',
        'college_id',
        'subject',
        'created_at',
        'updated_at',
        'status',
        'is_read_by_admin',
        'is_read_by_student'
    ];
}
