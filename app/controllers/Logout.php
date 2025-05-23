<?php
//home class
class Logout extends Controller
{
    function index()
    {

   
       session_destroy();
       redirect('home');
    }


}
