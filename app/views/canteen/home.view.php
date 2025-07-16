<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Canteen Staff Dashboard</title>
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
  <style>
    body {
      margin: 0;
      background: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
    }

    .sidebar {
      position: fixed;
      top: 64px;
      left: 0;
      width: 220px;
      height: calc(100vh - 64px);
      background: #fff;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.03);
      z-index: 999;
    }

    .main-content {
      margin-left: 220px;
      margin-top: 64px;
      padding: 2rem;
      background: #f4f6f9;
      min-height: calc(100vh - 64px);
    }

    .dashboard-stats {
      display: flex;
      gap: 2rem;
      margin-top: 2rem;
      flex-wrap: wrap;
    }

    .stat-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
      padding: 2rem;
      min-width: 200px;
      flex: 1 1 200px;
      text-align: center;
    }

    .stat-card h2 {
      margin: 0 0 0.5rem 0;
      font-size: 2.2rem;
    }

    .stat-card .stat-label {
      color: #888;
      font-size: 1.1rem;
    }

    .orders-section {
      margin-top: 3rem;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
      padding: 2rem;
    }

    .orders-section h2 {
      margin-top: 0;
      font-size: 1.3rem;
      color: #333;
    }

    .orders-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .orders-table th,
    .orders-table td {
      padding: 0.8rem 1rem;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    .orders-table th {
      background: #f8f9fa;
      color: #555;
      font-weight: 600;
    }

    .orders-table tr:last-child td {
      border-bottom: none;
    }

    .order-status-select {
      padding: 0.3rem 0.7rem;
      border-radius: 5px;
      font-size: 0.95rem;
      font-weight: 600;
      border: 1px solid #ddd;
      background: #f8f9fa;
      color: #333;
      outline: none;
    }

    .order-status-select.pending {
      background: #f1c40f22;
      color: #b7950b;
    }

    .order-status-select.accepted {
      background: #27ae6022;
      color: #229954;
    }

    .order-status-select.completed {
      background: #8e44ad22;
      color: #76448a;
    }

    .order-status-select.rejected {
      background: #e74c3c22;
      color: #c0392b;
    }

    @media (max-width: 900px) {
      .sidebar {
        position: static;
        width: 100%;
        height: auto;
      }

      .main-content {
        margin-left: 0;
        margin-top: 120px;
        padding: 1rem;
      }

      .dashboard-stats {
        flex-direction: column;
        gap: 1rem;
      }

      .orders-section {
        padding: 1rem;
      }
    }
  </style>
</head>

<body>
  <!-- Header (identical to students) -->
  <div class="header">
    <div class="header-left">
      <h1>🍽️ Campus Canteen</h1>
    </div>
    <div class="header-right">
      <div class="user-profile">
        <div class="user-avatar">C</div>
        <div>
          <div style="font-weight: 600;">canteen@college.edu</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar (canteen-specific links) -->
  <div class="sidebar">
    <ul class="nav-menu">
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <span class="nav-icon">🏠</span>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="nav-icon">🍽️</span>
          <span>Menu Management</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="nav-icon">📦</span>
          <span>Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="nav-icon">🗂️</span>
          <span>Categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="nav-icon">📊</span>
          <span>Order History</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <span class="nav-icon">🚪</span>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content: Dashboard Stats and Recent Orders -->
  <div class="main-content">
    <h1 style="margin-bottom: 1.5rem;">Canteen Dashboard</h1>
    <div class="dashboard-stats">
      <div class="stat-card">
        <h2 style="color:#2980b9;">₹12,500</h2>
        <div class="stat-label">Total Earnings</div>
      </div>
      <div class="stat-card">
        <h2 style="color:#27ae60;">320</h2>
        <div class="stat-label">Total Orders</div>
      </div>
      <div class="stat-card">
        <h2 style="color:#8e44ad;">280</h2>
        <div class="stat-label">Completed Orders</div>
      </div>
      <div class="stat-card">
        <h2 style="color:#e74c3c;">15</h2>
        <div class="stat-label">Rejected Orders</div>
      </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="orders-section">
      <h2>Recent Orders</h2>
      <table class="orders-table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Student Name</th>
            <th>Items</th>
            <th>Status</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#1023</td>
            <td>John Doe</td>
            <td>Veg Sandwich x1, Coffee x2</td>
            <td>
              <select class="order-status-select pending">
                <option value="pending" selected>Pending</option>
                <option value="accepted">Accepted</option>
                <option value="completed">Completed</option>
                <option value="rejected">Rejected</option>
              </select>
            </td>
            <td>10:15 AM</td>
          </tr>
          <tr>
            <td>#1022</td>
            <td>Jane Smith</td>
            <td>Chicken Roll x1, Pepsi x1</td>
            <td>
              <select class="order-status-select accepted">
                <option value="pending">Pending</option>
                <option value="accepted" selected>Accepted</option>
                <option value="completed">Completed</option>
                <option value="rejected">Rejected</option>
              </select>
            </td>
            <td>10:10 AM</td>
          </tr>
          <tr>
            <td>#1021</td>
            <td>Rahul Kumar</td>
            <td>Masala Dosa x2</td>
            <td>
              <select class="order-status-select completed">
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="completed" selected>Completed</option>
                <option value="rejected">Rejected</option>
              </select>
            </td>
            <td>09:55 AM</td>
          </tr>
          <tr>
            <td>#1020</td>
            <td>Priya Singh</td>
            <td>Idli x1, Sambar x1</td>
            <td>
              <select class="order-status-select rejected">
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="completed">Completed</option>
                <option value="rejected" selected>Rejected</option>
              </select>
            </td>
            <td>09:40 AM</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>