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
        $canteens = $canteen->where(['college_id' => $_SESSION['COLLEGE']->id]);
        $data['college'] = $_SESSION['COLLEGE'];
        foreach ($canteens as $canteen) {
        }
        $data['canteens'] = $canteens;
        show($data);
        $this->view('admin/canteens', $data);
    }

    public function students()
    {
        $student = new Student;
        $data['college'] = $_SESSION['COLLEGE'];
        $college_id = $_SESSION['COLLEGE']->id;

        $sql = "SELECT students.email as student_email,students.student_name,students.reg_no,
        students.status,students.id,count(orders.id) AS 
        total_orders FROM students 
        left JOIN orders ON students.id = orders.student_id
        WHERE students.college_id = {$college_id}
        GROUP BY students.id ORDER BY students.id desc limit 10 offset 0";
        $data['student_total_orders'] = $student->query($sql);
        $data['totalRows'] = count($student->where(['college_id' => $college_id]));
        $totalPageNumbers = $data['totalRows'] / 10;
        $data['lastValue'] = $data['totalRows'] / 10;


        if ($data['totalRows'] % 10 != 0) {
            $totalPageNumbers++;
        }

        $data['totalPageNumbers'] = $totalPageNumbers;



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
}
