<?php

class CanteenController extends Controller
{
    use Database;

    function totalCanteens($status = '')
    {
        $canteens = new Canteen_db;
        $where['college_id'] = $_SESSION['COLLEGE']->id;
        if (!empty($status)) {
            $where['status'] = $status;
        }
        $count = $canteens->count($where);
        echo json_encode(['count' => $count]);
    }


    function blockCanteen($id)
    {
        $canteen = new Canteen_db;
        $can = $canteen->first(['id' => $id]);
        if ($can->status !== 'inactive') {

            $canteen->update(['id' => $id], ['status' => 'inactive']);
            echo json_encode(['success' => true, ' action' => 'blocked']);
        } else {
            $canteen->update(['id' => $id], ['status' => 'active']);
            echo json_encode(['success' => true, 'action' => 'unblocked']);
        }
    }

    public function getOrders($canteen_id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $student = new Student();
        $order_item = new Order_items();
        $item = new Items();
        $query = "SELECT * FROM orders WHERE canteen_id = :canteen_id";
        $params = ['canteen_id' => $canteen_id];

        // Add status filter if provided
        if (isset($data['status']) && !empty($data['status'])) {
            $query .= " AND status = :status";
            $params['status'] = $data['status'];
        }

        // Add date range filter if provided
        if (isset($data['dateRange']) && !empty($data['dateRange'])) {
            if ($data['dateRange'] === 'today') {
                $query .= " AND DATE(time) = CURDATE()";
            } elseif ($data['dateRange'] === 'week') {
                $query .= " AND YEARWEEK(time, 1) = YEARWEEK(CURDATE(), 1)";
            } elseif ($data['dateRange'] === 'month') {
                $query .= " AND MONTH(time) = MONTH(CURDATE()) AND YEAR(time) = YEAR(CURDATE())";
            } elseif ($data['dateRange'] === 'yesterday') {
                $query .= " AND DATE(time) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
            }
        }

        // Add sorting
        if (isset($data['sort']) && !empty($data['sort'])) {
            if ($data['sort'] === 'date_desc') {
                $query .= " ORDER BY time DESC";
            } elseif ($data['sort'] === 'date_asc') {
                $query .= " ORDER BY time ASC";
            } elseif ($data['sort'] === 'amount_desc') {
                $query .= " ORDER BY total DESC";
            } elseif ($data['sort'] === 'amount_asc') {
                $query .= " ORDER BY total ASC";
            }
        } else {
            $query .= " ORDER BY created_at DESC";
        }

        // Add pagination
        $offset = isset($data['offset']) ? (int)$data['offset'] : 1;
        $limit = 10;
        $offset_value = ($offset - 1) * $limit; // Convert page number to offset

        $query .= " LIMIT $limit OFFSET $offset_value";

        // Debug output
        error_log("Query: " . $query);
        error_log("Params: " . json_encode($params));

        try {
            $orders = $this->query($query, $params);

            foreach ($orders as $row) {
                $row->student = $student->first(['id' => $row->student_id]);
                $row->items = $order_item->where(['order_id' => $row->id]);
                foreach ($row->items as $row) {
                    $row->item = $item->first(['id' => $row->item_id]);
                }
            }
            echo json_encode(['success' => true, 'orders' => $orders, 'query' => $query]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
