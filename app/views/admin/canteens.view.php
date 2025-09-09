<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteens Management - College Admin</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/add-item.css">
    <script>
        const ROOT = '<?= ROOT ?>';
    </script>
    <style>
        /* Main content with sidebar layout */
        .main-content {
            flex: 1;
            padding: 2rem;
            background: #f8fafc;
            overflow-y: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        .add-canteen-btn {
            background: var(--primary-color);
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
        }

        .add-canteen-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .canteens-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .canteen-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .canteen-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .canteen-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .canteen-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background: rgba(39, 174, 96, 0.2);
            color: #27ae60;
            border: 1px solid #27ae60;
        }

        .status-inactive {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        .canteen-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .canteen-location {
            opacity: 0.9;
            font-size: 0.875rem;
        }

        .canteen-body {
            padding: 1.5rem;
        }

        .canteen-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            text-align: center;
        }

        .info-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .canteen-contact {
            background: var(--gray-50);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            width: 16px;
            text-align: center;
        }

        .canteen-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            flex: 1;
            padding: 0.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-view {
            background: var(--primary-color);
            color: white;
        }

        .btn-view:hover {
            background: var(--primary-hover);
        }

        .btn-edit {
            background: var(--warning-color);
            color: white;
        }

        .btn-edit:hover {
            background: #e67e22;
        }

        .btn-toggle {
            background: var(--success-color);
            color: white;
        }

        .btn-toggle:hover {
            background: #229954;
        }

        .btn-toggle.inactive {
            background: var(--danger-color);
        }

        .btn-toggle.inactive:hover {
            background: #c0392b;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-500);
        }

        .close-btn:hover {
            color: var(--gray-800);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group-full {
            grid-column: 1 / -1;
        }

        .success-message {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .canteens-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .canteen-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php
        $page = "canteens";
        require 'sidebar.view.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">🍽️ Canteens Management</h1>

            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">🏪</div>
                    <div class="stat-number"><?= $canteens_count ?></div>
                    <div class="stat-label">Total Canteens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-number" id="stat-canteen-count">6</div>
                    <div class="stat-label">Active Canteens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📋</div>
                    <div class="stat-number" id="total-orders">142</div>
                    <div class="stat-label">Total Orders Today</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">💰</div>
                    <div class="stat-number" id="total-revenue">₹28,450</div>
                    <div class="stat-label">Revenue Today</div>
                </div>
            </div>

            <!-- Canteens Grid -->
            <div class="canteens-grid">
                <!-- Canteen 1 -->

                <?php foreach ($canteens as $canteen): ?>
                    <div data-canteen-id="<?= $canteen->id ?>" class="canteen-card">
                        <div class="canteen-header">
                            <div class="canteen-status status-<?= $canteen->status ?>"><?= $canteen->status ?></div>
                            <div class="canteen-name">Main Campus Canteen</div>
                            <div class="canteen-location">📍 Ground Floor, Main Building</div>
                        </div>
                        <div class="canteen-body">
                            <div class="canteen-info">
                                <div class="info-item">
                                    <div class="total-menu-items info-number">45</div>
                                    <div class="info-label">Menu Items</div>
                                </div>
                                <div class="info-item">
                                    <div class="total-orders info-number">23</div>
                                    <div class="info-label">Orders Today</div>
                                </div>
                            </div>
                            <div class="canteen-contact">
                                <div class="contact-item">
                                    <span class="contact-icon">📧</span>
                                    <span><?= $canteen->email ?></span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-icon">📱</span>
                                    <span><?= $canteen->phn_no ?></span>
                                </div>
                                <div class="contact-item">
                                    <span class="contact-icon">👤</span>
                                    <span>Manager: <?= $canteen->manager_name ?></span>
                                </div>
                            </div>
                            <div class="canteen-actions">
                                <button data-canteen-id="<?= $canteen->id ?>" class="action-btn btn-view canteen-view-details"> View</button>
                                <button class="action-btn btn-edit">Edit</button>
                                <button class="action-btn btn-toggle">Disable</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>





    <script>
        const statCanteenCount = document.getElementById('stat-canteen-count');

        fetchTotalCanteensByCollege('active');

        function fetchTotalCanteensByCollege(status) {

            let url = ROOT + 'CanteenController/CanteenCountByStatus/' + status;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    let count = '';
                    if (data.success) {
                        count = data.count;
                    } else {
                        count = 'unavailable';
                    }

                    statCanteenCount.textContent = count;
                })
        }

        let data = {
            college_id: 11
        }

        let units = {
            YEAR: 2025,
            MONTH: 9
        }


        fetchOrderByDateCollege(data, units);

        function fetchOrderByDateCollege(data, units) {
            let url = ROOT + 'OrdersController/ordersByDateCollege';
            let totalOrders = document.getElementById('total-orders');
            let totalRevenue = document.getElementById('total-revenue');

            fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json"
                    },
                    body: JSON.stringify({
                        data: data,
                        units: units
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const results = data.results[0];
                        result = {
                            count: results.total_orders,
                            revenue: results.total
                        }

                        totalOrders.textContent = result.count;
                        totalRevenue.textContent = '₹' + result.revenue;




                    }
                })
        }
        settingRealValuesForCanteenCards();

        function settingRealValuesForCanteenCards() {

            let canteenCards = document.querySelectorAll('.canteen-card');

            canteenCards.forEach(card => {

                setTotalMenuItems(card);
                setTotalOrders(card, 'YEAR');


            })
        }

        function setTotalMenuItems(card) {
            let canteenId = card.dataset.canteenId;
            let totalMenuItemsCard = card.querySelector('.total-menu-items');


            const MenuUrl = ROOT + 'CanteenController/totalMenuItems/' + canteenId;
            console.log(MenuUrl);
            fetch(MenuUrl)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        totalMenuItemsCard.textContent = data.count;
                    }
                })
        }

        function setTotalOrders(card, date) {
            let canteenId = card.dataset.canteenId;
            let totalOrdersCard = card.querySelector('.total-orders');
            const orderUrl = ROOT + 'CanteenController/totalOrdersByCanteen/' + canteenId + '/' + date;
            fetch(orderUrl)
                .then(res => res.json())
                .then(data => {
                    let count = data.results[0].count;
                    totalOrdersCard.textContent = count;
                })
        }

        redirectCanteenViewDetails();

        function redirectCanteenViewDetails() {
            let btns = document.querySelectorAll('.canteen-view-details');

            btns.forEach(btn => {
                btn.addEventListener('click', e => {
                    canteenId = btn.dataset.canteenId;
                    window.location.href = ROOT + 'admin/canteenDetails/' + canteenId;
                })
            })
        }
    </script>
</body>

</html>