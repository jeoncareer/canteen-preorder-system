<?php

class Admin extends Controller
{

    public function index()
    {

        if (!isset($_SESSION['COLLEGE'])) {
            redirect('admin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            show($_POST);
            die;
        }

        $this->view('admin/dashboard');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            show($_POST);
            die;
        }
        $this->view('admin/login');
    }

    public function register()
    {

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
