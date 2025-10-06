<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>All Orders - Admin Dashboard</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <style>
        /* Welcome Header Styling */
        .welcome-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .welcome-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .welcome-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        /* Statistics Cards */
        .orders-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
        }

        .stat-card.total {
            border-left-color: #4a90e2;
        }

        .stat-card.pending {
            border-left-color: #ffc107;
        }

        .stat-card.completed {
            border-left-color: #28a745;
        }

        .stat-card.cancelled {
            border-left-color: #dc3545;
        }

        .stat-card.revenue {
            border-left-color: #6f42c1;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            text-align: center;
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-color: #4a90e2;
        }

        .action-card-icon {
            font-size: 36px;
            margin-bottom: 10px;
            display: block;
        }

        .action-card h3 {
            margin: 0 0 8px 0;
            color: #333;
            font-size: 1.1rem;
        }

        .action-card p {
            margin: 0;
            color: #666;
            font-size: 0.9rem;
        }

        /* Filters */
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .filter-select,
        .filter-input {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            box-sizing: border-box;
        }

        .filter-btn {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Orders Table */
        .orders-table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e1e5e9;
            color: #333;
        }

        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid #e1e5e9;
            vertical-align: middle;
        }

        .orders-table tr:hover {
            background: #f8f9fa;
        }

        .order-info {
            display: flex;
            flex-direction: column;
        }

        .order-id {
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }

        .order-time {
            font-size: 12px;
            color: #666;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .student-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #4a90e2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
        }

        .student-details {
            display: flex;
            flex-direction: column;
        }

        .student-name {
            font-weight: 600;
            margin-bottom: 2px;
            color: #333;
        }

        .student-id {
            font-size: 12px;
            color: #666;
        }

        .canteen-tag {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .canteen-main {
            background: #e3f2fd;
            color: #1976d2;
        }

        .canteen-library {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .canteen-hostel {
            background: #e8f5e8;
            color: #388e3c;
        }

        .canteen-sports {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-preparing {
            background: #cce5ff;
            color: #004085;
        }

        .status-ready {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .order-items {
            font-size: 12px;
            color: #666;
            max-width: 200px;
        }

        .item-count {
            font-weight: 600;
            color: #333;
        }

        .amount {
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-view,
        .btn-update,
        .btn-cancel {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-view {
            background: #e9ecef;
            color: #495057;
        }

        .btn-update {
            background: #4a90e2;
            color: white;
        }

        .btn-cancel {
            background: #dc3545;
            color: white;
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
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e1e5e9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .close {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #999;
        }

        .close:hover {
            color: #333;
        }

        .order-detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .order-detail-row:last-child {
            border-bottom: none;
            font-weight: 600;
            font-size: 16px;
        }

        /* Pagination with Horizontal Scroll */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
        }

        .page-numbers-container {
            max-width: 400px;
            overflow-x: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }

        .page-numbers-container::-webkit-scrollbar {
            height: 6px;
        }

        .page-numbers-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .page-numbers-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .page-numbers-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .page-numbers {
            display: flex;
            gap: 5px;
            padding: 5px 0;
        }

        .page-btn {
            padding: 8px 16px;
            border: 2px solid #e1e5e9;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .page-btn.active {
            background: #4a90e2;
            color: white;
            border-color: #4a90e2;
        }

        .page-btn:hover:not(.active) {
            background: #f8f9fa;
        }

        .nav-btn {
            flex-shrink: 0;
        }

        /* Range Selector Styles */
        .range-selector {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .range-info {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .range-controls {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .range-controls label {
            color: #374151;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .range-dropdown {
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            color: #374151;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }

        .range-dropdown:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .range-dropdown:hover {
            border-color: #cbd5e1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .orders-table {
                font-size: 12px;
            }

            .orders-table th,
            .orders-table td {
                padding: 8px;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script>
        let ROOT = '<?= ROOT ?>';
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
            <!-- Welcome Header -->
            <div class="welcome-header">
                <h1>All Orders Management 📋</h1>
                <p>Monitor and manage all orders across all canteens</p>
            </div>

            <!-- Statistics -->
            <div class="orders-stats">
                <div class="stat-card total">
                    <div class="stat-number"><?= $total_orders ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
                <div class="stat-card pending">
                    <div class="stat-number"><?= $total_pending_orders ?></div>
                    <div class="stat-label">Pending Orders</div>
                </div>
                <div class="stat-card completed">
                    <div class="stat-number"><?= $total_completed_orders ?></div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-card cancelled">
                    <div class="stat-number"><?= $total_cancelled_orders ?></div>
                    <div class="stat-label">Cancelled</div>
                </div>
                <div class="stat-card revenue">
                    <div class="stat-number">₹<?= $total_revenue ?></div>
                    <div class="stat-label">Today's Revenue</div>
                </div>
            </div>



            <!-- Filters -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label>Search Orders</label>
                        <input type="text" class="filter-input" placeholder="Order ID, Student name...">
                    </div>
                    <div class="filter-group">
                        <label>Canteen</label>
                        <select class="filter-select">
                            <option value="">All Canteens</option>
                            <?php foreach ($canteens as $id => $name): ?>
                                <option value="<?= $id ?>"><?= $name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select class="filter-select">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="preparing">Preparing</option>
                            <option value="ready">Ready</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Date Range</label>
                        <input type="date" class="filter-input">
                    </div>


                </div>
            </div>

            <!-- Orders Table -->
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order Details</th>
                            <th>Student</th>
                            <th>Canteen</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($orders) && !empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>
                                        <div class="order-info">
                                            <div class="order-id">#<?= $order->id ?></div>
                                            <div class="order-time"><?= timeAgoOrDate($order->time) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar"><?= getInitials($order->student->student_name) ?></div>
                                            <div class="student-details">
                                                <div class="student-name"><?= ucwords($order->student->student_name) ?></div>

                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="canteen-tag canteen-main"><?= ucwords($order->canteen->canteen_name) ?></span></td>
                                    <td>
                                        <div class="order-items">

                                            <?= $order->items ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="amount">₹<?= $order->total ?></div>
                                    </td>
                                    <td><span class="status-badge status-preparing"><?= ucwords($order->status) ?></span></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                                    No orders found.
                                </td>
                            </tr>
                        <?php endif; ?>



                    </tbody>
                </table>
            </div>

            <!-- Pagination with Horizontal Scroll -->
            <div class="pagination">
                <button class="page-btn nav-btn" id="prevBtn">Previous</button>
                <div class="page-numbers-container">
                    <div class="page-numbers" id="pageNumbers">

                        <?php for ($i = 1; $i <= $totalPageNumbers; $i++): ?>
                            <?php if ($i == 1): ?>
                                <button class="page-btn active"><?= $i ?></button>
                            <?php else: ?>
                                <button class="page-btn"><?= $i ?></button>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
                <button class="page-btn nav-btn" id="nextBtn">Next</button>
            </div>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Order Details - #ORD-2024-001</h3>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="order-detail-row">
                    <span>Student:</span>
                    <span>Emma Thompson (CS2021001)</span>
                </div>
                <div class="order-detail-row">
                    <span>Canteen:</span>
                    <span>Main Cafeteria</span>
                </div>
                <div class="order-detail-row">
                    <span>Order Time:</span>
                    <span>Today, 2:30 PM</span>
                </div>
                <div class="order-detail-row">
                    <span>Status:</span>
                    <span>Preparing</span>
                </div>
                <div class="order-detail-row">
                    <span>Items:</span>
                    <span></span>
                </div>
                <div style="margin-left: 20px; margin-bottom: 10px;">
                    <div class="order-detail-row">
                        <span>• Chicken Biryani x1</span>
                        <span>₹180</span>
                    </div>
                    <div class="order-detail-row">
                        <span>• Coke x1</span>
                        <span>₹45</span>
                    </div>
                    <div class="order-detail-row">
                        <span>• Salad x1</span>
                        <span>₹60</span>
                    </div>
                </div>
                <div class="order-detail-row">
                    <span><strong>Total Amount:</strong></span>
                    <span><strong>₹285</strong></span>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>assets/js/functions.js">

    </script>
    <script>
        function viewOrder(id) {
            document.getElementById('orderModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('orderModal').style.display = 'none';
        }

        function updateStatus(id) {
            const newStatus = prompt('Enter new status (pending/preparing/ready/completed/cancelled):');
            if (newStatus) {
                alert('Order #' + id + ' status updated to: ' + newStatus);
            }
        }

        function cancelOrder(id) {
            if (confirm('Are you sure you want to cancel this order?')) {
                alert('Order #' + id + ' has been cancelled');
            }
        }

        function exportOrders() {
            alert('Exporting orders data...');
        }

        function viewAnalytics() {
            alert('Opening analytics dashboard...');
        }

        function bulkUpdate() {
            alert('Opening bulk update interface...');
        }

        function sendNotifications() {
            alert('Sending notifications to students and canteens...');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('orderModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Apply Filters Function
        function applyFilters() {
            // Get all filter values
            const allFilters = {
                search: document.querySelector('.filter-input[placeholder*="Order ID"]').value.trim(),
                canteen: document.querySelector('.filter-select').value,
                status: document.querySelectorAll('.filter-select')[1].value,
                date: document.querySelector('.filter-input[type="date"]').value,

            };

            // Filter out empty/null values
            const activeFilters = Object.fromEntries(
                Object.entries(allFilters).filter(([key, value]) => value && value !== '')
            );

            // Always include page number (even if it's 1)
            activeFilters.page = getCurrentPage();



            // Here you can add your filtering logic
            // Example: send AJAX request to server with activeFilters

            return activeFilters;
        }

        // Helper function to get current page number
        function getCurrentPage() {
            // Get from active pagination button
            const activePage = document.querySelector('.page-btn.active:not(.nav-btn)')?.textContent;
            return activePage || 1;
        }

        // Auto-filter setup
        function setupAutoFilters() {
            function triggerFilters(e, isPagination = false) {
                e.preventDefault();

                // If it's not a pagination event, reset page to 1
                if (!isPagination) {
                    resetToPageOne();
                }

                const filters = applyFilters();
                let url = ROOT + '/OrdersController/orders';
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            filters: filters
                        })
                    }) // 👈 Missing closing parenthesis was here
                    .then(res => res.json())
                    .then(data => {
                        console.log("from filter ");
                        if (data.success) {
                            // Update the table with new data
                            // For simplicity, we will just log the data here
                            console.log(data.orders);
                            let tbody = document.querySelector('.orders-table tbody');
                            tbody.innerHTML = ''; // Clear existing rows
                            data.orders.forEach(order => appendOrders(order));
                            // You would typically update the DOM to reflect the new orders
                            updatePaginationNumbers(data.totalPageNumbers);
                        } else {
                            //show error in the html
                            let tbody = document.querySelector('.orders-table tbody');
                            tbody.innerHTML = '<tr><td colspan="5">No orders found</td></tr>';
                        }
                    })
            }

            // Function to reset pagination to page 1
            function resetToPageOne() {
                // Remove active class from all page buttons
                document.querySelectorAll('.page-btn:not(.nav-btn)').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Set first page as active
                const firstPageBtn = document.querySelector('.page-btn:not(.nav-btn)');
                if (firstPageBtn) {
                    firstPageBtn.classList.add('active');
                }
            }

            // Debounced version for search input
            let searchTimeout;

            function debouncedFilter(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => triggerFilters(e, false), 500); // false = not pagination
            }

            // Event delegation for all filter elements (NOT pagination)
            document.addEventListener('change', function(e) {
                if (e.target.matches('.filter-select, .filter-input[type="date"]')) {
                    triggerFilters(e, false); // false = not pagination
                }
            });

            // Special handling for search input (debounced)
            document.addEventListener('input', function(e) {
                if (e.target.matches('.filter-input[placeholder*="Order ID"]')) {
                    debouncedFilter(e); // This calls triggerFilters with false
                }
            });

            // Handle pagination clicks (DON'T reset page)
            document.addEventListener('click', function(e) {
                if (e.target.matches('.page-btn:not(.nav-btn), #prevBtn, #nextBtn')) {
                    // Small delay to let pagination update first
                    setTimeout(() => triggerFilters(e, true), 100); // true = is pagination
                }
            });
        }

        // Initialize auto-filters
        setupAutoFilters();

        // Filter button functionality (if button exists)
        const filterBtn = document.querySelector('.filter-btn');
        if (filterBtn) {
            filterBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const filters = applyFilters();
            });
        }

        function appendOrders(order) {
            const tbody = document.querySelector('.orders-table tbody');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="order-info">
                        <div class="order-id">#${order.id}</div>
                        <div class="order-time">${timeAgoOrDate(order.time)}</div>
                    </div>
                </td>
                <td>
                    <div class="student-info">  
                        <div class="student-avatar">${getInitials(order.student.student_name)}</div>
                        <div class="student-details">
                            <div class="student-name">${formatLabel(order.student.student_name)}</div>
                        </div>
                    </div>
                </td>
                <td><span class="canteen-tag canteen-main">${formatLabel(order.canteen.canteen_name)}</span></td>
                <td>
                    <div class="order-items">
                        ${order.items}
                    </div>
                </td>
                <td>
                    <div class="amount">₹${order.total}</div>
                </td>
                <td><span class="status-badge status-${order.status}">${order.status}</span></td>
            `;
            tbody.appendChild(tr);
        }



        function updatePaginationNumbers(totalPages) {
            // Get the page numbers container
            const pageNumbersContainer = document.querySelector('.page-numbers');

            if (!pageNumbersContainer) {
                console.error('Page numbers container not found');
                return;
            }

            // Clear existing page buttons (keep only non-page buttons like prev/next)
            pageNumbersContainer.innerHTML = '';

            // Create new page buttons based on totalPages parameter
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = 'page-btn';
                pageBtn.textContent = i;

                // Set first page as active by default
                if (i === 1) {
                    pageBtn.classList.add('active');
                }

                // Add click event listener for each button
                pageBtn.addEventListener('click', function() {
                    // Remove active class from all page buttons
                    document.querySelectorAll('.page-btn:not(.nav-btn)').forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Trigger filters with pagination flag
                    const event = new Event('click');
                    setTimeout(() => triggerFilters(event, true), 100);

                    // Scroll clicked button into view
                    this.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                });

                // Append to container
                pageNumbersContainer.appendChild(pageBtn);
            }

            // Update global pagination variables if they exist
            if (typeof totalOrders !== 'undefined') {
                window.totalPages = totalPages;
            }

            console.log(`Pagination updated: ${totalPages} pages created`);
        }
    </script>
</body>

</html>
<script>
    // Horizontal Scrolling Pagination JavaScript for Orders
    document.addEventListener('DOMContentLoaded', function() {
        const pageNumbersContainer = document.querySelector('.page-numbers-container');
        const prevBtn = document.querySelector('#prevBtn');
        const nextBtn = document.querySelector('#nextBtn');
        const paginationBtns = document.querySelectorAll('.page-btn:not(.nav-btn)');

        let currentPage = 1;
        const totalOrders = 1247;
        const itemsPerPage = 50;
        const totalPages = Math.ceil(totalOrders / itemsPerPage);

        // Handle page number clicks
        paginationBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.classList.contains('nav-btn')) {
                    // Remove active class from all buttons
                    paginationBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    currentPage = parseInt(this.textContent);
                    updatePaginationState();

                    // Scroll the clicked button into view
                    this.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            });
        });

        // Handle Previous button
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updateActivePage();
                updatePaginationState();
                scrollToActivePage();
            }
        });

        // Handle Next button
        nextBtn.addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                updateActivePage();
                updatePaginationState();
                scrollToActivePage();
            }
        });

        // Update active page button
        function updateActivePage() {
            paginationBtns.forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.textContent) === currentPage) {
                    btn.classList.add('active');
                }
            });
        }

        // Update pagination state (enable/disable prev/next buttons)
        function updatePaginationState() {
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage >= totalPages;
        }

        // Scroll active page into view
        function scrollToActivePage() {
            const activeBtn = document.querySelector('.page-btn.active:not(.nav-btn)');
            if (activeBtn) {
                activeBtn.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        // Mouse wheel scrolling for page numbers
        if (pageNumbersContainer) {
            pageNumbersContainer.addEventListener('wheel', function(e) {
                e.preventDefault();
                this.scrollLeft += e.deltaY;
            });

            // Touch scrolling for mobile
            let isScrolling = false;
            let startX = 0;
            let scrollLeft = 0;

            pageNumbersContainer.addEventListener('touchstart', function(e) {
                isScrolling = true;
                startX = e.touches[0].pageX - this.offsetLeft;
                scrollLeft = this.scrollLeft;
            });

            pageNumbersContainer.addEventListener('touchmove', function(e) {
                if (!isScrolling) return;
                e.preventDefault();
                const x = e.touches[0].pageX - this.offsetLeft;
                const walk = (x - startX) * 2;
                this.scrollLeft = scrollLeft - walk;
            });

            pageNumbersContainer.addEventListener('touchend', function() {
                isScrolling = false;
            });
        }

        // Initialize pagination state
        updatePaginationState();
    });




    document.querySelector('.filter-btn').addEventListener('click', function(e) {
        e.preventDefault();
        const filters = applyFilters();



    });

    function applyFilters() {
        // Get all filter values
        const allFilters = {
            search: document.querySelector('.filter-input[placeholder*="Order ID"]').value.trim(),
            canteen: document.querySelector('.filter-select').value,
            status: document.querySelectorAll('.filter-select')[1].value,
            date: document.querySelector('.filter-input[type="date"]').value,
            //amountRange: document.querySelectorAll('.filter-select')[2].value
        };

        // Filter out empty/null values
        const activeFilters = Object.fromEntries(
            Object.entries(allFilters).filter(([key, value]) => value && value !== '')
        );

        // Always include page number (even if it's 1)
        activeFilters.page = getCurrentPage();

        console.log('Active Filters:', activeFilters);

        return activeFilters;
    }


    function getCurrentPage() {
        // Option 1: From URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const pageFromUrl = urlParams.get('page');

        // Option 2: From active pagination button
        const activePage = document.querySelector('.pagination .active')?.textContent;

        // Option 3: From a hidden input or data attribute
        const pageFromInput = document.querySelector('input[name="current_page"]')?.value;

        // Return page number (default to 1 if not found)
        return pageFromUrl || activePage || pageFromInput || 1;
    }
</script>