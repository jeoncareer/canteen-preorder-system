<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Canteen home page</h1>
    <?= $_SESSION['CANTEEN']['email']?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="item-name">
        <br>
        <input type="file" name="item_image">
    </form>
</body>
</html>