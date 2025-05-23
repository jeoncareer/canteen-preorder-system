<?php


class Signup extends Controller{
    function index()
    {
        $user = new User;
        
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {

                 
              if($user->validate($_POST)){
                $password = $_POST['password'];
                $password = password_hash($password,PASSWORD_DEFAULT);
                $_POST['password'] = $password; 
                  $user->insert($_POST);
                  redirect('login');
              }
              $data['errors'] = $user->errors;
              $this->view('signup',$data);
        }else{
     
            
            $this->view('signup');
        }
        
    }
}