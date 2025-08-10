<?php


class Items
{
    use Model;

    protected $table = 'items';

    protected $allowedColumns = [
        'id',
        'name',
        'canteen_id',
        'price',
        'image_location',
        'category_id',
        'description',
        'status'
    ];


    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['item_name'])) {
            $this->errors["item_name"] = "Please enter item name";
        }
        if (empty($data['description'])) {
            $this->errors["description"] = "please enter description";
        }
        if (empty($data['price'])) {
            $this->errors["price"] = "Please enter price";
        }
        if (empty($data['name'])) {
            $this->errors["item_image"] = "please give item image";
        }

        if (empty($data['category_id'])) {
            $this->errors["category_id"] = "please select a category";
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }





    }



}
