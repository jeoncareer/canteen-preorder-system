<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Details - College Admin</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <script>
        const canteenId = <?= $canteen->id ?>;
        const ROOT = '<?= ROOT ?>';
    </script>
    <style>
        /* Main content without sidebar */
        .main-content {
            width: 100%;
            padding: 2rem;
            background: #f8fafc;
            min-height: calc(100vh - 80px);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .back-button {
            background: var(--gray-600);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .back-button:hover {
            background: var(--gray-700);
            transform: translateY(-1px);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        /* Canteen Header Info */
        .canteen-header-info {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }



        .canteen-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
        }

        .canteen-basic-info h1 {
            font-size: 2.5rem;
            margin: 0 0 0.5rem 0;
        }

        .canteen-location {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .canteen-description {
            opacity: 0.8;
            line-height: 1.5;
        }

        .quick-stats {
            display: flex;
            gap: 2rem;
        }

        .quick-stat {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 8px;
            min-width: 100px;
        }

        .quick-stat .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .quick-stat .stat-label {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        /* Tabs Navigation */
        .tabs-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .tabs-nav {
            display: flex;
            border-bottom: 2px solid var(--gray-200);
        }

        .tab-button {
            background: none;
            border: none;
            padding: 1rem 2rem;
            cursor: pointer;
            font-weight: 500;
            color: var(--gray-600);
            border-bottom: 3px solid transparent;
            transition: var(--transition);
            flex: 1;
            text-align: center;
        }

        .tab-button:hover {
            color: var(--primary-color);
            background: var(--gray-50);
        }

        .tab-button.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background: var(--gray-50);
        }

        .tab-content {
            padding: 2rem;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        /* Overview Tab Styles */
        .overview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .info-section {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .info-section h3 {
            margin: 0 0 1rem 0;
            color: var(--gray-800);
            font-size: 1.25rem;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .info-label {
            font-weight: 500;
            color: var(--gray-600);
        }

        .info-value {
            font-weight: 600;
            color: var(--gray-800);
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .metric-card {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .metric-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .metric-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .facility-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.75rem;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: white;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        /* Menu Tab Styles */
        .menu-categories {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .menu-category {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gray-200);
        }

        .category-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        .category-count {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .menu-items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .menu-item-card {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .menu-item-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .menu-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .item-name {
            font-weight: 600;
            color: var(--gray-800);
        }

        .item-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .item-description {
            color: var(--gray-600);
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-available {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .status-unavailable {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        /* Orders Tab Styles */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .orders-stats {
            display: flex;
            gap: 2rem;
        }

        .order-stat {
            text-align: center;
        }

        .order-stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .order-stat-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .order-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .order-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .order-id {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .order-time {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .order-status {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-preparing {
            background: rgba(52, 152, 219, 0.1);
            /* soft blue background */
            color: var(--info-color);
            /* use your info variable */
        }


        .status-available {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .status-pending {
            background: rgba(241, 196, 15, 0.1);
            /* soft yellow background */
            color: var(--warning-color);
            /* use your warning variable */
        }


        .status-unavailable {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .status-ready {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .status-completed {
            background: rgba(103, 126, 234, 0.1);
            color: var(--primary-color);
        }

        .status-cancelled {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .order-details {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            align-items: center;
        }

        .order-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .order-customer {
            font-weight: 500;
            color: var(--gray-800);
        }

        .order-items {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .order-total {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        /* Analytics Tab Styles */
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .analytics-section {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .analytics-section h3 {
            margin: 0 0 1rem 0;
            color: var(--gray-800);
            font-size: 1.25rem;
        }

        .performance-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .performance-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            background: white;
            border-radius: 6px;
        }

        .performance-label {
            color: var(--gray-600);
        }

        .performance-value {
            font-weight: 600;
            color: var(--primary-color);
        }

        .top-items-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .top-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 6px;
        }

        .item-rank {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
            min-width: 30px;
        }

        .item-info {
            flex: 1;
        }

        .item-sales {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .weekly-chart {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 0.5rem;
            height: 150px;
            padding: 1rem 0;
        }

        .chart-bar {
            flex: 1;
            background: var(--primary-color);
            border-radius: 4px 4px 0 0;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: center;
        }

        .bar-value {
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem;
        }

        .bar-label {
            position: absolute;
            bottom: -25px;
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid var(--gray-200);
        }

        .action-btn {
            flex: 1;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-edit {
            background: var(--primary-color);
            color: white;
        }

        .btn-edit:hover {
            background: var(--primary-hover);
        }

        .btn-menu {
            background: var(--success-color);
            color: white;
        }

        .btn-menu:hover {
            background: #229954;
        }

        .btn-orders {
            background: var(--warning-color);
            color: white;
        }

        .btn-orders:hover {
            background: #e67e22;
        }

        .btn-toggle {
            background: var(--danger-color);
            color: white;
        }

        .btn-toggle:hover {
            background: #c0392b;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .canteen-header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .quick-stats {
                justify-content: space-around;
            }

            .tabs-nav {
                flex-wrap: wrap;
            }

            .tab-button {
                flex: 1;
                min-width: 120px;
            }

            .overview-grid,
            .analytics-grid {
                grid-template-columns: 1fr;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .menu-items-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .orders-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .order-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    $page = "canteens";
    require 'header.view.php';
    ?>

    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <a href="<?= ROOT ?>admin/canteens" class="back-button">
                ← Back to Canteens
            </a>
            <h1 class="page-title">Canteen Details</h1>
        </div>

        <!-- Canteen Header Info -->
        <div class="canteen-header-info">
            <div class="canteen-header-content">
                <div class="canteen-basic-info">
                    <h1>Main Campus Canteen</h1>
                    <div class="canteen-location">📍 Ground Floor, Main Building</div>
                    <div class="canteen-description">
                        The main canteen serving the entire campus with a wide variety of delicious and affordable meals.
                        Popular among students and staff for its quality food and quick service.
                    </div>
                </div>
                <div class="quick-stats">
                    <div class="quick-stat">
                        <div class="stat-number">45</div>
                        <div class="stat-label">Menu Items</div>
                    </div>
                    <div class="quick-stat">
                        <div class="stat-number">23</div>
                        <div class="stat-label">Orders Today</div>
                    </div>
                    <div class="quick-stat">
                        <div class="stat-number">₹8,450</div>
                        <div class="stat-label">Revenue Today</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Container -->
        <div class="tabs-container">
            <!-- Tabs Navigation -->
            <div class="tabs-nav">
                <button class="tab-button active" onclick="showTab('overview')">📋 Overview</button>
                <button class="tab-button" onclick="showTab('menu')">🍽️ Menu</button>
                <button class="tab-button" onclick="showTab('orders')">📦 Recent Orders</button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Overview Tab -->
                <div id="overview" class="tab-pane active">
                    <div class="overview-grid">
                        <!-- Manager Information -->
                        <div class="info-section">
                            <h3>👤 Canteen Information</h3>
                            <div class="info-list">
                                <div class="info-item">
                                    <span class="info-label">Name:</span>
                                    <span class="info-value"><?= $canteen->manager_name ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email:</span>
                                    <span class="info-value"><?= $canteen->email ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Phone:</span>
                                    <span class="info-value"><?= $canteen->phn_no ?></span>
                                </div>

                                <div class="info-item">
                                    <span class="info-label">Joined:</span>
                                    <span class="info-value">January 2019</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Tab -->
                <div id="menu" class="tab-pane">
                    <div class="menu-categories">
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $row): ?>
                                <div class="menu-category">
                                    <div class="category-header">
                                        <h3 class="category-title"><?= $row->name ?></h3>
                                        <?php if ($row->items): ?>
                                            <span class="category-count"> <?= count((array)$row->items) ?> items</span>
                                        <?php else: ?>
                                            <span class="category-count"> 0 items</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="menu-items-grid">
                                        <?php if (!empty($row->items)): ?>
                                            <?php foreach ($row->items as $item): ?>
                                                <div class="menu-item-card">
                                                    <div class="menu-item-header">
                                                        <span class="item-name"><?= $item->name ?? 'null' ?></span>
                                                        <span class="item-price">₹<?= $item->price ?></span>
                                                    </div>
                                                    <div class="item-description">
                                                        <?= $item->description ?>
                                                    </div>
                                                    <div class="item-footer">
                                                        <span class="item-status status-available">Available</span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <h2>No items </h2>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Orders Tab -->
                <div id="orders" class="tab-pane">
                    <div class="orders-header">
                        <h3>Recent Orders</h3>
                        <div class="orders-stats">
                            <div class="order-stat">
                                <div data-unit="TODAY" class="order-stat-number ">23</div>
                                <div class="order-stat-label">Today</div>
                            </div>
                            <div class="order-stat">
                                <div data-unit="MONTH" class="order-stat-number ">156</div>
                                <div class="order-stat-label">This Week</div>
                            </div>
                            <div class="order-stat">
                                <div data-unit="YEAR" class="order-stat-number ">642</div>
                                <div class="order-stat-label">This Month</div>
                            </div>
                        </div>
                    </div>

                    <div class="orders-list">
                        <?php if (isset($orders)): ?>
                            <?php foreach ($orders as $row): ?>
                                <div class="order-card">
                                    <div class="order-header">
                                        <span class="order-id">#ORD<?= $row->id ?></span>
                                        <span class="order-time"><?= $row->abstract_time ?></span>
                                        <span class="order-status status-<?= $row->status ?>"><?= $row->status ?></span>
                                    </div>
                                    <div class="order-details">
                                        <div class="order-info">
                                            <div class="order-customer">👤 <?= $row->student->student_name ?> (<?= $row->student->email ?>)</div>
                                            <div class="order-items"><?= $row->items_grouped ?></div>
                                        </div>
                                        <div class="order-total">₹<?= $row->total ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>



                    </div>
                </div>


            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="action-btn btn-edit">✏️ Edit Canteen</button>
                <button class="action-btn btn-menu">🍽️ Manage Menu</button>
                <button class="action-btn btn-orders">📦 View All Orders</button>
                <button class="action-btn btn-toggle">🔄 Toggle Status</button>
            </div>
        </div>
    </div>

    <script>
        console.log(canteenId);
        // Tab switching functionality
        function showTab(tabName) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab pane
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked tab button
            event.target.classList.add('active');
        }


        let orderStatNumber = document.querySelectorAll('.order-stat-number');

        orderStatNumber.forEach(stat => {
            let unit = stat.dataset.unit;
            let url = ROOT + 'CanteenController/totalOrdersByCanteen/' + canteenId + '/' + unit;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let results = data.results;
                    console.log(results);
                    let count = results[0].count;
                    stat.textContent = count;
                })
        })
    </script>
</body>

</html>