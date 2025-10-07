<?php

class AdminMessagesController extends Controller
{
    use Database;
    public function messages()
    {
        $conversation = new Conversations;
        $messages = new Messages;
        $data = json_decode(file_get_contents('php://input'), true);

        $subject = htmlspecialchars($data['subject']);
        $message = htmlspecialchars($data['message']);
        $status = htmlspecialchars($data['status']);

        $student_id = $_SESSION['STUDENT']->id;
        $college_id = $_SESSION['STUDENT']->college_id;

        $conversation_id = $conversation->insert([
            'subject' => $subject,
            'student_id' => $student_id,
            'college_id' => $college_id,
            'subject' => $subject,
            'status' => $status

        ]);
        $messages->insert([
            'conversation_id' => $conversation_id,
            'sender_type' => 'admin',
            'sender_id' => $student_id,
            'receiver_type' => 'student',
            'message_text' => $message,
        ]);



        echo json_encode(['message' => $message, 'subject' => $subject, 'status' => $status]);
    }


    public function reply($conversation_id)
    {
        $messages = new Messages;

        $data = json_decode(file_get_contents('php://input'), true);
        $reply_message = htmlspecialchars($data['reply_message']);
        $college_id = $_SESSION['COLLEGE']->id;

        $messages->insert([
            'conversation_id' => $conversation_id,
            'sender_type' => 'admin',
            'sender_id' => $college_id,
            'receiver_type' => 'student',
            'message_text' => $reply_message,
        ]);
        echo json_encode(['reply_message' => $reply_message]);
    }


    public function conversationFetch($conversation_id)
    {
        $conversations = new Conversations;
        $messages = new Messages;
        $student = new Student;

        $conversation = $conversations->first(['id' => $conversation_id]);

        if (!$conversation->is_read_by_admin) {
            $conversations->update(['id' => $conversation_id], ['is_read_by_admin' => 1]);
        }

        if ($conversation) {

            $conversation->messages = $messages->where(['conversation_id' => $conversation_id]);
            $conversation->student = $student->first(['id' => $conversation->student_id]);

            echo json_encode(['conversation' => $conversation]);
        } else {
            echo json_encode(['message' => 'failed']);
        }
    }

    public function updateStatus($conversation_id)
    {
        $conversations = new Conversations;
        $data = json_decode(file_get_contents('php://input'), true);
        $status = htmlspecialchars($data['status']);

        $conversations->update(['id' => $conversation_id], ['status' => $status]);

        echo json_encode(['message' => "success"]);
    }

    public function getMessageStats($college_id = '')
    {
        $conversations = new Conversations;

        $total_conversations = $conversations->count(['college_id' => $college_id]);
        $open_conversations = $conversations->count(['college_id' => $college_id, 'status' => 'open']);
        $closed_conversations = $conversations->count(['college_id' => $college_id, 'status' => 'resolved']);
        echo json_encode(['total_conversations' => $total_conversations, 'open_conversations' => $open_conversations, 'closed_conversations' => $closed_conversations]);
    }
}
