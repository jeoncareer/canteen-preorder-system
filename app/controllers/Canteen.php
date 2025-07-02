<?php

class Canteen extends Controller
{
    public function index()
    {
        $canteen = new Canteen_db();
        // $result = $canteen->get_enum("items", "status");
        // // print_r($result[0]->COLUMN_TYPE);
        // $result = $result[0]->COLUMN_TYPE;
        // $result  = substr($result, 5, -1);
        // $result = str_getcsv($result, ',', "'");
        // show($result);

        $this->view('canteen/home');
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

    public function orders()
    {
        $this->view('canteen/orders');
    }

    public function add_item()
    {
        $item = new Items();

        $canteen = new Canteen_db();
        $canteen_id = $_SESSION['CANTEEN']->id;


        //taking category names from category and default_category database
        $category = new Categories();


        $categories = $category->where(['canteen_id' => $canteen_id]);

        $data['categories'] = [];
        if (!empty($categories)) {

            foreach ($categories as $category) {
                $data['categories'][] = $category;
            }
        }







        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($item->validate(array_merge($_POST, $_FILES['item_image']))) {


                $fileName = $_FILES['item_image']['name'];
                $fileTmpName = $_FILES['item_image']['tmp_name'];
                $fileSize = $_FILES['item_image']['size'];
                $fileError = $_FILES['item_image']['error'];
                $fileType = $_FILES['item_image']['type'];
                show($_POST);
                $fileExt = explode('.', $fileName);

                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        $fileNameNew = uniqid('', true).$fileExt[0].'.'.$fileActualExt;
                        $fileDestination = 'assets/images/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $name = $_POST['item_name'];
                        $price = $_POST['price'];

                        $image_location = $fileNameNew;
                        $description = $_POST['description'];

                        $arr = [
                            'name' => $name,
                            'price' => $price,
                            'canteen_id' => $canteen_id,
                            'image_location' => $image_location,
                            'category_id' => $_POST['category_id'],
                            'description' => $description

                        ];
                        show($arr);
                        $item->insert($arr);


                    } else {
                        echo "There was an error uploading your file!";
                    }
                } else {
                    echo "You cannot upload files of this type!";
                }





            } else {

                $data['errors'] = $item->errors;

            }
        }

        $this->view('canteen/add_item', $data);



    }

    public function category()
    {

        $category = new Categories();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = strtolower($_POST['category_name']);

            $arr = ['name' => $name,'canteen_id' => $_SESSION['CANTEEN']->id];
            $category->insert($arr);
            echo "inserted successfully";

        }
    }
}
