<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Orders - Canteen Staff</title>
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
      padding: 1rem;
    }

    h2 {
      color: #333;
      margin-bottom: 1rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      background: #ecf0f1;
      color: #555;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .status {
      padding: 0.3rem 0.6rem;
      border-radius: 4px;
      font-size: 0.9rem;
      font-weight: bold;
      text-align: center;
      display: inline-block;
    }

    .pending { background: #f1c40f; color: white; }
    .in-progress { background: #3498db; color: white; }
    .ready { background: #2ecc71; color: white; }
    .completed { background: #95a5a6; color: white; }

    .btn-update {
      background: #2980b9;
      color: white;
      padding: 0.4rem 0.8rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-update:hover {
      background: #1f6393;
    }

    footer {
      text-align: center;
      margin-top: 3rem;
      color: #888;
    }
  </style>
</head>
<body>

<header>
  <h1>Incoming Orders</h1>
</header>

<div class="container">
  <h2>Manage Orders</h2>

  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Student</th>
        <th>Items</th>
        <th>Pickup Slot</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Sample order row -->
      <tr>
        <td>#00123</td>
        <td>John Doe</td>
        <td>Veg Sandwich, Coffee</td>
        <td>12:30 PM - 12:45 PM</td>
        <td><span class="status pending">Pending</span></td>
        <td><button class="btn-update">Update</button></td>
      </tr>
      <tr>
        <td>#00124</td>
        <td>Jane Smith</td>
        <td>Chicken Roll, Pepsi</td>
        <td>1:00 PM - 1:15 PM</td>
        <td><span class="status in-progress">In Progress</span></td>
        <td><button class="btn-update">Update</button></td>
      </tr>
    </tbody>
  </table>
</div>

<footer>
  &copy; 2025 Canteen Preorder System
</footer>

</body>
</html>
