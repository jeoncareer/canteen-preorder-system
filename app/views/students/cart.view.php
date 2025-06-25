<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canteen Cart</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
      margin: 0;
      padding: 20px;
    }

    .cart-container {
      max-width: 700px;
      margin: auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #eee;
      padding: 15px 0;
    }

    .item-name {
      font-weight: 500;
    }

    .item-qty {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .item-qty button {
      width: 30px;
      height: 30px;
      border: none;
      background: #007bff;
      color: white;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    .item-price {
      font-weight: bold;
      color: #444;
    }

    .total {
      text-align: right;
      font-size: 18px;
      margin-top: 20px;
    }

    .place-order {
      display: block;
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
    }

    .place-order:hover {
      background: #218838;
    }
  </style>
</head>
<body>

  <div class="cart-container">
    <h2>Your Cart</h2>

    <div class="cart-item">
      <div class="item-name">Veg Sandwich</div>
      <div class="item-qty">
        <button>-</button>
        <span>2</span>
        <button>+</button>
      </div>
      <div class="item-price">₹80</div>
    </div>

    <div class="cart-item">
      <div class="item-name">Cold Coffee</div>
      <div class="item-qty">
        <button>-</button>
        <span>1</span>
        <button>+</button>
      </div>
      <div class="item-price">₹60</div>
    </div>

    <div class="total">
      Total: ₹140
    </div>

    <button class="place-order">Place Order</button>
  </div>

</body>
</html>
