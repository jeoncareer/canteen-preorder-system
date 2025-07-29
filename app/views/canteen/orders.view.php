<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders Management - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/orders.css">
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>

</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "orders";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Orders Header -->
            <div class="orders-header">
                <h1 class="orders-title">
                    📋 Orders Management
                </h1>
                <div class="orders-actions">
                    <a href="#" class="export-btn">
                        📊 Export CSV
                    </a>
                    <button class="refresh-btn">
                        🔄 Refresh
                    </button>
                </div>
            </div>

            <!-- Orders Tabs -->
            <div class="orders-tabs">
                <button class="tab-btn active" data-tab="active-orders">
                    🔄 Active Orders
                </button>
                <!-- <button class="tab-btn" data-tab="order-history">
                    📊 Order History
                </button> -->
            </div>

            <!-- Active Orders Tab Content -->
            <div id="active-orders" class="tab-content active">
                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-summary-card stat-pending">
                        <div class="stat-summary-value">23</div>
                        <div class="stat-summary-label">Pending Orders</div>
                    </div>
                    <div class="stat-summary-card stat-accepted">
                        <div class="stat-summary-value">15</div>
                        <div class="stat-summary-label">Accepted Orders</div>
                    </div>
                    <div class="stat-summary-card stat-ready">
                        <div class="stat-summary-value">8</div>
                        <div class="stat-summary-label">Ready Orders</div>
                    </div>
                    <div class="stat-summary-card stat-completed">
                        <div class="stat-summary-value">142</div>
                        <div class="stat-summary-label">Completed Today</div>
                    </div>
                    <div class="stat-summary-card stat-rejected">
                        <div class="stat-summary-value">3</div>
                        <div class="stat-summary-label">Rejected Orders</div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="filters-section">
                    <div class="filters-grid">
                        <div class="form-group">
                            <label class="form-label">Search Orders</label>
                            <input data-type="search" type="text" class="form-input" placeholder="Search by order ID, student name, or email..." id="searchInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Filter</label>
                            <select data-type="status" class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="ready">Ready</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">From Date</label>
                            <input data-type="fromDate" type="date" class="form-input" id="fromDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">To Date</label>
                            <input data-type="toDate" type="date" class="form-input" id="toDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select data-type="sort" class="form-select" id="sortBy">
                                <option value="desc">Newest First</option>
                                <option value="asc">Oldest First</option>
                                <option value="total">Amount (High to Low)</option>

                            </select>
                        </div>
                    </div>
                </div>

                <!-- Bulk Actions -->
                <div class="bulk-actions">
                    <div class="bulk-actions-left">
                        <label class="bulk-select-all">
                            <input type="checkbox" id="selectAll"> Select All Visible
                        </label>
                        <span id="selectedCount">0 selected</span>
                    </div>
                    <div class="bulk-actions-buttons">
                        <button data-type="accepted" class="bulk-btn bulk-accept">✅ Accept Selected</button>
                        <button data-type="ready" class="bulk-btn bulk-complete">🍽️ Mark Ready</button>
                        <button data-type="rejected" class="bulk-btn bulk-reject">❌ Reject Selected</button>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="order-checkbox" id="selectAllHeader">
                                </th>
                                <th>Order ID</th>
                                <th>Student</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Time</th>
                                <th>Status</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Orders - Replace with PHP loop -->


                            <?php foreach ($orders as $order_id => $items): ?>

                                <tr>
                                    <td>
                                        <input type="checkbox" class="order-checkbox" data-order-id="<?= $order_id ?>">
                                    </td>
                                    <td><span class="order-id">#<?= $order_id ?></span></td>
                                    <td>
                                        <div class="student-info">
                                            <span class="student-name"><?= $items[0]->email ?></span>
                                            <span class="student-email"><?= $items[0]->email ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="order-items-list">
                                            <?php foreach ($items as $item): ?>
                                                <div class="order-item">
                                                    <span class="item-name"><?= ucfirst($item->name) ?></span>
                                                    <span class="item-quantity">x<?= $item->quantity ?></span>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </td>
                                    <td><span class="order-total">₹1<?= $items[0]->total ?></span></td>
                                    <td>
                                        <div class="order-time-info">
                                            <span class="order-time">11:30 AM</span>
                                            <span class="order-date">Today</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select data-id='<?= $order_id ?>' class="status-select <?= $items[0]->status ?>">
                                            <option value="pending" <?php if ($items[0]->status == 'pending') {
                                                                        echo 'selected';
                                                                    } ?>>Pending</option>
                                            <option value="accepted" <?php if ($items[0]->status == 'accepted') {
                                                                            echo 'selected';
                                                                        } ?>>Accepted</option>
                                            <option value="completed" <?php if ($items[0]->status == 'completed') {
                                                                            echo 'selected';
                                                                        } ?>>Completed</option>
                                            <option value="ready" <?php if ($items[0]->status == 'ready') {
                                                                        echo 'selected';
                                                                    } ?>>Ready</option>
                                            <option value="rejected" <?php if ($items[0]->status == 'rejected') {
                                                                            echo 'selected';
                                                                        } ?>>Rejected</option>
                                        </select>
                                    </td>
                                    <!-- <td>
                                        <div class="order-actions">
                                            <button class="order-action-btn view-details-btn">👁️ Details</button>
                                        </div>
                                    </td> -->
                                </tr>

                            <?php endforeach; ?>






                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="pagination-info">
                            Showing 1-6 of 47 orders
                        </div>
                        <div class="pagination-controls">
                            <button class="pagination-btn" disabled>← Previous</button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <button class="pagination-btn">4</button>
                            <button class="pagination-btn">Next →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order History Tab Content -->

    </div>
    <script src="<?= ROOT ?>assets/js/canteen-dashboard.js"></script>

    <script>
        let orders = <?= json_encode($orders) ?>;
        console.log(orders);
        let checkboxs = document.querySelectorAll('.order-checkbox[data-order-id]');
        checkboxs.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let orderId = checkbox.dataset.orderId;
                console.log("clicked checkbox with id " + orderId);
            })
        })


        let allCheckbox = document.getElementById('selectAllHeader');

        allCheckbox.addEventListener('change', function() {
            checkboxs.forEach(checkbox => {
                checkbox.checked = allCheckbox.checked;
                let orderId = checkbox.dataset.orderId;
                console.log(" checkbox: " + orderId);
            })
        })

        let bulkBtns = document.querySelectorAll('.bulk-btn');

        bulkBtns.forEach(bulkBtn => {
            bulkBtn.addEventListener('click', function() {
                let newStatus = bulkBtn.dataset.type;
                checkboxs.forEach(checkbox => {
                    if (checkbox.checked) {


                        let orderId = checkbox.dataset.orderId;
                        console.log("changing " + orderId);
                        const url = ROOT + 'api/changeStatus';
                        fetch(url, {
                                method: "POST",
                                headers: {
                                    "Content-type": "application/json"
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    new_status: newStatus
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    let select = document.querySelector(`.status-select[data-id="${orderId}"]`);
                                    console.log(select);
                                    select.classList.remove('pending', 'accepted', 'completed', 'rejected', 'ready');
                                    select.classList.add(newStatus);
                                    select.value = newStatus;
                                    console.log("Status updated successfully");

                                }
                            });
                    }
                })
            })
        })


        const selects = document.querySelectorAll('.form-select,.form-input');
        selects.forEach(select => {
            select.addEventListener('change', function() {

                let filter = [];
                selects.forEach(select => {
                    filter.push({
                        type: select.dataset.type,
                        value: select.value
                    })
                })

                const url = ROOT + "api/getOrdersByFilter";

                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            filter: filter
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log("after backend calling");
                            console.log(data);
                        }
                    });


            })
        })
    </script>
</body>

</html>