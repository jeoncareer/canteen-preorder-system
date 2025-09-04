<?php


function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function redirect($path)
{

    header("Location:" . ROOT . $path);
}

function convertTime($time)
{

    return date("g:i A", strtotime($time)); // 8:00 PM
}
