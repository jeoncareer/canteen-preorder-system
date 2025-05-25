<?php


class Login extends Controller
{
    public function index()
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
}
