<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?=ROOT?>assets/css/header.css">
    <title>login</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/login.css">

   
</head>
<body>

   
     <h1>Campus Canteen</h1>

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