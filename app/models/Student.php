<?php

class Student
{
    use Model;
    protected $table = 'students';

    protected $allowedColumns = [
        'email',
        'password',
        'college_id'
    ];

    public function validate($data)
    {
        $this->errors = [];
        $college = new College();

        if (empty($data['email'])) {
            $this->errors['email'] = "email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = " Not a valid email";
        }

        if (!empty($result = $this->first(['email' => $data['email']]))) {
            $this->errors["user_exists"] = "email already exists";
        }
        if (empty($data['college_name'])) {
            $this->errors['college_name'] = "Please give College name";
        } elseif (empty($college->first(["college_name" => $data["college_name"]]))) {
            $this->errors["college_doesn't exist"] = "College doesn't exist";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "password is required";
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
        }



        if (!empty($result = $this->first(['email' => $data['email']]))) {           // checking if user exists in the database
            if (empty($data['password'])) {                                         //check if user typed password
                $this->errors['password'] = "password is required";
            } else {

                $hash = password_verify($data['password'], $result->password);          //checking if entered password is correct
                if (!$hash) {


                    $this->errors['wrong_password'] = "password doesn't match";
                }
            }
        } else {
            $this->errors['email_not_exist'] = "Student doesn't exist";
        }

        if (empty($this->errors)) {                                                    //if no errors return empty
            return true;
        }
        return false;
    }
}
