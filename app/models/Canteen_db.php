<?php

class Canteen_db
{
    use Model;
    protected $table = 'canteen';

    protected $allowedColumns = [
        "id",
        "college_id",
        "canteen_name",
        "email",
        "password",
        'status',
        'working_days',
        'open',
        'close',
        'description'
    ];



    public function validate($data)
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = " Not a valid email";
        }elseif(!validateEmail($data['email'])){
            $this->errors['email'] ="Incorrect domain";
        } else {

            if (!empty($this->first(['email' => $data['email']]))) {
                $this->errors['email'] = "email already exists";
            }
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "password is required";
        }
        if (empty($data['college_id'])) {
            $this->errors['college_id'] = "Please Enter College Name";
        }

        if (empty($data['canteen_name'])) {
            $this->errors['canteen_name'] = "Please Enter canteen Name";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function login_validate($data)
    {

        $this->errors = [];

        if (empty($data['email'])) {                                                 //checking if email is empty
            $this->errors['email'] = "email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {               //checking if email is valid
            $this->errors['email'] = " Not a valid email";
        } elseif(!validateEmail($data['email'])){
            $this->errors['email'] ="Incorrect domain";
        } 



        if (!empty($result = $this->first(['email' => $data['email']]))) {           // checking if user exists in the database
            if (empty($data['password'])) {                                         //check if user typed password
                $this->errors['password'] = "password is required";
            } else {

                $hash = password_verify($data['password'], $result->password);          //checking if entered password is correct
                if (!$hash) {


                    $this->errors['password'] = "password doesn't match";
                }
            }
        } else {
            $this->errors['email'] = "Canteen doesn't exist";
        }

        if (empty($this->errors)) {                                                    //if no errors return empty
            return true;
        }
        return false;
    }
}
