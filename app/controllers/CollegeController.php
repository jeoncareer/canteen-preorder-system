<?php

class CollegeController extends Controller
{
    use Database;

    public function totalRevenue()
    {
        $orders = new Orders;
        $data = json_decode(file_get_contents('php://input'), true);
        $units = $data['units'] ?? [];
        $college_id = $_SESSION['COLLEGE']->id;
        $sql = "SELECT SUM(orders.total) as total_revenue
        FROM orders
        JOIN students ON orders.student_id = students.id
        WHERE students.college_id = {$college_id} AND orders.status = 'completed'";

        if (!empty($units)) {
            $unit_keys = array_keys($units);
            $sql .= " AND ";
            foreach ($unit_keys as $key) {
                $sql .= " {$key}(orders.time) = :{$key} AND ";
            }
        }

        $sql = trim($sql, " AND ");
        $result = $this->query($sql, $units);
        $total_revenue = $result[0]->total_revenue ?? 0;
        echo json_encode(['total_revenue' => $total_revenue]);
    }
}
