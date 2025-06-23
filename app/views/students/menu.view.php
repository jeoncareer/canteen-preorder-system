<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canteen Menu</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f2f5;
      margin: 0;
     
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .menu-container {
      display: grid;
   grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
   padding: 20px;

      gap: 20px;
    }

    .menu-item {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      transition: transform 0.2s ease-in-out;
    }

    .menu-item:hover {
      transform: translateY(-4px);
    }

    .menu-img {
      height: 150px;
      width: 100%;
      object-fit: cover;
    }

    .menu-content {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .menu-title {
      font-size: 1.1rem;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .menu-price {
      color: #28a745;
      font-weight: bold;
      margin-bottom: 12px;
    }

    .menu-button {
      padding: 8px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.3s;
    }

    .menu-button:hover {
      background-color: #0056b3;
    }
    
    a{
      text-decoration: none;
      color:white;
    }
  </style>
</head>
<body>
    <?php $page = '' ;
    require __DIR__ .'/../header.view.php';?>
  <h1>Today's Menu</h1>
<div class="menu-container">

  <?php foreach ($items as $item): ?>
  <div class="menu-item">
    <img class="menu-img" src="<?=ROOT?>assets/images/<?=$item->image_location?>" alt="Veg Sandwich">
    <div class="menu-content">
      <div class="menu-title"><?=$item->name?></div>
      <div class="menu-price">₹<?=$item->price?></div>
     <button class="menu-button"><a href="">Order</a></button>
    </div>
  </div>
  <?php endforeach; ?>



</div>

 
</body>
</html>
