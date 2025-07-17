<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Canteen Dashboard - Campus Canteen</title>
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">

  <style>
    /* Dashboard-specific styles only */

    .dashboard-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: 2rem;
      position: relative;
      overflow: hidden;
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--gradient);
    }

    .stat-card.earnings::before {
      background: linear-gradient(90deg, var(--secondary-color), #5dade2);
    }

    .stat-card.orders::before {
      background: linear-gradient(90deg, var(--success-color), #58d68d);
    }

    .stat-card.completed::before {
      background: linear-gradient(90deg, var(--warning-color), #f7dc6f);
    }

    .stat-card.rejected::before {
      background: linear-gradient(90deg, var(--danger-color), #ec7063);
    }

    .stat-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .stat-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: white;
    }

    .stat-icon.earnings {
      background: var(--secondary-color);
    }

    .stat-icon.orders {
      background: var(--success-color);
    }

    .stat-icon.completed {
      background: var(--warning-color);
    }

    .stat-icon.rejected {
      background: var(--danger-color);
    }

    .stat-value {
      font-size: 2.5rem;
      font-weight: 700;
      margin: 0;
      color: var(--primary-color);
    }

    .stat-label {
      color: #64748b;
      font-size: 0.95rem;
      font-weight: 500;
      margin: 0.5rem 0 0 0;
    }

    .stat-change {
      font-size: 0.85rem;
      font-weight: 600;
      margin-top: 0.5rem;
    }

    .stat-change.positive {
      color: var(--success-color);
    }

    .stat-change.negative {
      color: var(--danger-color);
    }

    .content-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 2rem;
    }



    .orders-table {
      width: 100%;
      border-collapse: collapse;
    }

    .orders-table th {
      background: #f8fafc;
      color: var(--primary-color);
      font-weight: 600;
      padding: 1rem;
      text-align: left;
      border-bottom: 2px solid #e2e8f0;
      font-size: 0.9rem;
    }

    .orders-table td {
      padding: 1rem;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }

    .orders-table tr:hover {
      background: #f8fafc;
    }

    .order-id {
      font-weight: 700;
      color: var(--secondary-color);
    }

    .student-name {
      font-weight: 600;
      color: var(--primary-color);
    }

    .order-items {
      color: #64748b;
      font-size: 0.9rem;
    }



    .status-select {
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: 2px solid transparent;
      background: transparent;
      cursor: pointer;
      transition: var(--transition);
      outline: none;
    }

    .status-select:hover {
      border-color: var(--secondary-color);
    }

    .status-select.pending {
      background: #fef3c7;
      color: #92400e;
    }

    .status-select.accepted {
      background: #d1fae5;
      color: #065f46;
    }

    .status-select.completed {
      background: #ddd6fe;
      color: #5b21b6;
    }

    .status-select.rejected {
      background: #fee2e2;
      color: #991b1b;
    }

    .status-select option {
      background: white;
      color: #333;
      font-weight: normal;
      text-transform: none;
      letter-spacing: normal;
    }

    .order-time {
      color: #64748b;
      font-size: 0.9rem;
    }

    .quick-actions {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .action-btn {
      display: block;
      width: 100%;
      padding: 1rem;
      margin-bottom: 1rem;
      background: white;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      text-decoration: none;
      color: var(--primary-color);
      font-weight: 600;
      text-align: center;
      transition: var(--transition);
    }

    .action-btn:hover {
      border-color: var(--secondary-color);
      background: #f8fafc;
      transform: translateY(-2px);
    }

    .action-btn i {
      margin-right: 0.5rem;
      color: var(--secondary-color);
    }

    .recent-activity {
      margin-top: 2rem;
    }

    .activity-item {
      display: flex;
      align-items: center;
      padding: 1rem 0;
      border-bottom: 1px solid #f1f5f9;
    }

    .activity-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 1rem;
      font-size: 0.9rem;
    }

    .activity-icon.new-order {
      background: #dbeafe;
      color: var(--secondary-color);
    }

    .activity-icon.completed {
      background: #d1fae5;
      color: var(--success-color);
    }

    .activity-content {
      flex: 1;
    }

    .activity-text {
      margin: 0;
      font-weight: 600;
      color: var(--primary-color);
    }

    .activity-time {
      margin: 0;
      font-size: 0.8rem;
      color: #64748b;
    }

    @media (max-width: 1200px) {
      .content-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 900px) {
      .main-content {
        padding: 1rem;
      }

      .dashboard-stats {
        grid-template-columns: 1fr;
      }

      .welcome-section h1 {
        font-size: 2rem;
      }

      .orders-table {
        font-size: 0.9rem;
      }

      .orders-table th,
      .orders-table td {
        padding: 0.8rem 0.5rem;
      }
    }
  </style>
</head>

<body>
  <!-- Header (identical to students) -->
  <?php
  require 'header.view.php';
  ?>

  <!-- Container for sidebar and main content -->
  <div class="container">
    <!-- Sidebar (canteen-specific links) -->
    <?php $page = "dashboard";
    require 'sidebar.view.php';
    ?>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Welcome Section -->
      <div class="welcome-section">
        <div class="welcome-content">
          <h1>Welcome back! 👋</h1>
          <p>Here's what's happening with your canteen today</p>
        </div>
      </div>

      <!-- Dashboard Stats -->
      <div class="dashboard-stats">
        <div class="stat-card earnings">
          <div class="stat-header">
            <div class="stat-icon earnings">
              ₹
            </div>
          </div>
          <h2 class="stat-value">₹12,500</h2>
          <p class="stat-label">Total Earnings</p>
          <p class="stat-change positive">
            ↗ +12% from yesterday
          </p>
        </div>

        <div class="stat-card orders">
          <div class="stat-header">
            <div class="stat-icon orders">
              🛒
            </div>
          </div>
          <h2 class="stat-value">320</h2>
          <p class="stat-label">Total Orders</p>
          <p class="stat-change positive">
            ↗ +8% from yesterday
          </p>
        </div>

        <div class="stat-card completed">
          <div class="stat-header">
            <div class="stat-icon completed">
              ✅
            </div>
          </div>
          <h2 class="stat-value">280</h2>
          <p class="stat-label">Completed Orders</p>
          <p class="stat-change positive">
            ↗ +5% from yesterday
          </p>
        </div>

        <div class="stat-card rejected">
          <div class="stat-header">
            <div class="stat-icon rejected">
              ❌
            </div>
          </div>
          <h2 class="stat-value">15</h2>
          <p class="stat-label">Rejected Orders</p>
          <p class="stat-change negative">
            ↘ -3% from yesterday
          </p>
        </div>
      </div>

      <!-- Content Grid -->
      <div class="content-grid">
        <!-- Recent Orders Section -->
        <div class="orders-section">
          <div class="section-header">
            <h2 class="section-title">Recent Orders</h2>
            <a href="#" class="view-all-btn">
              ↗ View All
            </a>
          </div>

          <table class="orders-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Student</th>
                <th>Items</th>
                <th>Status</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><span class="order-id">#1023</span></td>
                <td><span class="student-name">John Doe</span></td>
                <td><span class="order-items">Veg Sandwich x1, Coffee x2</span></td>
                <td>
                  <select data-id='1023' class="status-select pending">
                    <option value="pending" selected>Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="completed">Completed</option>
                    <option value="rejected">Rejected</option>
                  </select>
                </td>
                <td><span class="order-time">10:15 AM</span></td>
              </tr>




            </tbody>
          </table>
        </div>

        <!-- Quick Actions & Activity -->
        <div>
          <!-- Quick Actions -->
          <div class="quick-actions">
            <div class="section-header">
              <h2 class="section-title">Quick Actions</h2>
            </div>

            <a href="#" class="action-btn">
              ➕ Add New Item
            </a>

            <a href="#" class="action-btn">
              📋 Manage Menu
            </a>

            <a href="#" class="action-btn">
              🏷️ Categories
            </a>

            <a href="#" class="action-btn">
              📊 View Reports
            </a>
          </div>

          <!-- Recent Activity -->
          <div class="quick-actions recent-activity">
            <div class="section-header">
              <h2 class="section-title">Recent Activity</h2>
            </div>

            <div class="activity-item">
              <div class="activity-icon new-order">
                🛒
              </div>
              <div class="activity-content">
                <p class="activity-text">New order from Sarah Wilson</p>
                <p class="activity-time">2 minutes ago</p>
              </div>
            </div>

            <div class="activity-item">
              <div class="activity-icon completed">
                ✓
              </div>
              <div class="activity-content">
                <p class="activity-text">Order #1018 completed</p>
                <p class="activity-time">5 minutes ago</p>
              </div>
            </div>

            <div class="activity-item">
              <div class="activity-icon new-order">
                🍽️
              </div>
              <div class="activity-content">
                <p class="activity-text">Menu item "Pasta" added</p>
                <p class="activity-time">1 hour ago</p>
              </div>
            </div>

            <div class="activity-item">
              <div class="activity-icon completed">
                📈
              </div>
              <div class="activity-content">
                <p class="activity-text">Daily report generated</p>
                <p class="activity-time">2 hours ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Status change functionality
    const statusSelects = document.querySelectorAll('.status-select');

    statusSelects.forEach(function(select) {
      select.addEventListener('change', function() {
        const orderId = this.dataset.id;
        const newStatus = this.value;

        // Remove all status classes
        this.classList.remove('pending', 'accepted', 'completed', 'rejected');

        // Add the new status class
        this.classList.add(newStatus);

        // Log the change (you can replace this with an AJAX call to update the database)
        console.log(`Order ${orderId} status changed to: ${newStatus}`);

        // Optional: Show a success message
        showStatusChangeMessage(orderId, newStatus);

        // Here you would typically make an AJAX call to update the database
        // updateOrderStatus(orderId, newStatus);
      });
    });

    // Function to show status change message
    function showStatusChangeMessage(orderId, status) {
      // Create a temporary notification
      const notification = document.createElement('div');
      notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        z-index: 10000;
        font-weight: 600;
        animation: slideIn 0.3s ease;
      `;

      notification.textContent = `Order ${orderId} status updated to ${status.toUpperCase()}`;
      document.body.appendChild(notification);

      // Remove notification after 3 seconds
      setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }

    // Add CSS animations for notifications
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
      @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
      }
    `;
    document.head.appendChild(style);

    // Example function for AJAX call (uncomment and modify as needed)
    /*
    function updateOrderStatus(orderId, status) {
      fetch('/api/orders/update-status', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          order_id: orderId,
          status: status
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showStatusChangeMessage(orderId, status);
        } else {
          console.error('Failed to update order status');
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    }
    */
  </script>
</body>

</html>