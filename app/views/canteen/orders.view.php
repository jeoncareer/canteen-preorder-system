<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders Management - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/canteen-common.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/orders.css">
    <script>
        const ROOT = "<?= ROOT ?>";
        const CANTEEN_ID = <?= CANTEEN_ID ?>
    </script>
</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php
        $page = "orders";
        require 'sidebar.view.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Orders Header -->
            <div class="orders-header">
                <h1 class="orders-title">
                    📋 Orders Management
                </h1>
                <div class="orders-actions">
                    <button class="export-btn">
                        📊 Export CSV
                    </button>

                </div>
            </div>

            <!-- Orders Tabs -->
            <div class="orders-tabs">
                <button class="tab-btn active" data-tab="active-orders">
                    🔄 Active Orders
                </button>
                <button class="tab-btn" data-tab="order-history">
                    📊 Order History
                </button>
            </div>

            <!-- Active Orders Tab Content -->
            <div id="active-orders" class="tab-content active">
                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-summary-card stat-pending">
                        <div class="stat-summary-value">8</div>
                        <div class="stat-summary-label">Pending Orders</div>
                    </div>
                    <div class="stat-summary-card stat-accepted">
                        <div class="stat-summary-value">12</div>
                        <div class="stat-summary-label">Accepted Orders</div>
                    </div>
                    <div class="stat-summary-card stat-ready">
                        <div class="stat-summary-value">5</div>
                        <div class="stat-summary-label">Ready Orders</div>
                    </div>
                    <div class="stat-summary-card stat-preparing">
                        <div class="stat-summary-value">7</div>
                        <div class="stat-summary-label">Preparing</div>
                    </div>
                </div>

                <!-- Active Orders Table -->
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Student</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Time</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($active_orders as $row): ?>
                                <tr>
                                    <td><span class="order-id">#ORD-<?= $row->id ?></span></td>
                                    <td>
                                        <div class="student-info">
                                            <span class="student-name"><?= ucwords($row->student->student_name) ?></span>
                                            <span class="student-email"><?= $row->student->email ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="order-items-list">
                                            <?php foreach ($row->items as $item): ?>
                                                <div class="order-item">
                                                    <span class="item-name"><?= ucwords($item->item->name) ?></span>
                                                    <span class="item-quantity">x<?= $item->quantity ?></span>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </td>
                                    <td><span class="order-total">₹<?= $row->total ?></span></td>
                                    <td>
                                        <div class="order-time-info">
                                            <span class="order-time"><?= formatTime($row->time) ?></span>
                                            <span class="order-date"><?= formatDate($row->time) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="status-select <?= $row->status ?>" data-order-id="<?= $row->id ?>">
                                            <option value="pending" <?php if ($row->status === 'pending') echo 'selected'; ?>>Pending</option>
                                            <option value="accepted" <?php if ($row->status === 'accepted') echo 'selected'; ?>>Accepted</option>
                                            <option value="preparing" <?php if ($row->status === 'preparing') echo 'selected'; ?>>Preparing</option>
                                            <option value="ready" <?php if ($row->status === 'ready') echo 'selected'; ?>>Ready</option>
                                            <option value="completed" <?php if ($row->status === 'completed') echo 'selected'; ?>>Completed</option>
                                        </select>
                                    </td>

                                </tr>

                            <?php endforeach; ?>






                        </tbody>
                    </table>


                </div>
            </div>

            <!-- Order History Tab Content -->
            <div id="order-history" class="tab-content">
                <!-- History Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-summary-card stat-completed">
                        <div class="stat-summary-value">156</div>
                        <div class="stat-summary-label">Total Completed</div>
                    </div>
                    <div class="stat-summary-card stat-rejected">
                        <div class="stat-summary-value">23</div>
                        <div class="stat-summary-label">Rejected Orders</div>
                    </div>
                    <div class="stat-summary-card stat-revenue">
                        <div class="stat-summary-value">₹28,450</div>
                        <div class="stat-summary-label">Total Revenue</div>
                    </div>
                    <div class="stat-summary-card stat-avg">
                        <div class="stat-summary-value">₹185</div>
                        <div class="stat-summary-label">Average Order</div>
                    </div>
                </div>

                <!-- History Filters Section -->
                <div class="filters-section">
                    <div class="filters-grid">
                        <div class="form-group">
                            <label class="form-label">Search Orders</label>
                            <input type="text" class="form-input" placeholder="Search by order ID, student name..." id="historySearchInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Filter</label>
                            <select class="form-select" id="historyStatusFilter">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date Range</label>
                            <select class="form-select" id="dateRangeFilter">
                                <option value="">All Time</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select class="form-select" id="historySortBy">
                                <option value="date_desc">Newest First</option>
                                <option value="date_asc">Oldest First</option>
                                <option value="amount_desc">Amount (High to Low)</option>
                                <option value="amount_asc">Amount (Low to High)</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- History Orders Table -->
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Student</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Date & Time</th>


                            </tr>
                        </thead>
                        <tbody>
                            <!-- History Order 1 -->
                            <?php foreach ($history_orders as $order): ?>
                                <tr>
                                    <td><span class="order-id">#ORD-<?php echo $order->id; ?></span></td>
                                    <td>
                                        <div class="student-info">
                                            <span class="student-name"><?php echo $order->student->student_name; ?></span>
                                            <span class="student-email"><?php echo $order->student->email; ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="order-items-list">
                                            <?php foreach ($order->items as $item): ?>
                                                <div class="order-item">
                                                    <span class="item-name"><?php echo $item->item->name; ?></span>
                                                    <span class="item-quantity">x<?php echo $item->quantity; ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                </div>
                </td>
                <td><span class="order-total">₹<?php echo $order->total; ?></span></td>
                <td>
                    <div class="order-time-info">
                        <span class="order-date"><?= formatTime($order->time) ?></span>
                        <span class="order-time"><?= formatDate($order->time) ?></span>
                    </div>
                </td>


                </tr>

            <?php endforeach; ?>

            </tbody>
            </table>

            <!-- History Orders Pagination -->
            <div class="pagination">
                <button class="page-btn nav-btn" id="historyPrevBtn">Previous</button>
                <div class="page-numbers-container">
                    <div class="page-numbers" id="historyPageNumbers">
                        <button class="page-btn active" data-page="1">1</button>
                        <button class="page-btn" data-page="2">2</button>
                        <button class="page-btn" data-page="3">3</button>
                        <button class="page-btn" data-page="4">4</button>
                        <button class="page-btn" data-page="5">5</button>
                        <button class="page-btn" data-page="6">6</button>
                        <button class="page-btn" data-page="7">7</button>
                        <button class="page-btn" data-page="8">8</button>
                    </div>
                </div>
                <button class="page-btn nav-btn" id="historyNextBtn">Next</button>
            </div>
            </div>
        </div>
    </div>
    </div>

    <script src="<?= ROOT ?>assets/js/orders.js"></script>

    <script>
        // Assuming ROOT is already defined somewhere in your JS or template


        document.querySelectorAll('.export-btn').forEach(button => {
            button.addEventListener('click', () => {
                window.location.href = ROOT + `OrdersController/exportOrders/${CANTEEN_ID}`;
            });
        });
    </script>

</body>

</html>