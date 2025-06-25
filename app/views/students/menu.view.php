<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canteen Menu</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/menu.css">
 
</head>
<body>
    <?php $page = 'menu' ;
  require __DIR__ .'/../header.view.php';?>
  <h1>Today's Menu</h1>
<div class="menu-container">
<form action="<?=ROOT?>students/cart" method="post">

  <?php foreach ($items as $item): ?>
  <div class="menu-item">
    <img class="menu-img" src="<?=ROOT?>assets/images/<?=$item->image_location?>" alt="Veg Sandwich">
    <div class="menu-content">
      <div class="menu-title"><?=$item->name?></div>
      <div class="menu-price">₹<?=$item->price?></div>
      <input type="hidden" name="item_id" value="<?=$item->id?>">
     <button class="menu-button" type="submit">Add to card</button>
    </div>
  </div>
  <?php endforeach; ?>
</form>



</div>

 
</body>
</html>
