<?php
class Api extends Controller
{
    use Database;



    public function update_quantity()
    {
        header('Content-Type: application/json'); // ✅ Set content type FIRST
        http_response_code(200); // Optional
        $cart = new Cart;
        $data = json_decode(file_get_contents("php://input"), true);


        $sign = $data['sign'];
        $item_id = $data['item_id'];
        if (!isset($data['sign']) || !isset($data['item_id'])) {
            echo json_encode(["success" => false, "message" => "Missing Data"]);
            return;
        }

        $student_id = $_SESSION['STUDENT']->id;
        $result = $cart->where(['item_id' => $item_id, 'student_id' => $student_id]);
        $count = $result[0]->count;

        if ($sign === '+') {
            $count++;
        } else {
            $count--;
        }

        if ($count >= 0) {

            $cart->update(
                ['student_id' => $student_id, "item_id" => $item_id],
                ['count' => $count]

            );

            echo json_encode(['success' => true, 'count' => $count]);
        } else {
            echo json_encode(['success' => false, 'Message' => "count is less than 0"]);
        }
    }

    public function removeFromCart()
    {
        $cart = new Cart;
        $data = json_decode(file_get_contents("php://input"), true);
        $cart_id = $data['cart_id'];
        $sql = "DELETE from cart where id = " . $cart_id;
        $cart->query($sql);
        echo json_encode(['success' => true, "message" => "item as been reemoved from cart"]);
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

                $cartId = $cart->insert(['item_id' => $item_id, 'student_id' => $student_id]);
            } else {
                echo json_encode(['success' => false, "message" => "already exists"]);
            }

            echo json_encode(['success' => true, 'cartId' => $cartId]);
        } else {
            echo json_encode(["success" => false, "message" => "Missing Data"]);
        }
    }

    public function updateAddButton()
    {
        $carts = new Cart;
        $data = json_decode(file_get_contents("php://input"), true);

        $item_id = $data['item_id'];
        if (isset($item_id) && !empty($item_id)) {
            $result = $carts->where(['item_Id' => $item_id, 'student_id' => STUDENT_ID]);
            if (!empty($result)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, "Message" => "item not in cart"]);
            }
        } else {
            echo json_encode(['success' => false, 'Message' => "missing value"]);
        }
    }

    public function TotalItemsPrice()
    {
        $cart = new Cart;

        $carts = $cart->join(
            ['items' => 'cart.item_id = items.id'],
            ['cart.student_id' => STUDENT_ID],
            'cart.*,items.price'
        );

        if (!empty($carts)) {
            $total = 0;
            foreach ($carts as $value) {
                $count = (int)$value->count;
                $price = (int)$value->price;
                $total += $count * $price;
            }

            echo json_encode(['success' => true, 'total' => $total]);
        } else {
            echo json_encode(['success' => false, 'Message' => 'nothing in cart']);
        }
    }

    public function changeStatus()
    {

        $orders = new Orders;
        $data = json_decode(file_get_contents("php://input"), true);
        $order_id = $data['order_id'];
        $new_status = $data['new_status'];

        if (empty($order_id) || empty($new_status)) {
            echo json_encode(['success' => false, 'message' => 'missing data']);
        }

        $orders->update(
            ['id' => $order_id],
            ['status' => $new_status]
        );

        echo json_encode(['success' => true, 'status_new' => $new_status, 'order_id' => $order_id]);
    }


    public function updateOrders()
    {
        $order = new Orders;
        $data = json_decode(file_get_contents("php://input"), true);
        $order_id = $data['order_id'];

        $sql = "select * from orders where id > " . $order_id;
        $results = $order->query($sql);
        if (empty($results)) {
            echo json_encode(['success' => false, 'message' => 'no new orders']);
        } else {

            $rawOrders = $order->join(
                [
                    'order_items' => 'orders.id = order_items.order_id',
                    'items' => 'order_items.item_id = items.id'
                ],
                ['orders.canteen_id' => CANTEEN_ID, 'orders.id >' => $order_id],
                'orders.*, items.name,items.price, items.id as item_id, order_items.quantity'
            );
            $orders = [];
            foreach ($rawOrders as $order) {
                $orders[$order->id][] = $order;
            }

            echo json_encode(['success' => true, 'orders' => $orders]);
        }
    }

    public function getOrdersByFilter()
    {
        $order = new Orders;
        $data = json_decode(file_get_contents("php://input"), true);
        $filters = $data['filter'];
        $filter = [];

        foreach ($filters as $index => $value) {
            $filter[$value['type']] = $value['value'];
        }

        // $orders = $order->join(
        //     [
        //         'order_items' => 'orders.id = order_items.order_id',
        //         'items' => 'order_items.item_id = items.id'
        //     ],
        //     ['orders.canteen_id' => CANTEEN_ID],
        //     'orders.*, items.name,items.price, items.id as item_id, order_items.quantity',
        //     '',
        //     '',
        //     '20'

        // );

        // fromDate: ""
        // ​​
        // search: ""
        // ​​
        // sort: "desc"
        // ​​
        // status: "accepted"
        // ​​
        // toDate: ""

        $sql = "select orders.*,items.name,items.price,items.id as item_id,order_items.quantity,students.email from orders join order_items on orders.id = order_items.order_id join items on order_items.item_id = items.id join students on orders.student_id = students.id WHERE orders.canteen_id = " . CANTEEN_ID . " AND ";

        if (!empty($filter['status'])) {
            $sql .= " orders.status = '" . $filter['status'] . "' ";
        }

        if (!empty($filter['fromDate'] && !empty($filter['toDate']))) {
            $sql .= "  AND orders.time BETWEEN '{$filter['fromDate']}' AND '{$filter['toDate']}'";
        } else if (!empty($filter['fromDate'] || !empty($filter['toDate']))) {
            if (!empty($filter['fromDate'])) {
                $sql .= " AND orders.time >= '{$filter['fromDate']}' ";
            }

            if (!empty($filter['toDate'])) {
                $sql .= " AND orders.time <= '{$filter['toDate']}' ";
            }
        }

        if (!empty($filter['sort'])) {
            if ($filter['sort'] == 'desc' || $filter['sort'] == 'asc') {
                $sql .= ' ORDER BY time ' . $filter['sort'];
            } else {
                $sql .= ' ORDER BY orders.total desc';
            }
        }

        $results = $order->query($sql);
        if (empty($results)) {
            echo json_encode(['success' => false, 'message' => 'no matching data']);
            return;
        }
        $orders = [];
        foreach ($results as $result) {
            $orders[$result->id][] = $result;
        }







        echo json_encode(['success' => true, 'filters' => $filters, 'filter' => $filter, 'orders' => $orders]);
    }
}
