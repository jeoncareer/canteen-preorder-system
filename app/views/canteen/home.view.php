<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Canteen Staff Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
    }
    header {
      background: #2c3e50;
      color: white;
      padding: 1rem 2rem;
      text-align: center;
    }
    .container {
      max-width: 1100px;
      margin: 2rem auto;
      padding: 0 1rem;
    }
    .greeting {
      margin-bottom: 2rem;
      font-size: 1.5rem;
      color: #333;
    }
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1rem;
      cursor: pointer;
    }
    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: translateY(-4px);
    }
    .card h2 {
      font-size: 2rem;
      margin: 0.5rem 0;
      color: #2980b9;
    }
    .card p {
      color: #666;
    }
    footer {
      text-align: center;
      margin-top: 3rem;
      color: #888;
    }

    a{
        text-decoration: none;
    }
  </style>
</head>
<body>

<header>
  <h1>Canteen Staff Dashboard</h1>
</header>

<div class="container">
  <div class="greeting">
    👋 Welcome, [Staff Name]!
  </div>

  <a href="">

      <div class="cards">
        <div class="card">
          <h2>🍽️</h2>
          <h2>Menu</h2>
          <p>Add, edit or remove food items</p>
        </div>
  </a>
<a href="<?=ROOT?>canteen/orders">

    <div class="card">
      <h2>📦</h2>
      <h2>Orders</h2>
      <p>View and manage incoming orders</p>
    </div>
</a>

    <div class="card">
      <h2>⏰</h2>
      <h2>Time Slots</h2>
      <p>Set and update pickup time slots</p>
    </div>

    <div class="card">
      <h2>📊</h2>
      <h2>Status</h2>
      <p>Update order status (Pending, Ready...)</p>
    </div>
  </div>
</div>

<footer>
  &copy; 2025 Canteen Preorder System
</footer>

</body>
</html>
