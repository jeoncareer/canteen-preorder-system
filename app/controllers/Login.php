<?php


class Login extends Controller{
    function index()
    {
    
       $user = new User;
        
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {

                 
              if($user->login_validate($_POST)){

                $this->view('login');
              }
              $data['errors'] = $user->errors;
              $this->view('login',$data);
        }else{
   
            
            $this->view('login');
        }
        
    }
}