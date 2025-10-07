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
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/add-item.css">
  <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/menu-management.css">
  <script>
    const ROOT = "<?= ROOT ?>";
  </script>
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
      background: var(--secondary-color);
    }

    .stat-card.orders::before {
      background: var(--success-color);
    }

    .stat-card.completed::before {
      background: var(--warning-color);
    }

    .stat-card.rejected::before {
      background: var(--danger-color);
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

    .status-select.ready {
      background: rgb(79, 226, 21);
      color: rgb(5, 116, 5);
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
          <h2 class="stat-value">₹<?= $total_earnings ?></h2>
          <p class="stat-label">Total Earnings</p>

        </div>

        <div class="stat-card orders">
          <div class="stat-header">
            <div class="stat-icon orders">
              🛒
            </div>
          </div>
          <h2 class="stat-value"><?= $total_orders ?></h2>
          <p class="stat-label">Total Orders</p>

        </div>

        <div class="stat-card completed">
          <div class="stat-header">
            <div class="stat-icon completed">
              ✅
            </div>
          </div>
          <h2 class="stat-value"><?= $completed_orders ?></h2>
          <p class="stat-label">Completed Orders</p>

        </div>

        <div class="stat-card rejected">
          <div class="stat-header">
            <div class="stat-icon rejected">
              ❌
            </div>
          </div>
          <h2 class="stat-value"><?= $rejected_orders ?></h2>
          <p class="stat-label">Rejected Orders</p>

        </div>
      </div>

      <!-- Content Grid -->
      <div class="content-grid">
        <!-- Recent Orders Section -->
        <div class="orders-section">
          <div class="section-header">
            <h2 class="section-title">Recent Orders</h2>
            <!-- <a href="#" class="view-all-btn" onclick="updateOrders()">
              ↗ View All
            </a> -->
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
              <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order_id => $order): ?>
                  <tr>
                    <td><span data-order-id="<?= $order_id ?>" class="order-id">#<?= $order_id ?></span></td>
                    <td><span class="student-name"><?= $order[0]->student_id ?></span></td>
                    <td><span class="order-items">
                        <?php foreach ($order as $or): ?>
                          <?= ucfirst($or->name) ?> x<?= $or->quantity ?>,
                        <?php endforeach; ?>
                      </span></td>
                    <td>
                      <select data-id='<?= $order[0]->id ?>' class="status-select <?= $order[0]->status ?>">
                        <option value="pending" <?php if ($order[0]->status == 'pending') {
                                                  echo 'selected';
                                                } ?>>Pending</option>
                        <option value="accepted" <?php if ($order[0]->status == 'accepted') {
                                                    echo 'selected';
                                                  } ?>>Accepted</option>
                        <option value="completed" <?php if ($order[0]->status == 'completed') {
                                                    echo 'selected';
                                                  } ?>>Completed</option>
                        <option value="ready" <?php if ($order[0]->status == 'ready') {
                                                echo 'selected';
                                              } ?>>Ready</option>
                        <option value="rejected" <?php if ($order[0]->status == 'rejected') {
                                                    echo 'selected';
                                                  } ?>>Rejected</option>
                      </select>
                    </td>
                    <td><span class="order-time"><?= timeAgoOrDate($order[0]->time, false, '1 day') ?></span></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>



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

            <a href="#" class="action-btn" data-modal-target="#modal" class="add-item-section">
              ➕ Add New Item
            </a>

            <a href="<?= ROOT ?>canteen/menu_management" class="action-btn">
              📋 Manage Menu
            </a>


          </div>

          <div id="overlay"></div>
          <div class="modal" id="modal">
            <div class="modal-header">
              <div class="modal-title">🍽️ Add New Menu Item</div>
              <button data-close-button="close-button" class="close-button">&times;</button>
            </div>
            <div class="modal-body">
              <form class="add-item-form" method="post" action="<?= ROOT ?>canteen/menu_management">
                <div class="form-row">
                  <div class="form-group">
                    <label class="form-label" for="item-name">Item Name *</label>
                    <input type="text" id="item-name" name="item_name" value="chicken biriyani" class="form-input" placeholder="e.g., Chicken Biryani" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="item-price">Price (₹) *</label>
                    <input type="number" id="item-price" name="price" value="10" class="form-input" placeholder="0.00" min="0" step="0.01" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="item-description">Description</label>
                  <textarea id="item-description" name="description" class="form-textarea" placeholder="Describe your delicious dish..." rows="3">a indian food</textarea>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label class="form-label" for="item-category">Category *</label>
                    <select id="item-category" name="category" class="form-select" required>
                      <option value="">Select Category</option>
                      <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= ucfirst($cat['name']) ?></option>
                      <?php endforeach; ?>

                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="item-status">Availability *</label>
                    <select id="item-status" name="status" class="form-select" required>
                      <option value="available">Available</option>
                      <option value="unavailable">Unavailable</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label" for="item-emoji">Food Emoji</label>
                  <input type="text" id="item-emoji" name="emoji" class="form-input" placeholder="🍛" maxlength="2">
                  <small class="form-help">Choose an emoji to represent your dish (optional)</small>
                </div>

                <div class="modal-actions">
                  <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                  <button type="submit" class="btn btn-primary">
                    <span class="btn-icon">➕</span>
                    Add Menu Item
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Recent Activity -->
          <!-- <div class="quick-actions recent-activity">
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
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <script src="<?= ROOT ?>assets/js/canteen-dashboard.js">
    // Status change functionality
  </script>

  <script src="<?= ROOT ?>assets/js/add-item.js"></script>
</body>

</html>