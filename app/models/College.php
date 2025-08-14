<?php


class College
{
    use Model;

    protected $table = 'college';

    protected $allowedColumns = [
        'id',
        'email',
        'college_name',
        'password'
    ];


    public function validate($data)
    {
        $this->errors = [];
        $college = new College();

        if (empty($data['email'])) {
            $this->errors['email'] = "email is required";
            return false;
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['email'] = " Not a valid email";
            return false;
        } elseif (empty($result = $this->first(['email' => $data['email']]))) {
            $this->errors['email'] = "Email isn't registered yet";
            return false;
            // $real_password = $real_password->password;
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "password is required";
            return false;
        }

        $college = $this->first(['email' => $data['email']]);
        $password = $data['password'];
        $o_password = $college->password;
        $hash = password_verify($password, $o_password);

        if (!$hash) {
            $this->errors['password'] = "password doesn't match";
        }








        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function register_validate($data)
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
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "password is required";
        }






        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}