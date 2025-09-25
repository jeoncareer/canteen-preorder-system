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
}
