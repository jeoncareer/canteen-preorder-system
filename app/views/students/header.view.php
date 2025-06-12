<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/header.css">
  
</head>
<body>
    <nav class="header">
        <div class="logo">Campus Canteen</div>
        <div class="options">
            <a href="">Home</a>
             <?php if ($page === 'signup'):?>
            <a href="<?=ROOT?>students/login">login</a>
            <?php endif;?>
            <?php if ($page === 'login'):?>
            <a href="<?=ROOT?>students/signup">Signup</a>
            <?php endif;?>
        </div>
    </nav>
</body>
</html>
