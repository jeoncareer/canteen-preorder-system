<?php

class Students extends Controller
{
    public function index()
    {

    }

    public function signup()
    {
        $student = new Student();
        $college = new College();

        $colleges = $college->findAll();
        foreach ($colleges as $col) {
            $data['colleges'][] = $col->college_name;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if ($student->validate($_POST)) {


                $result = $college->first(["college_name" => $_POST["college_name"]]);
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;
                $arr = array_merge($_POST, ['college_id' => $result->id]);
                $student->insert($arr);
                redirect('login');

            } else {
                $data['errors'] = $student->errors;
                $this->view('signup', $data);
            }
        } else {


            $this->view('signup', $data);


        }
    }

    public function login()
    {

        $student = new Student();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if ($student->login_validate($_POST)) {
                $email = $_POST["email"];
                $_SESSION["STUDENT"] = $student->first(['email' => $email]);
                redirect('Home');
            } else {

                $data['errors'] = $student->errors;
                $this->view('login', $data);
            }
        } else {


            $this->view('login');
        }
    }


    public function logout()
    {
        session_destroy();
        redirect('home');
    }

}
