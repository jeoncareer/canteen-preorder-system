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
}
