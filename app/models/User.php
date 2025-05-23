<?php

class User
{
    use Model;
    protected $table = 'users';

    protected $allowedColumns = [
        'email',
        'password'
    ];
    
    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['email'])){
            $this->errors['email'] = "email is required";
        }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = " Not a valid email";
        }

         if(empty($data['password'])){
            $this->errors['password'] = "password is required";
        }
          if(empty($data['terms'])){
            $this->errors['terms'] = "Please accept terms and conditions";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;

    }

    public function login_validate($data){

                $this->errors = [];

        if(empty($data['email'])){                                                 //checking if email is empty
            $this->errors['email'] = "email is required";
        }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){               //checking if email is valid
            $this->errors['email'] = " Not a valid email";
        }

        
          if(empty($data['terms'])){                                               //checking if user accepted terms and conditions
            $this->errors['terms'] = "Please accept terms and conditions";
        }

        if(!empty($result = $this->first(['email' => $data['email']]))){           // checking if user exists in the database
             if(empty($data['password'])){                                         //check if user typed password
            $this->errors['password'] = "password is required";
        }else{

            $hash = password_verify($data['password'],$result->password);          //checking if entered password is correct
            if(!$hash){
               
           
             $this->errors['wrong_password']="password doesn't match";
            }
        }
        }else{
            $this->errors['email_not_exist'] = "user doesn't exist";
        }

        if(empty($this->errors)){                                                    //if no errors return empty
            return true;
        }
        return false;

    }
}
