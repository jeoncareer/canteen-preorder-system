<?php
//home class
class Home extends Controller
{
    function index($a = '', $b = '', $c = '')
    {
   if(empty($_SESSION['USER'])){
    redirect('login');
   }
    
        $data['username'] = $_SESSION['USER']->email;
        $this->view('home',$data);
    }


}
