<?php

class Canteen extends Controller
{
    public function index()
    {

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
                $this->view('canteen/signin', $data);
            }

        } else {
            $this->view('canteen/signin', $data);
        }

    }

    public function login()
    {
        $canteen = new Canteen_db();


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($canteen->login_validate($_POST)) {
                $result = $canteen->first(["email" => $_POST["email"]]);

                $_SESSION['CANTEEN'] = ["email" => $_POST['email'],"id" => $result->id];
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

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $file = $_FILES['item_image'];
            $file_name = $_FILES['item_image']['name'];
            $ar = ["item_image" => $file_name];
            if ($item->validate(array_merge($_POST, $ar))) {
                $fileExt = explode('.', $file_name);
                $fileActualExt = strtolower(end($fileExt));
                $file_name = $_POST['item_name'].".".$fileActualExt;
                $file_tmp = $_FILES['item_image']['tmp_name'];
                $file_destination = "assets/images/".$file_name;
                $canteen_id = $_SESSION["CANTEEN"]["id"];
                move_uploaded_file($file_tmp, $file_destination);

                $arr = ["name" => $_POST["item_name"],
                        "price" => $_POST["price"],
                        "image_location" => $file_name,
                        "canteen_id" => $_SESSION["CANTEEN"]["id"]
                        ];
                $item->insert($arr);


            } else {
                $data['errors'] = $item->errors;
                $this->view("canteen/add_item", $data);

            }

        } else {
            $this->view("canteen/add_item");

        }
    }
}
