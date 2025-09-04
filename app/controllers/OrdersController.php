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


    public function ordersByDate()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $where = $data['data'];

        $units = $data['units'] ?: [];

        $where_keys = array_keys($where);
        $unit_keys = array_keys($units);


        $query = "select sum(total) as total, count(*) as total_orders  from canteen_orders_view where";
        foreach ($where_keys as $key) {
            $query .= " {$key} = :{$key} AND ";
        }


        if (!empty($units)) {

            foreach ($unit_keys as $key) {
                $query .= " {$key}(`time`) = :{$key} AND ";
            }
        }

        $query = trim($query, " AND ");

        $data = array_merge($where, $units);
        $results = $this->query($query, $data);



        echo json_encode(['results' => $results, 'query' => $query]);
    }

    public function studentOrders($status = '')
    {
        header('Content-Type: application/json');
        $order = new Orders;
        $order_item = new Order_items;
        $item = new Items;
        $validStatus = array('pending', 'completed', 'rejected');


        if (empty($status)) {

            $orders = $order->where(['student_id' => STUDENT_ID]);
        } else {
            $orders = $order->where(['student_id' => STUDENT_ID, 'status' => $status]);
        }

        if ($orders) {
            foreach ($orders as $row) {
                $order_items = $order_item->where(['order_id' => $row->id]);
                $row->order_items = $order_items;
                foreach ($row->order_items as $row) {
                    $items = $item->first(['id' => $row->item_id]);
                    $row->item = $items;
                }
            }


            echo json_encode(['success' => true, 'student_id' => STUDENT_ID, 'status' => $status, 'orders' => $orders], JSON_PRETTY_PRINT);
        } else {

            echo json_encode(['success' => false, 'orders' => 'no results']);
        }
    }
}
