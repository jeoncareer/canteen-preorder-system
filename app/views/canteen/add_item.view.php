<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>
        .container{
            margin-top:100px;
            border:1px solid black;
            padding:15px;

        }

        .container *{
            display:block;
        }

        .container input{

            margin-top:5px;
        }
    </style>
</head>
<body>
    <form method = "post" enctype="multipart/form-data">
       
    <div class="container">
        <?php
          if (isset($errors)) {

              foreach ($errors as $error) {
                  echo '<div class="alert alert-danger" role="alert">'. $error .'</div>';
              }
          }
        ?>
        <label for="">Item name:</label>
        <input type="text" name="item_name" placeholder="enter item name. eg:biriyani">
        <label for="">Item description:</label>
        <textarea name="description"></textarea>
        <label for="">Category:</label>
        <select name = "category">
            <option >select</option>
             <?php
        foreach ($enums as $enum) {

            ?>
            <option value="<?=$enum?>" > <?=$enum?> </option>
            <?php } ?>
        </select>
        <label for="">Price:</label>
        <input type="text" name="price" placeholder="price">
        <input type="file" name="item_image">
        <input type="submit" value="submit">
    </div>
    </form>
</body>
</html>