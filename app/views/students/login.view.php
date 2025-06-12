<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?=ROOT?>assets/css/header.css">
    <title>login</title>

    <style>
        .container{
           
            display: flex;
            flex-direction: column;
            width:470px;
            margin:150px auto;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 0 5px rgba(0,0,0,0.3);
           

        }

        .container > div{
            display: flex;
            flex-direction: column;
        }

        .top{
            width:100%;
            background-color: #6366F1;
            
             color:white;
             align-items: center;
             padding:42px 0;
             row-gap: 13px;
             border-top-right-radius: 16px;
             border-top-left-radius: 16px;
             
        }



        .text1{
            font-weight: bold;
            font-size: 40px;
        }

        .text2{
            font-size: 16px;
        }
        
        .middle{
            align-items: center;
            row-gap: 44px;
            
            padding:40px 0px;
        }

        .middle input{
            width:84%;
            height:45px;
            border:1px solid #B8B8B8;
            padding-left: 20px;
            border-radius: 3px;
        }

        input::placeholder{
            font-size:16px;
            
        }

        .middle button{
            width:88%;
            height:45px;
            font-weight: bold;
            font-size: 24px;
            color:white;
            background-color: #6366F1;
            border:none;
            border-radius: 3px;
        }

        hr{
            width:84%;
            height:0px;

        }

        .bottom{
            flex-direction: row;
            align-items: center;

        }

        .bottom a{
            font-weight: bold;
            font-size: 15px;
            color:#6366F1;
        }

        .text3{
            font-weight: bold;
            font-size: 15px;
            color:#9C9C9C;
            padding:33px 0px;
        }
    </style>
</head>
<body>
    <?php
    $page = 'login';
     require "header.view.php" ?>


<form action="<?=ROOT?>students/login" method="post">

    <div class="container">
        <div class="top">
            <div class="text1">Welcome Back</div>
            <div class="text2">Login To Your Account</div>
            
        </div>
        
        <div class="middle">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </div>
        
        <div class="bottom">
            <hr>
            <div class="text3">Don't have an account? <a href="<?=ROOT?>students/signup">Sign Up Here</a> </span> </div>
        </div>
    </div>
</form>
</body>
</html>