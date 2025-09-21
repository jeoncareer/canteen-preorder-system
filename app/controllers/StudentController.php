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


    public function getStudentsCount($where = [])
    {
        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }

        $students = new Student;
        $college_id = $_SESSION['COLLEGE']->id;
        $where['college_id'] = $college_id;

        $studentsCount = $students->count($where);
        $where['status'] = 'verified';
        $verifiedCount = $students->count($where);
        $where['status'] = 'pending';
        $pendingCount = $students->count($where);
        $where['status'] = 'suspended';
        $suspendedCount = $students->count($where);
        echo json_encode(['count' => $studentsCount, 'verified' => $verifiedCount, 'pending' => $pendingCount, 'suspended' => $suspendedCount]);
    }
}
