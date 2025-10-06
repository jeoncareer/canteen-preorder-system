<?php

class Admin extends Controller
{
    use Database;

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
        $data['pending_students'] = $student->where(['college_id' => $college_id, 'status' => 'pending'], [], 5);
        $data['pending_students_count'] = count($student->where(['college_id' => $college_id, 'status' => 'pending'])) ?: 0;
        show($data['pending_students_count']);




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
        $items = new Items;
        $order = new Orders;

        $data = [];
        $college = $_SESSION['COLLEGE'];
        $canteens = $canteen->where(['college_id' => $college->id]);
        $canteens_count = count($canteens);
        foreach ($canteens as $row) {
            $row->total_menu_items = $items->count(['canteen_id' => $row->id]);
            $sql = "select count(*) as total_orders from orders where canteen_id = {$row->id} AND DATE_FORMAT(time,'%Y-%m-%d') = CURDATE()";
            $result = $order->query($sql);
            $row->total_orders = $result[0]->total_orders ?? 0;

            $sql = "select sum(total) as total_revenue from orders where canteen_id = {$row->id} AND DATE_FORMAT(time,'%Y-%m-%d') = CURDATE()";
            $result = $order->query($sql);
            $row->total_revenue = $result[0]->total_revenue ?? 0;
        }
        $data['college'] = $college;
        $data['canteens'] = $canteens;
        $data['canteens_count'] = $canteens_count;
        show($canteens);

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

        $this->view('admin/students', $data);
    }


    public function student_reports()
    {
        $conversation = new Conversations;
        $messages = new Messages;
        $student = new Student;
        $college = $_SESSION['COLLEGE'];
        $data = json_decode(file_get_contents("php://input"), true);
        $college_id = $_SESSION['COLLEGE']->id;
        $data = [];

        $conversations = $conversation->where(['college_id' => $college_id]);
        if ($conversations) {

            foreach ($conversations as $row) {
                $row->messages = $messages->where(['conversation_id' => $row->id], [], '', '', 'created_at', 'asc');
                $row->student = $student->first(['id' => $row->student_id]);
            }
            $data['conversations'] = $conversations;
        }

        $data['college'] = $college;


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
        $data = [];
        $canteen = new Canteen_db;
        $order = new Orders;
        $student = new Student;
        $order_item = new Order_items;
        $item = new Items;
        $college_orders = new College_orders_view;
        $data['college'] = $_SESSION['COLLEGE'];
        $college_id = $_SESSION['COLLEGE']->id;
        $canteens = $canteen->where(['college_id' => $college_id]);
        $canteens_ids = array();
        $canteens_names = [];
        foreach ($canteens as $cant) {
            $canteens_ids[] = $cant->id;
            $canteens_names[$cant->id] = $cant->canteen_name;
        }

        $data['canteens'] = $canteens_names;



        $orders = $order->whereIn('canteen_id', $canteens_ids, [], [], 10, '', 'time', 'desc');
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
            $data['orders'] = $orders;
        }

        $data['total_orders'] = count($order->whereIn('canteen_id', $canteens_ids));
        $data['total_pending_orders'] = count($college_orders->where(['college_id' => $college_id, 'status' => 'pending']));
        $data['total_completed_orders'] = count($college_orders->where(['college_id' => $college_id, 'status' => 'completed']) ?: []);
        $data['total_cancelled_orders'] = count($college_orders->where(['college_id' => $college_id, 'status' => 'rejected']) ?: []);
        $data['total_revenue'] = $college_orders->query("select sum(total) as total from college_orders_view where college_id = {$college_id}")[0]->total ?: 0;
        $data['totalRows'] = ceil($data['total_orders']);

        $totalPageNumbers = ceil($data['totalRows'] / 10);
        $data['totalPageNumbers'] = $totalPageNumbers;
        show($data);
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
        $order_item  = new Order_items;
        $college = $_SESSION['COLLEGE'];
        $data['college'] = $college;

        //for orders section
        $categories = $category->where(['canteen_id' => $canteen_id]);
        foreach ($categories as $row) {
            $row->items = $itemTable->where(['canteen_id' => $canteen_id, 'category_id' => $row->id]);
        }

        $data['total_menu_items'] = $itemTable->count(['canteen_id' => $canteen_id]);



        $data['categories'] = $categories;
        //end

        $orders = $order->where(['canteen_id' => $canteen_id], [], 10);
        if (!empty($orders)) {

            foreach ($orders as $ord) {
                $items = '';
                $ord->student = $student->first(['id' => $ord->student_id]);

                $order_items = $order_item->where(['order_id' => $ord->id]);

                foreach ($order_items as $ordit) {
                    $item = $itemTable->first(['id' => $ordit->item_id]);
                    $items .= ucfirst($item->name) . ' x' . $ordit->quantity . ',';
                }

                $ord->items = trim($items, ',');
            }



            $data['orders'] = $orders;
        }


        $data['canteen_id'] = $canteen_id;
        $data['canteen'] = $canteens->first(['id' => $canteen_id]);
        show($data['canteen']);






        $this->view('admin/canteen_details', $data);
    }
}
