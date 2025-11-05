<?php

//home class
class Home extends Controller
{
    public function index()
    {

        session_destroy();

        $this->view('home');
    }






}
