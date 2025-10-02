
<?php

class MessagesController extends Controller
{
    use Database;

    public function messages()
    {

        $conversation = new Conversations;
        $messages = new Messages;
        $data = json_decode(file_get_contents('php://input'), true);

        $subject = htmlspecialchars($data['subject']);
        $message = htmlspecialchars($data['message']);
        $student_id = $_SESSION['STUDENT']->id;
        $college_id = $_SESSION['STUDENT']->college_id;

        $conversation_id = $conversation->insert([
            'subject' => $subject,
            'student_id' => $student_id,
            'college_id' => $college_id,
            'subject' => $subject,
            'status' => 'open'

        ]);
        $messages->insert([
            'conversation_id' => $conversation_id,
            'sender_type' => 'student',
            'sender_id' => $student_id,
            'receiver_type' => 'admin',
            'message_text' => $message,
        ]);



        echo json_encode(['message' => $message, 'subject' => $subject]);
    }


    public function reply($conversation_id)
    {
        $messages = new Messages;


        $reply_message = htmlspecialchars($_GET['reply_message']);
        $student_id = $_SESSION['STUDENT']->id;

        $messages->insert([
            'conversation_id' => $conversation_id,
            'sender_type' => 'student',
            'sender_id' => $student_id,
            'receiver_type' => 'admin',
            'message_text' => $reply_message,
        ]);
        redirect('students/contact');
    }


    public function deleteMessage($message_id)
    {
        $messages = new Messages;
        $messages->delete($message_id);

        echo json_encode(['message' => $message_id]);
    }
}
