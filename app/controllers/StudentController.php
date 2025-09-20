<?php

class StudentController extends Controller
{
    use Database;

    public function student($id = '')
    {
        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }

        $students = new Student;
        $college_id = $_SESSION['COLLEGE']->id;


        $student =  $students->first(['id' => $id]);



        echo json_encode(['student' => $student]);
    }


    public function toggleStudentStatus($id = '')
    {
        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $status = $data['status'];
        $students = new Student;
        $students->update(['id' => $id], ['status' => $status]);
        $student =  $students->first(['id' => $id]);
        echo json_encode(['success' => true, 'student' => $student]);
    }
}
