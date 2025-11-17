<?php


class Students extends Controller
{
    use Database;

    function checkStatus()
    {
        $student = new Student();
        $student_data = $student->first(['id' => STUDENT_ID]);
        if ($student_data->status == 'pending') {
            $this->view('students/pending');
            die;
        } elseif ($student_data->status == 'suspended' || $student_data->status == 'rejected') {
            $this->view('students/blocked');
            die;
        }
    }

    public function index()
    {
        if (!isset($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $this->checkStatus();
        $cart = new Cart;
        $student = new Student;
        $student_id = $_SESSION['STUDENT']->id;

        if (empty($_SESSION['STUDENT'])) {
            redirect('students/login');
        }

        // if ($_SESSION['STUDENT']->status == 'suspended') {
        //     $this->view('students/blocked');
        //     return;
        // }
        // if ($_SESSION['STUDENT']->status == 'pending') {
        //     $this->view('students/pending');
        //     return;
        // }

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

        // if (isset($_SESSION['STUDENT'])) {
        //     redirect('students');
        // }
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
        if (isset($_SESSION['STUDENT'])) {
            unset($_SESSION['STUDENT']);
        }
        redirect('students/login');
    }
    public function blocked()
    {
        $this->view('students/blocked');
    }

    public function pending()
    {
        $this->view('students/pending');
    }





    public function my_orders()
    {
        $this->checkStatus();
        if (!isset($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $order = new Orders;
        $order_item = new Order_items;
        $item = new Items;
        $orders = $order->whereIn('status', ['pending', 'accepted', 'ready'], ['student_id' => STUDENT_ID]) ?: [];
        foreach ($orders as $row) {
            $row->items = $order_item->where(['order_id' => $row->id]);
            foreach ($row->items as $row) {
                $row->item = $item->first(['id' => $row->item_id]);
            }
        }
        $data['orders'] = $orders;
        //show($orders);


        $this->view('students/my_orders', $data);
    }

    public function history()
    {
        $this->checkStatus();
        if (!isset($_SESSION['STUDENT'])) {
            redirect('students/login');
        }
        $order = new Orders;
        $order_item = new Order_items;
        $item = new Items;
        $orders = $order->whereIn('status', ['completed', 'ready'], ['student_id' => STUDENT_ID]) ?: [];
        foreach ($orders as $row) {
            $row->items = $order_item->where(['order_id' => $row->id]);
            foreach ($row->items as $row) {
                $row->item = $item->first(['id' => $row->item_id]);
            }
        }
        $data['orders'] = $orders;
        //show($orders);



        $this->view('students/order_history', $data);
    }



    public function contact()
    {
        $this->checkStatus();
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
                $conversation->update(['id' => $row->id], ['is_read_by_student' => 1]);
            }
            $data['conversations'] = $conversations;
        }



        $this->view('students/contact_admin', $data);
    }

    public function order()
    {
        $this->checkStatus();
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
                }
            }
        }

        echo json_encode(['success' => true]);
    }

    public function profile()
    {
        $this->view("students/profile");
    }
}
