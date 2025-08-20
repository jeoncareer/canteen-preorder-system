<?php

class OrdersController extends Controller
{
    use Database;
    public function index()
    {
        $order = new student;
        $orders = $order->findAll();
        $test = $_GET['test'];

        echo json_encode(['orders' => $orders, 'test' => $test]);
    }


    public function students()
    {

        $offset = $_GET['offset'] ?? 0;

        $college_id = $_SESSION['COLLEGE']->id;
        $sql = "SELECT students.email as student_email,students.student_name,students.reg_no,
        students.status,students.id,count(orders.id) AS 
        total_orders FROM students 
        left JOIN orders ON students.id = orders.student_id
        WHERE students.college_id = {$college_id}
        GROUP BY students.id ORDER BY students.id desc limit 10 offset {$offset}";
        $student_total_orders = $this->query($sql);
        if (empty($student_total_orders)) {
            echo json_encode(['success' => false]);
        }

        $lastPageNumber = count($student_total_orders) / 10;

        echo json_encode(['success' => true, 'orders' => $student_total_orders, 'lastPageNumber' => $lastPageNumber]);
    }
}
