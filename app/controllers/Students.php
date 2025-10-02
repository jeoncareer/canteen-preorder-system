<?php

class Students extends Controller
{
    use Database;
    public function index()
    {

        $cart = new Cart;
        $student_id = $_SESSION['STUDENT']->id;

        if (empty($_SESSION['STUDENT'])) {
            redirect('students/login');
        }

        $college_id = $_SESSION['STUDENT']->college_id;

        $sql = "select canteen.id as canteen_id,items.id as item_id, 
        items.name as item_name,categories.name as category_name,
        items.price as price from items join canteen on items.canteen_id = canteen.id join 
        categories on items.category_id = categories.id join college
         on canteen.college_id = college.id where college.id = $college_id";
        $items = $this->query($sql);
        if (!empty($items)) {


            foreach ($items as $item) {
                $category = $item->category_name;

                if (!isset($grouped[$category])) {
                    $grouped[$category] = [];
                }

                $grouped[$category][] = $item;
            }
            $data['grouped'] = $grouped;

            foreach ($grouped as $keys => $values) {
                foreach ($values as $value) {
                    $item_id = $value->item_id;

                    $result = $cart->where(['item_id' => $item_id, 'student_id' => $student_id]);

                    if (empty($result)) {
                        $value->in_cart = false;
                    } else {
                        $value->in_cart = true;
                    }
                }
            }
        }



        // show($grouped);
        // foreach ($grouped as $key => $value) {
        //     echo "<h1>".$key."</h1> <br>";
        //     foreach ($value as $v) {
        //         show($v);

        //     }
        // }


        $carts = $cart->join(

            ['items' => 'cart.item_id = items.id'],
            ['cart.student_id' => $student_id],
            'cart.*, items.name,items.price,items.canteen_id',
            'asc',
            'date'


        );


        $data['carts'] = $carts;

        $data['total'] = 0;


        //show($grouped);



        $this->view('students/index', $data);
    }





    public function register()
    {
        $student = new Student();
        $college = new College();

        $colleges = $college->findAll();
        foreach ($colleges as $col) {
            $data['colleges'][] = $col;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {



            if ($student->validate($_POST)) {


                $password = $_POST['password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;

                $student->insert($_POST);
                redirect('students/login');
            } else {
                $data['errors'] = $student->errors;
                show($student->errors);
                $this->view('students/register', $data);
            }
        } else {


            $this->view('students/register', $data);
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
                $Cart = new cart();
                $count = $Cart->count(['student_id' => $_SESSION['STUDENT']->id]);
                $_SESSION['STUDENT']->count =  $count[0]->count;

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






    public function my_orders()
    {
        if (!isset($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $orders = new Orders;

        $results = $orders->join(
            [
                'order_items' => 'orders.id = order_items.order_id',
                'items' => 'order_items.item_id = items.id'
            ],
            ['orders.student_id' => STUDENT_ID],
            'orders.*, items.name,items.price, items.id as item_id, order_items.quantity',

        );

        if (empty($results)) {
            $data['orders'] = [];
            $this->view('students/my_orders', $data);
            return;
        }

        $order = $orders->where(['student_id' => STUDENT_ID]);
        foreach ($order as $or) {
            $data['order'][$or->id] = ['total' => $or->total, 'status' => $or->status];
        }

        if (empty($data['order'])) {
            $data['orders'] = [];
            $this->view('students/my_orders', $data);
            return;
        } else {

            $list_of_orders = [];


            foreach ($results as $result) {
                $list_of_orders[$result->id][] = $result;
            }
            $data['orders'] = $list_of_orders;


            $this->view('students/my_orders', $data);
            return;
        }

        //show($data['order']);



        //show($list_of_orders);
        $this->view('students/my_orders');
    }

    public function history()
    {
        $order = new Orders;
        $order_item = new Order_items;
        $item = new Items;
        $data = [];

        $orders = $order->where(['student_id' => STUDENT_ID], ['status' => "pending"]);
        if ($orders) {

            foreach ($orders as $order) {
                $order_items = $order_item->where(['order_id' => $order->id]);

                $items = [];
                $i = 0;
                foreach ($order_items as $row) {
                    $items[] = $item->first(['id' => $row->item_id]);
                    $items[$i]->quantity = $row->quantity;
                    $i++;
                }

                $order->items = $items;
            }
            $data['orders'] = $orders;
        }


        show($orders);


        $this->view('students/order_history', $data);
    }



    public function contact()
    {
        if (empty($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $data = [];
        $col = new College;
        $conversation = new Conversations;
        $messages = new Messages;

        $student = $_SESSION['STUDENT'];
        $college = $col->where(['id' => $student->college_id]);


        $conversations = $conversation->where(['student_id' => STUDENT_ID]);

        if ($conversations) {

            foreach ($conversations as $row) {
                $row->messages = $messages->where(['conversation_id' => $row->id], [], '', '', 'created_at', 'asc');
            }
            $data['conversations'] = $conversations;
        }
        show($data);



        $this->view('students/contact_admin', $data);
    }

    public function order()
    {
        $cart = new Cart;
        $item = new Items;
        $orders = new orders;
        $order_items = new Order_items;

        // $result = $cart->where(['student_id' => STUDENT_ID]);
        //show($result);
        $result = $cart->join(
            ['items' => 'cart.item_id = items.id'],
            ['cart.student_id' => STUDENT_ID],
            'cart.*,items.price'
        );
        $grouped = [];
        $total = [];

        foreach ($result as $res) {
            $item_id = $res->item_id;
            $item_details = $item->where(['id' => $item_id]);
            $item_detail = $item_details[0];
            $grouped[$item_detail->canteen_id][] = ['item_id' => $item_id, 'count' => $res->count, 'price' => $res->price];
            if (!isset($total[$item_detail->canteen_id])) {
                $total[$item_detail->canteen_id] = 0;
            }
            $total[$item_detail->canteen_id] += $res->count * $res->price;
        }

        foreach ($grouped as $keys => $values) {
            $order_id = $orders->insert(['canteen_id' => $keys, 'student_id' => STUDENT_ID, 'total' => $total[$keys]]);
            foreach ($values as $value) {
                // echo "item id:" . $value['item_id'] . "<br>";
                // echo "count:" . $value['count'] . "<br>";

                $id = $order_items->insert(['order_id' => $order_id, 'item_id' => $value['item_id'], 'quantity' => $value['count']]);
                if (!empty($id)) {
                    $sql = 'DELETE FROM cart WHERE student_id = ' . STUDENT_ID;
                    $cart->query($sql);
                    redirect('students');
                }
            }
        }
    }

    public function profile()
    {
        $this->view("students/profile");
    }
}
