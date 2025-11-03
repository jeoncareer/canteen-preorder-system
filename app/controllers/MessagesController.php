
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



    public function fetchNoOfConversationUnreadByStudents()
    {

        $conversations = new Conversations;

        $count = $conversations->count(['student_id' => STUDENT_ID, 'is_read_by_student' => 0]);

        echo json_encode(['count' => $count]);
    }

    public function deleteMessage($message_id)
    {
        $messages = new Messages;
        $messages->delete($message_id);

        echo json_encode(['message' => $message_id]);
    }

    public function reply($conversation_id)
    {
        $messages = new Messages;

        $data = json_decode(file_get_contents('php://input'), true);
        $reply_message = $_POST['reply_message'];


        $messages->insert([
            'conversation_id' => $conversation_id,
            'sender_type' => 'student',
            'sender_id' => STUDENT_ID,
            'receiver_type' => 'college',
            'message_text' => $reply_message,
        ]);

        redirect('students/contact');
    }
}
