<?php

class Canteen extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['CANTEEN'])) {
            redirect('canteen/login');
        }
        $order = new Orders;
        $categories = new Categories;
        $orders = $order->join(
            [
                'order_items' => 'orders.id = order_items.order_id',
                'items' => 'order_items.item_id = items.id'
            ],
            ['orders.canteen_id' => CANTEEN_ID],
            'orders.*, items.name,items.price, items.id as item_id, order_items.quantity',
            '',
            '',
            '20'

        );


        $data['orders'] = [];
        if (!empty($orders)) {


            foreach ($orders as $order) {
                $data['orders'][$order->id][] = $order;
            }
        }

        $result = $categories->where(['canteen_id' => CANTEEN_ID]);
        $data['categories'] = [];
        foreach ($result as $res) {
            $data['categories'][] = ['name' => $res->name, 'id' => $res->id];
        }






        $this->view('canteen/home', $data);
    }

    public function register()
    {

        $college = new College();
        $canteen = new Canteen_db();
        $colleges = $college->findAll();


        foreach ($colleges as $col) {
            $data['colleges'][] = $col;
        }

        show($data['colleges']);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if ($canteen->validate($_POST)) {

                $college_id = $_POST['college_id'];
                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;



                //print_r($arr);
                $canteen_id = $canteen->insert($_POST);
                $dcategories = new Dcategories();
                $categories = new Categories();
                $result = $dcategories->findAll();

                foreach ($result as $res) {
                    $categories->insert(['canteen_id' => $canteen_id, 'name' => $res->name]);
                }
                redirect('canteen/login');
            } else {
                $data["errors"] = $canteen->errors;
                show($canteen->errors);

                $this->view('canteen/register', $data);
            }
        } else {
            $this->view('canteen/register', $data);
        }
    }

    public function login()
    {
        $canteen = new Canteen_db();


        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if ($canteen->login_validate($_POST)) {
                $result = $canteen->first(["email" => $_POST["email"]]);

                $_SESSION['CANTEEN'] = $result;


                redirect('canteen/home');
            } else {
                $data['errors'] = $canteen->errors;
                $this->view('canteen/login', $data);
            }
        } else {
            $this->view('canteen/login');
        }
    }




    public function category()
    {

        $category = new Categories();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = strtolower($_POST['category_name']);

            $arr = ['name' => $name, 'canteen_id' => $_SESSION['CANTEEN']->id];
            $category->insert($arr);
            redirect('canteen/menu_management');
        }
    }


    public function menu_management()
    {


        $order = new orders;
        $categories = new Categories;
        $items = new Items;
        $canteen_items = $items->where(['canteen_id' => CANTEEN_ID]);
        $data['items'] = $canteen_items;
        //show($canteen_items);
        //show($canteen_items);



        $result = $categories->where(['canteen_id' => CANTEEN_ID]);
        $data['categories'] = [];
        foreach ($result as $res) {
            $data['categories'][] = ['name' => $res->name, 'id' => $res->id];
        }






        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $items->insert(['name' => $_POST['item_name'], 'price' => $_POST['price'], 'canteen_id' => CANTEEN_ID, 'category_id' => $_POST['category'], 'description' => $_POST['description']]);
            redirect('canteen/menu_management');
        }
        $this->view('canteen/menu_management', $data);
    }
    public function orders()
    {
        $order = new Orders;

        $orders = $order->join(
            [
                'order_items' => 'orders.id = order_items.order_id',
                'items' => 'order_items.item_id = items.id',
                'students' => 'orders.student_id = students.id'
            ],
            ['orders.canteen_id' => CANTEEN_ID],
            'orders.*, items.name,items.price,students.email,items.id as item_id, order_items.quantity',
            'desc',
            'orders.id'
        );




        $data['orders'] = [];
        foreach ($orders as $order) {
            $data['orders'][$order->id][] = $order;
        }

        krsort(($data['orders']));

        $this->view('canteen/orders', $data);
    }

    public function edit_item()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [];
            $where = [];
            if (!empty($_POST['item-name'])) {
                $data['name'] = $_POST['item-name'];
            }

            if (!empty($_POST['price'])) {
                $data['price'] = $_POST['price'];
            }

            if (!empty($_POST['description'])) {
                $data['description'] = $_POST['description'];
            }
            if (!empty($_POST['item_id'])) {
                $where['id'] = $_POST['item_id'];
            }
            show($data);

            $item = new Items;

            $item->update($where, $data);

            redirect('canteen/menu_management');
        }
    }

    public function settings()
    {

        $canteen = new Canteen_db();
        $manager = new Managers();

        $canteen_id = $_SESSION['CANTEEN']->id;
        $canteen_data = $canteen->first(['id' => $canteen_id]);
        $manager_data = $manager->where(['canteen_id' => $canteen_id]);
        show($manager_data);
        show($canteen_data);
        $canteen_data->working_days = json_decode($canteen_data->working_days, true);
        $data['canteen'] = $canteen_data;
        $data['managers'] = $manager_data;



        $this->view('canteen/settings', $data);
    }
}
