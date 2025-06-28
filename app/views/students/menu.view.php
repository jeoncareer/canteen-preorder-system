<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canteen Menu</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/menu.css">
 <style>

  body{
    height:10000px;
  }
  .container{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    column-gap: 10px;
   padding:10px;
   font-family: Arial, Helvetica, sans-serif;
  }

  .card{
    display:flex;
    flex-direction: column;
    width:280px;
    border:1px solid black;
    
   

  }
  img{
    width:100%;
    height:200px;
  }

  .details{
    padding:10px;
    row-gap: 10px;

  }

  .details div{
    margin-bottom:10px;
  }

  button{
    width:100%;
    color:white;
    background-color: blue;
  }


 </style>
</head>
<body>
    <?php $page = 'menu' ;
  require __DIR__ .'/../header.view.php';?>

<div class="container">
  <?php foreach ($items as $item):?>
  <form action="<?=ROOT?>students/cart" method="post">

    <div class="card">
  
        <img src="<?=ROOT?>/assets/images/<?=$item->image_location?>" alt="">
      
      <div class="details">
        <div class="name"><?=$item->name?></div>
        <div class="price">$<?=$item->price?></div>
        <input type="hidden" name="item_id" value="<?=$item->id?>">
        <button>Add to cart</button>
      </div>
    </div>
  </form>
  <?php endforeach; ?>
</div>
 
</body>
</html>
