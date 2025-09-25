<?php

class Admin extends Controller
{

    public function index()
    {

        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }
        $canteen = new Canteen_db;
        $student = new Student;
        $college_orders = new College_orders_view;
        $canteen_orders = new Canteen_orders_view;

        $college_id = $_SESSION['COLLEGE']->id;
        $firstDay = new DateTime('first day of this month');
        $now = new DateTime('today');
        $today = $now->format('Y-m-d');
        $this_month = $firstDay->format('Y-m');
        $this_month_revenue_sql = "select sum(total) as total from college_orders_view where DATE_FORMAT(time,'%Y-%m') = '{$this_month}' AND college_id = {$college_id}";

        $canteens = $canteen->where(['college_id' => $college_id]);
        foreach ($canteens as $cant) {
            $result = $canteen_orders->query("
                SELECT COUNT(*) AS total_orders,SUM(total) AS total_revenue 
                FROM canteen_orders_view 
                WHERE DATE_FORMAT(time, '%Y-%m-%d') = '{$today}' 
                AND canteen_id = {$cant->id}
            ");

            // Assuming your query() returns an array of stdClass objects:
            if ($result && isset($result[0])) {
                $cant->total_orders = $result[0]->total_orders;
                $cant->total_revenue = $result[0]->total_revenue;
            } else {
                $cant->total_orders = 0;
                $cant->total_revenue = 0;
            }
        }












        $data['college'] = $_SESSION['COLLEGE'];
        $data['canteens_count'] = $canteen->count(['college_id' => $college_id]);
        $data['students_count'] = $student->count(['college_id' => $college_id]);
        $data['order_count'] = $college_orders->count(['college_id' => $college_id]);
        $data['this_month_revenue'] =  $college_orders->query($this_month_revenue_sql)[0]->total;
        $data['canteens'] = $canteens;
        $data['students'] = $student->where(['college_id' => $college_id], [], 5);





        $this->view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $college = new College;
            if ($college->validate($_POST)) {

                $admin = $college->first(['email' => $_POST['email']]);


                $_SESSION['COLLEGE'] = $admin;
                redirect('admin');
            } else {
                $data['email'] = $_POST['email'];
                $data['errors'] = $college->errors;
                $this->view('admin/login', $data);
                die;
            }
        }

        $this->view('admin/login');
    }

    public function register()
    {
        $college = new College;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($college->register_validate($_POST)) {

                $email = $_POST['email'];
                $college_name = $_POST['college_name'];
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;


                $college->insert($_POST);
                redirect('admin');
            } else {
                $data['errors'] = $college->errors;
                $values['email'] = $_POST['email'];
                $values['college_name'] = $_POST['college_name'];
                $data['values'] = $values;
                $this->view('admin/register', $data);
                die;
            }
        }






        $this->view('admin/register');
    }


    public function canteens()
    {
        $canteen = new Canteen_db;


        $data = [];
        $college = $_SESSION['COLLEGE'];
        $canteens = $canteen->where(['college_id' => $college->id]);
        $canteens_count = count($canteens);
        $data['college'] = $college;
        $data['canteens'] = $canteens;
        $data['canteens_count'] = $canteens_count;

        $this->view('admin/canteens', $data);
    }

    public function students()
    {
        $student = new Student;
        $data['college'] = $_SESSION['COLLEGE'];
        $college_id = $_SESSION['COLLEGE']->id;

        // Build WHERE clause (no filters)
        $where = "students.college_id = {$college_id}";

        $sql = "SELECT students.email as student_email, students.student_name, students.reg_no,
        students.status, students.id, count(orders.id) AS total_orders
        FROM students
        LEFT JOIN orders ON students.id = orders.student_id
        WHERE {$where}
        GROUP BY students.id
        ORDER BY students.id desc
        LIMIT 10 OFFSET 0";

        $data['student_total_orders'] = $student->query($sql);

        // Get total rows without filters
        $countSql = "SELECT COUNT(DISTINCT students.id) as total
        FROM students
        LEFT JOIN orders ON students.id = orders.student_id
        WHERE {$where}";

        $countResult = $student->query($countSql);
        $data['totalRows'] = ceil($countResult[0]->total);

        $totalPageNumbers = ceil($data['totalRows'] / 10);
        $data['totalPageNumbers'] = $totalPageNumbers;
        show($data);
        $this->view('admin/students', $data);
    }


    public function student_reports()
    {
        $data['college'] = $_SESSION['COLLEGE'];
        $data['page'] = 'student_reports';
        $this->view('admin/student_reports', $data);
    }

    public function courses()
    {
        $data['college'] = $_SESSION['COLLEGE'];
        $data['page'] = 'courses';
        $this->view('admin/courses', $data);
    }

    public function orders()
    {
        $data['college'] = $_SESSION['COLLEGE'];
        $data['page'] = 'orders';
        $this->view('admin/orders', $data);
    }

    public function canteenDetails($canteen_id = '')

    {
        if (empty($canteen_id)) {
            redirect('admin/canteens');
        }
        $canteens = new Canteen_db;
        $category = new Categories;
        $order = new Orders;
        $itemTable = new Items;
        $student = new Student;
        $order_items  = new Order_items;
        $college = $_SESSION['COLLEGE'];
        $data['college'] = $college;
        $canteen = $canteens->first(['id' => $canteen_id]);
        $categories = $category->where(['canteen_id' => $canteen_id]);
        $orders = $order->where(['canteen_id' => $canteen_id], [], 10);

        foreach ($categories as $row) {
            $row->items = $itemTable->where(['category_id' => $row->id]);
        }

        if ($orders) {

            foreach ($orders as $row) {
                $row->student = $student->first(['id' => $row->student_id]);
                $items = $order_items->where(['order_id' => $row->id]);
                show($items);

                foreach ($items as $item) {
                    $tItems = $itemTable->first(['id' => $item->item_id]);
                    $quantity = $item->quantity;
                    $tItems->quantity = $quantity;
                    $row->items[] = $tItems;
                }

                $abstractTime = timeAgoOrDate($row->time);
                $row->abstract_time = $abstractTime;
            }
            $data['orders'] = $orders;
        }


        foreach ($orders as $order) {
            $items_grouped = '';
            foreach ($order->items as $item) {
                $items_grouped .= $item->quantity . 'x ' . ucfirst($item->name) . ',';
            }

            $order->items_grouped = trim($items_grouped, ",");
        }

        show($orders);

        $data['canteen'] = $canteen;
        $data['categories'] = $categories;





        $this->view('admin/canteen_details', $data);
    }
}
