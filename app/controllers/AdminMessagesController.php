<?php

class AdminMessagesController extends Controller
{
    use Database;
    public function messages()
    {
        $conversation = new Conversations;
        $messages = new Messages;
        $data = json_decode(file_get_contents("php://input"), true);
        $college_id = $_SESSION['COLLEGE']->id;
    }
}
