<?php

class Students extends Controller
{
    use Database;
    public function index()
    {
        $cart = new Cart;

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

        foreach ($items as $item) {
            $category = $item->category_name;

            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }

            $grouped[$category][] = $item;
        }



        // show($grouped);
        // foreach ($grouped as $key => $value) {
        //     echo "<h1>".$key."</h1> <br>";
        //     foreach ($value as $v) {
        //         show($v);

        //     }
        // }
        $student_id = $_SESSION['STUDENT']->id;

        $carts = $cart->join(
            'cart',
            ['items' => 'cart.item_id = items.id'],
            ['cart.student_id' => $student_id],
            'cart.*, items.name,items.price',
            'asc',
            'date'


        );

        show($carts);
        $data['carts'] = $carts;

        $data['grouped'] = $grouped;

        $this->view('students/index', $data);
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
                show($student->errors);
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

    public function addToCart()
    {
        $cart = new Cart;
        $data = json_decode(file_get_contents("php://input"), true);


        if (isset($data['item_id'])) {
            $item_id = (int)$data['item_id'];
            $student_id = $_SESSION['STUDENT']->id;
            $result = $cart->where(['item_id' => $item_id, 'student_id' => $student_id]);
            if (empty($result)) {

                $cart->insert(['item_id' => $item_id, 'student_id' => $student_id]);
            } else {
                echo json_encode(['success' => false, "message" => "Missing Data"]);
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Missing Data"]);
        }
    }


    public function my_orders()
    {
        $this->view('students/my_orders');
    }

    public function history()
    {
        $this->view('students/order_history');
    }
}
