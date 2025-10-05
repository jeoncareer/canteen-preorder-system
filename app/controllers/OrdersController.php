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


    public function ordersByDateCanteen()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $where = $data['data'];

        $units = $data['units'] ?: [];

        $where_keys = array_keys($where);
        $unit_keys = array_keys($units);


        $query = "select sum(total) as total, count(*) as total_orders  from canteen_orders_view where";
        if (!empty($where_keys)) {

            foreach ($where_keys as $key) {
                $query .= " {$key} = :{$key} AND ";
            }
        }


        if (!empty($units)) {

            foreach ($unit_keys as $key) {
                $query .= " {$key}(`time`) = :{$key} AND ";
            }
        }


        $query = trim($query, " AND ");

        $data = array_merge($where, $units);
        $orders = $this->query($query, $data);



        echo json_encode(['orders' => $orders]);
    }


    public function ordersByDateCollege()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $where = $data['data'];

        $units = $data['units'] ?: [];

        $where_keys = array_keys($where);
        $unit_keys = array_keys($units);


        $query = "select sum(total) as total, count(*) as total_orders  from college_orders_view where";
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



        echo json_encode(['success' => true, 'results' => $results, 'query' => $query, 'results' => $results]);
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

    public function orders()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $filters = $data['filters'] ?: [];
        $canteen = new Canteen_db;
        $order = new Orders;
        $student = new Student;
        $order_item = new Order_items;
        $item = new Items;
        $college_id = $_SESSION['COLLEGE']->id;
        $message = '';
        $where = [];
        $canteens = $canteen->where(['college_id' => $college_id]);
        $canteens_ids = array();

        foreach ($canteens as $cant) {
            $canteens_ids[] = $cant->id;
            $canteens_names[$cant->id] = $cant->canteen_name;
        }

        $sql = "select * from orders where";
        if (isset($filters['date'])) {
            $where['date'] = $filters['date'];
            $sql .= " date(`time`) = :date AND";
        }

        if (isset($filters['search'])) {
            $where['search'] = $filters['search'];
            $sql .= " (`name` LIKE :search OR `description` LIKE :search) AND";
        }


        if (isset($filters['canteen']) && $filters['canteen'] !== '') {
            $where['canteen'] = $filters['canteen'];
            $sql .= " canteen_id = :canteen AND";
        } else {
            $sql .= " canteen_id IN (" . implode(',', $canteens_ids) . ") AND";
        }

        if (isset($filters['status'])) {
            $where['status'] = $filters['status'];
            $sql .= " status = :status AND";
        }

        $sql = rtrim($sql, " AND");

        if (isset($filters['page'])) {
            $page = (int)$filters['page'];
            $offset = ($page - 1) * 10;
            $sql .= " ORDER BY time DESC LIMIT 10 OFFSET {$offset}";
        } else {
            $sql .= " ORDER BY time DESC LIMIT 10";
        }

        $orders = $this->query($sql, $where);

        if ($orders) {

            foreach ($orders as $ord) {
                $items = '';
                $ord->student = $student->first(['id' => $ord->student_id]);
                $ord->canteen = $canteen->first(['id' => $ord->canteen_id]);

                $order_items = $order_item->where(['order_id' => $ord->id]);

                foreach ($order_items as $ordit) {
                    $item_row = $item->first(['id' => $ordit->item_id]);
                    $items .= ucfirst($item_row->name) . ' x' . $ordit->quantity . ',';
                }

                $ord->items = trim($items, ',');
            }
        }







        if ($orders) {
            echo json_encode(['success' => true, 'orders' => $orders, 'query' => $sql, 'where' => $where]);
        } else {
            echo json_encode(['success' => false, 'orders' => 'no results', 'query' => $sql, 'where' => $where]);
        }
    }
}
