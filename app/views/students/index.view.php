<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    foreach ($canteens as $canteen) {

        ?>
    <a href="<?=ROOT?>students/canteen/<?=urlencode($canteen)?>"> <?=$canteen?></a> 
    <br>

    <?php } ?>
</body>
</html>