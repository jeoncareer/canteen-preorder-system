<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="<?=ROOT?>assets/css/header.css">
    <title>Sign Up</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/login.css">

   
</head>
<body>

<h1>Campus Canteen</h1>

<form action="<?=ROOT?>students/signup" method="post">

    <div class="container">
        <div class="top">
            <div class="text1">Welcome!</div>
            <div class="text2">Create a new Account</div>
            
        </div>
        
        <div class="middle">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="college" list="colleges" placeholder="College Name">
            <datalist id="colleges">
              <?php foreach ($colleges as $college): ?>
              <option value="<?=$college?>"></option>
              <?php endforeach; ?>
            </datalist>
            <input type="text" name="password" placeholder="Password">
            <button type="submit">Create</button>
        </div>
        
        <div class="bottom">
            <hr>
            <div class="text3">Already have an account? <a href="<?=ROOT?>students/login">Login Here</a> </span> </div>
        </div>
    </div>
</form>
</body>
</html>