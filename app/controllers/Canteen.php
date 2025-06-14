<?php

class Canteen extends Controller
{
    public function index()
    {
        $canteen = new Canteen_db();
        $result = $canteen->get_enum("items", "status");
        // print_r($result[0]->COLUMN_TYPE);
        $result = $result[0]->COLUMN_TYPE;
        $result  = substr($result, 5, -1);
        $result = str_getcsv($result, ',', "'");
        show($result);
    }

    public function signin()
    {

        $college = new College();
        $canteen = new Canteen_db();
        $colleges = $college->findAll();


        foreach ($colleges as $col) {
            $data['colleges'][] = $col->college_name;
        }
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if ($canteen->validate($_POST)) {

                $college_name = $_POST['college_name'];
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;
                if (empty($college->first(['college_name' => $_POST['college_name']]))) {
                    $college->insert(["college_name" => $college_name]);
                }

                $result = $college->first(['college_name' => $_POST['college_name']]);

                $arr = ["college_id" => $result->id,];
                $arr = array_merge($_POST, $arr);

                print_r($arr);
                $canteen->insert($arr);
                redirect('canteen/login');
            } else {
                $data["errors"] = $canteen->errors;
                show($canteen->errors);
                $this->view('canteen/signup', $data);
            }

        } else {
            $this->view('canteen/signup', $data);
        }

    }

    public function login()
    {
        $canteen = new Canteen_db();


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($canteen->login_validate($_POST)) {
                $result = $canteen->first(["email" => $_POST["email"]]);

                $_SESSION['CANTEEN'] = $result;
                print_r($_SESSION['CANTEEN']);

                $this->view('canteen/home');
            } else {
                print_r($canteen->errors);
            }
        } else {
            $this->view('canteen/login');
        }
    }

    public function add_item()
    {
        $item = new Items();

        $canteen = new Canteen_db();

        $this->view('canteen/add_item');



    }
}
