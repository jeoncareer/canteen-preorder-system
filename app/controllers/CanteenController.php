<?php

class CanteenController extends Controller
{
    use Database;

    public function CanteenCountByStatus($status = '')

    {
        header('Content-Type: application/json');

        $canteen = new Canteen_db;
        if (empty($status)) {
            $status = 'active';
        }

        $canteens = $canteen->where(['college_id' => $_SESSION['COLLEGE']->id, 'status' => $status]);

        if ($canteens) {
            echo json_encode(['success' => true, 'count' => count($canteens)], JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['success' => false], JSON_PRETTY_PRINT);
        }
    }

    public function totalMenuItems($canteen_id = '')
    {
        header('Content-Type: application/json');
        $item = new Items;
        // $units = [];

        // if ($date == '' || $date == 'TODAY') {
        //     $units = [
        //         'DATE'  => date("j"), // day without leading zero
        //         'MONTH' => date("n"), // month without leading zero
        //         'YEAR'  => date("Y")  // year
        //     ];
        // } elseif ($date == 'MONTH') {
        //     $units = [

        //         'MONTH' => date("n"), // month without leading zero
        //         'YEAR'  => date("Y")  // year
        //     ];
        // } elseif ($date == 'YEAR') {
        //     $units = [


        //         'YEAR'  => date("Y")  // year
        //     ];
        // }

        // $unit_keys = array_keys($units);

        // $query = "SELECT count(*) as count from orders where canteen_id = {$canteen_id} AND ";

        // foreach ($unit_keys as $key) {
        //     $query .= " {$key}(`time`) = :{$key} AND ";
        // }

        // $query = trim($query, " AND ");

        if (!empty($canteen_id)) {
            $items = $item->where(['canteen_id' => $canteen_id]);
        } else {
            $items = $item->findAll();
        }







        echo json_encode(['success' => true,  'items' => $items, 'count' => count($items)], JSON_PRETTY_PRINT);
    }


    function totalOrdersByCanteen($canteen_id = '', $date = '')
    {

        header('Content-Type: application/json');
        $units = [];

        if ($date == '' || $date == 'TODAY') {
            $units = [
                'DAY'  => date("j"), // day without leading zero
                'MONTH' => date("n"), // month without leading zero
                'YEAR'  => date("Y")  // year
            ];
        } elseif ($date == 'MONTH') {
            $units = [

                'MONTH' => date("n"), // month without leading zero
                'YEAR'  => date("Y")  // year
            ];
        } elseif ($date == 'YEAR') {
            $units = [


                'YEAR'  => date("Y")  // year
            ];
        }

        $unit_keys = array_keys($units);

        $query = "SELECT count(*) as count from orders where canteen_id = {$canteen_id} AND ";

        foreach ($unit_keys as $key) {
            $query .= " {$key}(`time`) = :{$key} AND ";
        }

        $query = trim($query, " AND ");

        $results = $this->query($query, $units);

        echo json_encode(['query' => $query, 'results' => $results]);
    }
}
