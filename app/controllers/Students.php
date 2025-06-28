<?php

class Students extends Controller
{
    public function index()
    {

        if (empty($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $college = new College();

        $college_id = $_SESSION["STUDENT"]->college_id;


        $sql = "SELECT id,canteen_name from canteen where college_id = $college_id";

        $result = $college->query($sql);
        $data["canteens"] = [];

        foreach ($result as $res) {
            $data["canteens"][] = $res;
        }

        // foreach ($data["canteens"] as $canteen) {
        //     echo $canteen ."<br>";
        // }

        $this->view('students/index', $data);


    }


    public function canteen($canteen_id = "")
    {
        $canteen = new Canteen_db();
        $item = new Items();

        $result = $canteen->first(["id" => 9]);
        $items = $item->findAll(['canteen_id' => $result->id]);
        $data['items'] = $items;
        show($items);


        $this->view('students/menu', $data);
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
                redirect('students/login');

            } else {
                $data['errors'] = $student->errors;
                $this->view('students/signup', $data);
            }
        } else {


            $this->view('students/signup', $data);


        }
    }

    public function login()
    {

        $student = new Student();

        if (isset($_SESSION['STUDENT'])) {
            redirect('students');
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if ($student->login_validate($_POST)) {
                $email = $_POST["email"];
                $_SESSION["STUDENT"] = $student->first(['email' => $email]);
                redirect('students');
            } else {

                $data['errors'] = $student->errors;
                $this->view('students/login', $data);
            }
        } else {


            $this->view('students/login');
        }
    }


    public function logout()
    {
        session_destroy();
        redirect('home');
    }


    public function cart()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $cart = new Cart();
            $student_id = $_SESSION['STUDENT']->id;
            $item_id = $_POST['item_id'];
            $arr = ['item_id' => $item_id,'student_id' => $student_id];
            $cart->insert($arr);
            redirect('students/canteen/9');
        } else {

            $this->view('students/cart');
        }

    }

}
