<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteens Management - College Admin</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/base.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/admin-canteen.css">
    <script>
        const ROOT = '<?= ROOT ?>';
    </script>
    <style>

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
            <!-- Header Section -->
            <div class="canteens-header">
                <div>
                    <h1 class="canteens-title">
                        🍽️ Canteens Management
                    </h1>
                    <div class="canteens-stats">
                        <div class="stat-item">
                            <p id="total-canteens-stat" class="stat-value">8</p>
                            <p class="stat-label">Total Canteens</p>
                        </div>
                        <div class="stat-item">
                            <p id="total-canteens-active-stat" class="stat-value">7</p>
                            <p class="stat-label">Active</p>
                        </div>
                        <div class="stat-item">
                            <p id="total-canteens-revenue-stat" class="stat-value">₹45,280</p>
                            <p class="stat-label">Today's Revenue</p>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Canteens Grid -->
            <div class="canteens-grid">
                <?php if (empty($canteens)): ?>
                    <p>No canteens found. Please add a new canteen.</p>
                <?php else: ?>
                    <?php foreach ($canteens as $canteen): ?>
                        <div class="canteen-card">
                            <div class="canteen-status status-active">Active</div>
                            <div class="canteen-header">
                                <h3 class="canteen-name">
                                    🏢 Main Campus Canteen
                                </h3>
                                <p class="canteen-location">
                                    📍 Main Campus Building, Ground Floor
                                </p>
                            </div>
                            <div class="canteen-stats-grid">
                                <div class="canteen-stat">
                                    <p class="canteen-stat-value">156</p>
                                    <p class="canteen-stat-label">Orders Today</p>
                                </div>
                                <div class="canteen-stat">
                                    <p class="canteen-stat-value"><?= $canteen->total_menu_items ?></p>
                                    <p class="canteen-stat-label">Menu Items</p>
                                </div>
                            </div>
                            <div class="canteen-actions">
                                <div class="canteen-revenue">₹12,450 Today</div>
                                <div class="action-buttons">
                                    <a href="<?= ROOT ?>admin/canteenDetails/<?= $canteen->id ?>" class="action-btn view-btn">👁️ View</a>

                                    <button class="action-btn delete-btn">🗑️ Block</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>assets/js/functions.js"></script>
    <script>
        setTotalCanteens();
        setTotalRevenue();
        setTotalActiveCanteens();

        function setTotalRevenue() {
            let canteenTotalStat = document.getElementById('total-canteens-revenue-stat');

            let url = ROOT + 'CollegeController/totalRevenue';

            console.log(TODAY, MONTH, YEAR);
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        units: {
                            DAY: TODAY,
                            MONTH: MONTH,
                            YEAR: YEAR
                        }
                    })
                })
                .then(res => res.text())
                .then(data => {
                    data = JSON.parse(data);

                    canteenTotalStat.innerText = '₹' + data.total_revenue;
                })
        }

        function setTotalCanteens() {

            let url = ROOT + 'CanteenController/totalCanteens';
            fetch(url)
                .then(res => res.text())
                .then(data => {
                    data = JSON.parse(data);
                    let canteenTotalStat = document.getElementById('total-canteens-stat');
                    canteenTotalStat.innerText = data.count;
                })
        }

        function setTotalActiveCanteens() {

            let url = ROOT + 'CanteenController/totalCanteens/active';
            fetch(url)
                .then(res => res.text())
                .then(data => {
                    data = JSON.parse(data);
                    console.log(data);
                    let canteenTotalActiveStat = document.getElementById('total-canteens-active-stat');
                    canteenTotalActiveStat.innerText = data.count;
                })
        }
    </script>
</body>

</html>