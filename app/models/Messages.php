<?php


class Messages
{
    use Model;

    protected $table = 'messages';

    protected $allowedColumns = [
        'id',
        'conversation_id',
        'sender_type',
        'receiver_type',
        'message_text',
        'created_at',
        'sender_id'


    ];
}
