<?php


class ItemController extends Controller{

    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"),true);
        $item_id = $data['item_id'];

        $item = new Items;

        try{
            $item->delete($item_id);
            echo json_encode(['success' => true]);
        }catch(PDOException $e)
        {
            if($e->errorInfo[1] == 1451){
                $message = 'Cannot delete:This record is used in another table';
                echo json_encode(['success' => false,'message'=> $message]);
            }
        }
    }

    public function category()
    {   
        $item = new Items;
        $data = json_decode(file_get_contents('php://input'),true);
        $category_id = $data['category_id'];

        $items = $item->where(['category_id' => $category_id,'canteen_id' => CANTEEN_ID]);

        echo json_encode(['success' => true, 'items' => $items]);


    }

}