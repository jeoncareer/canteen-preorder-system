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


    public function students()
    {
        header('Content-Type: application/json');
        $student = new Student;
        $college_id = $_SESSION['COLLEGE']->id;

        // Get filter/sort values from GET parameters
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $status = isset($_GET['status']) ? trim($_GET['status']) : '';
        $sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'students.id desc';

        // Build WHERE clause
        $where = "students.college_id = {$college_id}";
        if ($search !== '') {
            $search = addslashes($search);
            $where .= " AND (students.student_name LIKE '%{$search}%' OR students.email LIKE '%{$search}%' OR students.reg_no LIKE '%{$search}%')";
        }
        if ($status !== '') {
            $where .= " AND students.status = '{$status}'";
        }

        // Build ORDER BY clause
        switch ($sort) {
            case 'name':
                $orderBy = "students.student_name asc";
                break;
            case 'recent':
                $orderBy = "students.id desc";
                break;
            case 'orders':
                $orderBy = "total_orders desc";
                break;
            default:
                $orderBy = "students.id desc";
        }

        $sql = "SELECT students.email as student_email, students.student_name, students.reg_no,
        students.status, students.id, count(orders.id) AS total_orders
        FROM students
        LEFT JOIN orders ON students.id = orders.student_id
        WHERE {$where}
        GROUP BY students.id
        ORDER BY {$orderBy}
        LIMIT 10 OFFSET {$offset}";

        $student_total_orders = $student->query($sql);

        // For totalRows, apply the same filters except for pagination
        $countSql = "SELECT COUNT(DISTINCT students.id) as total
        FROM students
        LEFT JOIN orders ON students.id = orders.student_id
        WHERE {$where}";

        $countResult = $student->query($countSql);
        $totalRows = ceil($countResult[0]->total);

        $totalPageNumbers = ceil($totalRows / 10);

        echo json_encode([
            'success' => true,
            'orders' => $student_total_orders,
            'totalRows' => $totalRows,
            'totalPageNumbers' => $totalPageNumbers
        ]);
    }
}
