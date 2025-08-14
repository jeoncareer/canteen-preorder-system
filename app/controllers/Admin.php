<?php

class Admin extends Controller
{

    public function index()
    {

        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }
        $canteens = new Canteen_db;
        $students = new Student;



        $data['college'] = $_SESSION['COLLEGE'];
        $college_id = $_SESSION['COLLEGE']->id;
        $data['canteens_count'] = $canteens->count(['college_id' => $college_id]);
        $data['students_count'] = $canteens->count(['college_id' => $college_id]);





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
        $this->view('admin/canteens');
    }

    public function students()
    {
        $this->view('admin/students');
    }

    public function student_reports()
    {
        $data['page'] = 'student_reports';
        $this->view('admin/student_reports', $data);
    }
}
