<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Campus Canteen - Details | College Admin</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/base.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <script>
        const ROOT = "<?= ROOT ?>";
        const canteenId = "<?= $canteen_id ?>";
    </script>
    <style>
        /* Canteen Details Specific Styles */
        .details-header {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .details-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        }

        .header-content {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2rem;
            align-items: start;
        }

        .canteen-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .canteen-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .canteen-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .header-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: end;
        }

        .action-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 150px;
            justify-content: center;
        }

        .edit-btn {
            background: var(--warning-color);
            color: white;
        }

        .edit-btn:hover {
            background: #d68910;
            transform: translateY(-2px);
        }

        .back-btn {
            background: var(--secondary-color);
            color: white;
        }

        .back-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .details-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .info-grid {
            display: grid;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f8fafc;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .info-value {
            color: #64748b;
            font-weight: 500;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
        }

        .stat-card.orders::before {
            background: var(--secondary-color);
        }

        .stat-card.revenue::before {
            background: var(--success-color);
        }

        .stat-card.items::before {
            background: var(--warning-color);
        }

        .stat-card.rating::before {
            background: #8b5cf6;
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0.3rem 0 0 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .tabs-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .tabs-header {
            display: flex;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .tab-btn {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            background: transparent;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }

        .tab-btn.active {
            color: var(--secondary-color);
            border-bottom-color: var(--secondary-color);
            background: white;
        }

        .tab-btn:hover {
            color: var(--secondary-color);
            background: rgba(52, 152, 219, 0.05);
        }

        .tab-content {
            padding: 2rem;
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .menu-item {
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 1rem;
            transition: var(--transition);
        }

        .menu-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .menu-item-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.5rem;
        }

        .menu-item-name {
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .menu-item-price {
            font-weight: 700;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        .menu-item-desc {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        .menu-item-category {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            background: #f1f5f9;
            color: #475569;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .category-section {
            margin-bottom: 3rem;
        }

        .category-section:last-child {
            margin-bottom: 0;
        }

        .category-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 1.5rem 0;
            padding: 1rem 0;
            border-bottom: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .orders-table th {
            background: #f8fafc;
            color: var(--primary-color);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .orders-table tr:hover {
            background: #f8fafc;
        }

        .order-status {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Analytics Tab Styles */
        .analytics-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .analytics-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .time-period-selector {
            display: flex;
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 0.3rem;
            gap: 0.2rem;
        }

        .period-btn {
            padding: 0.6rem 1.2rem;
            border: none;
            background: transparent;
            color: #64748b;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .period-btn.active {
            background: var(--secondary-color);
            color: white;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .period-btn:hover:not(.active) {
            background: #e2e8f0;
            color: var(--primary-color);
        }

        .analytics-stats-grid {
            margin-bottom: 2rem;
        }

        .analytics-period {
            display: none;
        }

        .analytics-period.active {
            display: block;
        }

        .stat-change {
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .stat-change.positive {
            color: var(--success-color);
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        .summary-stats {
            background: #f8fafc;
            border-radius: var(--border-radius);
            padding: 2rem;
            border: 1px solid #e2e8f0;
        }

        .summary-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0 0 1.5rem 0;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .summary-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .summary-value {
            font-weight: 600;
            color: #64748b;
        }

        @media (max-width: 1200px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .header-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .header-actions {
                align-items: stretch;
            }

            .canteen-title {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .tabs-header {
                flex-direction: column;
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
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "canteens";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">


            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card orders">
                    <div class="stat-icon">📋</div>
                    <h3 class="stat-value">156</h3>
                    <p class="stat-label">Orders Today</p>
                </div>
                <div class="stat-card revenue">
                    <div class="stat-icon">💰</div>
                    <h3 class="stat-value">₹12,450</h3>
                    <p class="stat-label">Today's Revenue</p>
                </div>
                <div class="stat-card items">
                    <div class="stat-icon">🍽️</div>
                    <h3 class="stat-value"><?= $total_menu_items ?></h3>
                    <p class="stat-label">Menu Items</p>
                </div>

            </div>

            <!-- Details Grid -->
            <div class="details-grid">
                <!-- Canteen Information -->
                <div class="details-section">
                    <h2 class="section-title">
                        ℹ️ Canteen Information
                    </h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">🏢 Canteen Name</span>
                            <span class="info-value"><?= $canteen->canteen_name ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📍 Location</span>
                            <span class="info-value">Main Campus Building, Ground Floor</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🕒 Operating Hours</span>
                            <span class="info-value"><?= convertTime($canteen->open) ?>- <?= convertTime($canteen->close) ?></span>
                        </div>
                        <!-- <div class="info-item">
                            <span class="info-label">👥 Seating Capacity</span>
                            <span class="info-value">120 seats</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📅 Established</span>
                            <span class="info-value">January 2020</span>
                        </div> -->
                        <div class="info-item">
                            <span class="info-label">🔄 Status</span>
                            <span class="info-value"><?= ucfirst($canteen->status) ?></span>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Tabs Section -->
            <div class="tabs-container full-width">
                <div class="tabs-header">
                    <button class="tab-btn active" data-tab="menu">🍽️ Menu Items</button>
                    <button class="tab-btn" data-tab="orders">📋 Recent Orders</button>
                    <button class="tab-btn" data-tab="analytics">📊 Analytics</button>
                </div>

                <!-- Menu Tab -->
                <div class="tab-content active" id="menu">
                    <?php if (!empty($categories) || isset($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <div class="category-section">
                                <h3 class="category-title"><?= ucfirst($cat->name) ?></h3>
                                <div class="menu-grid">
                                    <?php if (!empty($cat->items)):  ?>
                                        <?php foreach ($cat->items as $item): ?>
                                            <div class="menu-item">
                                                <div class="menu-item-header">
                                                    <h4 class="menu-item-name"><?= ucfirst($item->name) ?></h4>
                                                    <span class="menu-item-price">₹<?= ucfirst($item->price) ?></span>
                                                </div>
                                                <p class="menu-item-desc"><?= $item->description ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <h2>No Items</h2>
                                    <?php endif; ?>


                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>



                </div>

                <!-- Orders Tab -->
                <div class="tab-content" id="orders">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Student</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($orders)): ?>
                                <?php foreach ($orders as $or): ?>
                                    <tr>
                                        <td><strong>#ORD<?= $or->id ?></strong></td>
                                        <td><?= ucfirst($or->student->student_name) ?></td>
                                        <td><?= $or->items ?></td>
                                        <td><strong>₹<?= $or->total ?></strong></td>
                                        <td><span class="order-status status-completed">Completed</span></td>
                                        <td><?= timeAgoOrDate($or->time) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </tbody>
                    </table>
                </div>

                <!-- Analytics Tab -->
                <div class="tab-content" id="analytics">
                    <!-- Time Period Selector -->
                    <div class="analytics-header">
                        <h3 class="analytics-title">� Rievenue & Orders Analytics</h3>
                        <div class="time-period-selector">
                            <button class="period-btn active" data-period="today">Today</button>
                            <button class="period-btn" data-period="week">This Week</button>
                            <button class="period-btn" data-period="month">This Month</button>
                            <button class="period-btn" data-period="year">This Year</button>
                        </div>
                    </div>

                    <!-- Analytics Stats Grid -->
                    <div class="analytics-stats-grid">
                        <!-- Today's Stats (Default) -->
                        <div class="analytics-period" id="today-stats">
                            <div class="stats-grid">
                                <div class="stat-card orders">
                                    <div class="stat-icon">📋</div>
                                    <h3 class="stat-value">156</h3>
                                    <p class="stat-label">Orders Today</p>

                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹12,450</h3>
                                    <p class="stat-label">Revenue Today</p>

                                </div>
                            </div>
                        </div>

                        <!-- This Week's Stats -->
                        <div class="analytics-period" id="week-stats" style="display: none;">
                            <div class="stats-grid">
                                <div class="stat-card orders">
                                    <div class="stat-icon">📋</div>
                                    <h3 class="stat-value">892</h3>
                                    <p class="stat-label">Orders This Week</p>

                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹78,340</h3>
                                    <p class="stat-label">Revenue This Week</p>

                                </div>
                            </div>
                        </div>

                        <!-- This Month's Stats -->
                        <div class="analytics-period" id="month-stats" style="display: none;">
                            <div class="stats-grid">
                                <div class="stat-card orders">
                                    <div class="stat-icon">📋</div>
                                    <h3 class="stat-value">3,245</h3>
                                    <p class="stat-label">Orders This Month</p>

                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹2,85,680</h3>
                                    <p class="stat-label">Revenue This Month</p>

                                </div>
                            </div>
                        </div>

                        <!-- This Year's Stats -->
                        <div class="analytics-period" id="year-stats" style="display: none;">
                            <div class="stats-grid">
                                <div class="stat-card orders">
                                    <div class="stat-icon">📋</div>
                                    <h3 class="stat-value">28,567</h3>
                                    <p class="stat-label">Orders This Year</p>

                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹24,56,890</h3>
                                    <p class="stat-label">Revenue This Year</p>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>assets/js/functions.js">

    </script>
    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');

                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button and corresponding content
                    this.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Analytics time period selector functionality
            const periodButtons = document.querySelectorAll('.period-btn');
            const analyticsPeriods = document.querySelectorAll('.analytics-period');

            // Set default active period (today)
            document.getElementById('today-stats').style.display = 'block';

            periodButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetPeriod = this.getAttribute('data-period');

                    // Remove active class from all period buttons
                    periodButtons.forEach(btn => btn.classList.remove('active'));

                    // Hide all analytics periods
                    analyticsPeriods.forEach(period => {
                        period.style.display = 'none';
                    });

                    // Add active class to clicked button and show corresponding period
                    this.classList.add('active');
                    const targetElement = document.getElementById(targetPeriod + '-stats');
                    if (targetElement) {
                        targetElement.style.display = 'block';
                    }




                });
            });

            // Edit button functionality
            const editBtn = document.querySelector('.edit-btn');
            if (editBtn) {
                editBtn.addEventListener('click', function() {
                    console.log('Edit canteen clicked');
                    // Add edit functionality here
                });
            }
        });







        const todayStats = document.getElementById('today-stats');
        const weekStats = document.getElementById('week-stats');
        const monthStats = document.getElementById('month-stats');
        const yearStats = document.getElementById('year-stats');

        let where = {
            canteen_id: canteenId
        }

        let units = {
            DAY: TODAY,
            MONTH: MONTH,
            YEAR: YEAR
        }
        setAnalytics(units, where).then(data => {
            todayStats.querySelector('.stat-card.orders .stat-value').textContent = data.orders[0].total_orders;
            todayStats.querySelector('.stat-card.revenue .stat-value').textContent = '₹' + (data.orders[0].total ?? 0);
        })

        units = {

            WEEK: WEEK
        }

        setAnalytics(units, where).then(data => {
            weekStats.querySelector('.stat-card.orders .stat-value').textContent = data.orders[0].total_orders;
            weekStats.querySelector('.stat-card.revenue .stat-value').textContent = '₹' + (data.orders[0].total ?? 0);
        })

        units = {

            MONTH: MONTH,
            YEAR: YEAR
        }

        setAnalytics(units, where).then(data => {
            monthStats.querySelector('.stat-card.orders .stat-value').textContent = data.orders[0].total_orders;
            monthStats.querySelector('.stat-card.revenue .stat-value').textContent = '₹' + (data.orders[0].total ?? 0);
        })

        units = {


            YEAR: YEAR
        }

        setAnalytics(units, where).then(data => {
            yearStats.querySelector('.stat-card.orders .stat-value').textContent = data.orders[0].total_orders;
            yearStats.querySelector('.stat-card.revenue .stat-value').textContent = '₹' + (data.orders[0].total ?? 0);
        })


        let statsGrid = document.querySelector('.stats-grid');

        units = {
            DAY: TODAY,
            MONTH: MONTH,
            YEAR: YEAR
        };

        setAnalytics(units, where).then(data => {
            statsGrid.querySelector('.stat-card.orders .stat-value').textContent = data.orders[0].total_orders;
            statsGrid.querySelector('.stat-card.revenue .stat-value').textContent = '₹' + (data.orders[0].total ?? 0);
        })
    </script>
</body>

</html>