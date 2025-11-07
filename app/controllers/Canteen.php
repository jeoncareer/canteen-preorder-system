<?php

class Canteen extends Controller
{
    use Database;
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
        $data['total_orders'] = $this->query(
            " SELECT COUNT(*) AS total
                                            FROM canteen_orders_view
                                            WHERE canteen_id = :canteen_id
                                            AND DATE(time) = CURDATE();",
            ['canteen_id' => CANTEEN_ID]
        )[0]->total ?: 0;
        $data['total_earnings'] = $this->query(
            " SELECT SUM(total) AS total
                                            FROM canteen_orders_view
                                            WHERE canteen_id = :canteen_id
                                            AND DATE(time) = CURDATE();",
            ['canteen_id' => CANTEEN_ID]
        )[0]->total ?: 0;


        $data['completed_orders'] = $this->query(
            " SELECT COUNT(*) AS total
                                            FROM canteen_orders_view
                                            WHERE canteen_id = :canteen_id
                                            AND DATE(time) = CURDATE()
                                            AND status = 'completed';",
            ['canteen_id' => CANTEEN_ID]
        )[0]->total ?: 0;

        $data['rejected_orders'] = $this->query(
            " SELECT COUNT(*) AS total
                                            FROM canteen_orders_view
                                            WHERE canteen_id = :canteen_id
                                            AND DATE(time) = CURDATE()
                                            AND status = 'rejected';",
            ['canteen_id' => CANTEEN_ID]
        )[0]->total ?: 0;








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
        $student = new Student;
        $item = new Items;
        $order_items = new Order_items;

        $active_orders = $order->whereIn('status', ['pending', 'accepted', 'ready'], ['canteen_id' => CANTEEN_ID]);
        $history_orders = $order->whereIn('status', ['completed', 'rejected'], ['canteen_id' => CANTEEN_ID], [], 10) ?: [];


        $data['pending_orders'] = count($order->where(['canteen_id' => CANTEEN_ID, 'status' => 'pending']) ?: []);
        $data['accepted_orders'] = count($order->where(['canteen_id' => CANTEEN_ID, 'status' => 'accepted']) ?: []);
        $data['rejected_orders'] = count($order->where(['canteen_id' => CANTEEN_ID, 'status' => 'rejected']) ?: []);
        $data['completed_orders'] = count($order->where(['canteen_id' => CANTEEN_ID, 'status' => 'completed']) ?: []);
        $data['ready_orders'] = count($order->where(['canteen_id' => CANTEEN_ID, 'status' => 'ready']) ?: []);



        foreach ($active_orders as $row) {
            $row->student = $student->first(['id' => $row->student_id]);
            $row->items = $order_items->where(['order_id' => $row->id]);
            foreach ($row->items as $row) {
                $row->item = $item->first(['id' => $row->item_id]);
            }
        }

        foreach ($history_orders as $row) {
            $row->student = $student->first(['id' => $row->student_id]);
            $row->items = $order_items->where(['order_id' => $row->id]);
            foreach ($row->items as $row) {
                $row->item = $item->first(['id' => $row->item_id]);
            }
        }

        $data['active_orders'] = $active_orders;
        $data['history_orders'] = $history_orders;
        //show($history_orders);

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


        $canteen_id = $_SESSION['CANTEEN']->id;
        $canteen_data = $canteen->first(['id' => $canteen_id]);


        show($canteen_data);
        $canteen_data->working_days = json_decode($canteen_data->working_days, true);
        $data['canteen'] = $canteen_data;




        $this->view('canteen/settings', $data);
    }


    public function logout()
    {
        unset($_SESSION['CANTEEN']);

        redirect('canteen/login');
    }
}
