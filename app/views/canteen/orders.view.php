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
    <style>
        /* Orders Management Specific Styles */
        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .orders-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .orders-actions {
            display: flex;
            gap: 1rem;
        }

        .export-btn,
        .refresh-btn {
            padding: 0.8rem 1.5rem;
            border: 2px solid var(--secondary-color);
            background: white;
            color: var(--secondary-color);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .export-btn:hover,
        .refresh-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .filters-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 1.5rem;
            align-items: end;
        }

        .date-range-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .bulk-actions {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .bulk-actions-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .bulk-select-all {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .bulk-actions-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .bulk-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .bulk-accept {
            background: var(--success-color);
            color: white;
        }

        .bulk-reject {
            background: var(--danger-color);
            color: white;
        }

        .bulk-complete {
            background: var(--warning-color);
            color: white;
        }

        .bulk-btn:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .orders-table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .orders-table tr:hover {
            background: #f8fafc;
        }

        .order-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .order-id {
            font-weight: 700;
            color: var(--secondary-color);
            font-size: 1rem;
        }

        .student-info {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .student-name {
            font-weight: 600;
            color: var(--primary-color);
        }

        .student-email {
            font-size: 0.85rem;
            color: #64748b;
        }

        .order-items-list {
            max-width: 300px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.3rem 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-weight: 500;
            color: var(--primary-color);
        }

        .item-quantity {
            color: #64748b;
            font-size: 0.8rem;
        }

        .order-total {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--success-color);
        }

        .order-time-info {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            font-size: 0.9rem;
        }

        .order-time {
            color: var(--primary-color);
            font-weight: 500;
        }

        .order-date {
            color: #64748b;
            font-size: 0.8rem;
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
            min-width: 120px;
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

        .status-select.ready {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-select.completed {
            background: #ddd6fe;
            color: #5b21b6;
        }

        .status-select.rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .order-actions {
            display: flex;
            gap: 0.3rem;
        }

        .order-action-btn {
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
        }

        .view-details-btn {
            background: var(--secondary-color);
            color: white;
        }

        .view-details-btn:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.9rem;
        }

        .pagination-controls {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--primary-color);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .pagination-btn:hover:not(:disabled) {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-summary-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-summary-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-summary-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-pending .stat-summary-value {
            color: #92400e;
        }

        .stat-accepted .stat-summary-value {
            color: #065f46;
        }

        .stat-ready .stat-summary-value {
            color: #1e40af;
        }

        .stat-completed .stat-summary-value {
            color: #5b21b6;
        }

        .stat-rejected .stat-summary-value {
            color: #991b1b;
        }

        /* Orders Tabs */
        .orders-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .tab-btn {
            padding: 1rem 2rem;
            border: none;
            background: transparent;
            color: #64748b;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
            position: relative;
            bottom: -2px;
        }

        .tab-btn:hover {
            color: var(--secondary-color);
            background: rgba(103, 126, 234, 0.05);
        }

        .tab-btn.active {
            color: var(--secondary-color);
            border-bottom-color: var(--secondary-color);
            background: rgba(103, 126, 234, 0.05);
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* History specific styles */
        .history-filters {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 1.5rem;
            align-items: end;
        }

        .history-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .history-chart-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 1.1rem;
            font-weight: 600;
        }

        @media (max-width: 1200px) {
            .filters-grid {
                grid-template-columns: 1fr 1fr 1fr;
                gap: 1rem;
            }

            .date-range-group {
                grid-column: span 3;
            }
        }

        @media (max-width: 900px) {
            .main-content {
                padding: 1rem;
            }

            .filters-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .date-range-group {
                grid-column: span 1;
                grid-template-columns: 1fr;
            }

            .orders-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .orders-actions {
                justify-content: center;
            }

            .bulk-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .bulk-actions-buttons {
                justify-content: center;
            }

            .orders-table {
                font-size: 0.8rem;
            }

            .orders-table th,
            .orders-table td {
                padding: 0.5rem;
            }

            .pagination {
                flex-direction: column;
                gap: 1rem;
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
                <button class="tab-btn" data-tab="order-history">
                    📊 Order History
                </button>
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
                            <input type="text" class="form-input" placeholder="Search by order ID, student name, or email..." id="searchInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Filter</label>
                            <select class="form-select" id="statusFilter">
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
                            <input type="date" class="form-input" id="fromDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-input" id="toDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select class="form-select" id="sortBy">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="amount">Amount (High to Low)</option>
                                <option value="status">Status</option>
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
                        <button class="bulk-btn bulk-accept">✅ Accept Selected</button>
                        <button class="bulk-btn bulk-complete">🍽️ Mark Ready</button>
                        <button class="bulk-btn bulk-reject">❌ Reject Selected</button>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Orders - Replace with PHP loop -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1025">
                                </td>
                                <td><span class="order-id">#1025</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">Sarah Wilson</span>
                                        <span class="student-email">sarah.wilson@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Chicken Biryani</span>
                                            <span class="item-quantity">x2</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Masala Chai</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹385</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">11:45 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1025' class="status-select pending">
                                        <option value="pending" selected>Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="ready">Ready</option>
                                        <option value="completed">Completed</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1024">
                                </td>
                                <td><span class="order-id">#1024</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">Michael Chen</span>
                                        <span class="student-email">michael.chen@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Veg Sandwich</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Fresh Lime Soda</span>
                                            <span class="item-quantity">x2</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹130</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">11:30 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1024' class="status-select accepted">
                                        <option value="pending">Pending</option>
                                        <option value="accepted" selected>Accepted</option>
                                        <option value="ready">Ready</option>
                                        <option value="completed">Completed</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1023">
                                </td>
                                <td><span class="order-id">#1023</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">John Doe</span>
                                        <span class="student-email">john.doe@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Pasta Alfredo</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Garlic Bread</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Cold Coffee</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹245</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">11:15 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1023' class="status-select ready">
                                        <option value="pending">Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="ready" selected>Ready</option>
                                        <option value="completed">Completed</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1022">
                                </td>
                                <td><span class="order-id">#1022</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">Jane Smith</span>
                                        <span class="student-email">jane.smith@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Chicken Roll</span>
                                            <span class="item-quantity">x2</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Pepsi</span>
                                            <span class="item-quantity">x2</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹180</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">11:00 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1022' class="status-select completed">
                                        <option value="pending">Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="ready">Ready</option>
                                        <option value="completed" selected>Completed</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1021">
                                </td>
                                <td><span class="order-id">#1021</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">Rahul Kumar</span>
                                        <span class="student-email">rahul.kumar@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Masala Dosa</span>
                                            <span class="item-quantity">x2</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Filter Coffee</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹160</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">10:45 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1021' class="status-select rejected">
                                        <option value="pending">Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="ready">Ready</option>
                                        <option value="completed">Completed</option>
                                        <option value="rejected" selected>Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="order-checkbox" data-order-id="1020">
                                </td>
                                <td><span class="order-id">#1020</span></td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name">Priya Singh</span>
                                        <span class="student-email">priya.singh@college.edu</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-items-list">
                                        <div class="order-item">
                                            <span class="item-name">Idli Sambar</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                        <div class="order-item">
                                            <span class="item-name">Coconut Chutney</span>
                                            <span class="item-quantity">x1</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="order-total">₹85</span></td>
                                <td>
                                    <div class="order-time-info">
                                        <span class="order-time">10:30 AM</span>
                                        <span class="order-date">Today</span>
                                    </div>
                                </td>
                                <td>
                                    <select data-id='1020' class="status-select pending">
                                        <option value="pending" selected>Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="ready">Ready</option>
                                        <option value="completed">Completed</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="order-actions">
                                        <button class="order-action-btn view-details-btn">👁️ Details</button>
                                    </div>
                                </td>
                            </tr>
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
        <div id="order-history" class="tab-content">
            <!-- History Stats -->
            <div class="history-stats">
                <div class="stat-summary-card">
                    <div class="stat-summary-value" style="color: #5b21b6;">847</div>
                    <div class="stat-summary-label">Total Orders This Month</div>
                </div>
                <div class="stat-summary-card">
                    <div class="stat-summary-value" style="color: #27ae60;">₹1,24,580</div>
                    <div class="stat-summary-label">Monthly Revenue</div>
                </div>
                <div class="stat-summary-card">
                    <div class="stat-summary-value" style="color: #3498db;">₹147</div>
                    <div class="stat-summary-label">Average Order Value</div>
                </div>
                <div class="stat-summary-card">
                    <div class="stat-summary-value" style="color: #f39c12;">4.8</div>
                    <div class="stat-summary-label">Average Rating</div>
                </div>
            </div>

            <!-- Revenue Chart Section -->
            <div class="history-chart-section">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary-color);">📈 Revenue Trends (Last 30 Days)</h3>
                <div class="chart-placeholder">
                    📊 Revenue Chart Placeholder - Connect to Chart.js or similar library
                </div>
            </div>

            <!-- History Filters -->
            <div class="filters-section">
                <div class="history-filters">
                    <div class="form-group">
                        <label class="form-label">Search Historical Orders</label>
                        <input type="text" class="form-input" placeholder="Search by order ID, student name..." id="historySearchInput">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Range</label>
                        <select class="form-select" id="dateRange">
                            <option value="7">Last 7 Days</option>
                            <option value="30" selected>Last 30 Days</option>
                            <option value="90">Last 3 Months</option>
                            <option value="365">Last Year</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Order Status</label>
                        <select class="form-select" id="historyStatusFilter">
                            <option value="">All Status</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort By</label>
                        <select class="form-select" id="historySortBy">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="amount">Amount (High to Low)</option>
                            <option value="student">Student Name</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Historical Orders Table -->
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Student</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Historical Orders Sample Data -->
                        <tr>
                            <td><span class="order-id">#1015</span></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">Emma Thompson</span>
                                    <span class="student-email">emma.thompson@college.edu</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-items-list">
                                    <div class="order-item">
                                        <span class="item-name">Chicken Tikka</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Naan Bread</span>
                                        <span class="item-quantity">x2</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Lassi</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="order-total">₹320</span></td>
                            <td>
                                <div class="order-time-info">
                                    <span class="order-time">2:30 PM</span>
                                    <span class="order-date">Yesterday</span>
                                </div>
                            </td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="order-id">#1012</span></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">David Kumar</span>
                                    <span class="student-email">david.kumar@college.edu</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-items-list">
                                    <div class="order-item">
                                        <span class="item-name">Margherita Pizza</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Coke</span>
                                        <span class="item-quantity">x2</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="order-total">₹280</span></td>
                            <td>
                                <div class="order-time-info">
                                    <span class="order-time">1:15 PM</span>
                                    <span class="order-date">Yesterday</span>
                                </div>
                            </td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="order-id">#1008</span></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">Lisa Chen</span>
                                    <span class="student-email">lisa.chen@college.edu</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-items-list">
                                    <div class="order-item">
                                        <span class="item-name">Caesar Salad</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Iced Tea</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="order-total">₹150</span></td>
                            <td>
                                <div class="order-time-info">
                                    <span class="order-time">12:45 PM</span>
                                    <span class="order-date">2 days ago</span>
                                </div>
                            </td>
                            <td><span class="status-badge rejected">Rejected</span></td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="order-id">#1005</span></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">Robert Singh</span>
                                    <span class="student-email">robert.singh@college.edu</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-items-list">
                                    <div class="order-item">
                                        <span class="item-name">Butter Chicken</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Basmati Rice</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Mango Lassi</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="order-total">₹420</span></td>
                            <td>
                                <div class="order-time-info">
                                    <span class="order-time">7:30 PM</span>
                                    <span class="order-date">3 days ago</span>
                                </div>
                            </td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><span class="order-id">#1002</span></td>
                            <td>
                                <div class="student-info">
                                    <span class="student-name">Maria Garcia</span>
                                    <span class="student-email">maria.garcia@college.edu</span>
                                </div>
                            </td>
                            <td>
                                <div class="order-items-list">
                                    <div class="order-item">
                                        <span class="item-name">Veggie Burger</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">French Fries</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                    <div class="order-item">
                                        <span class="item-name">Milkshake</span>
                                        <span class="item-quantity">x1</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="order-total">₹195</span></td>
                            <td>
                                <div class="order-time-info">
                                    <span class="order-time">6:15 PM</span>
                                    <span class="order-date">4 days ago</span>
                                </div>
                            </td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="order-actions">
                                    <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- History Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        Showing 1-5 of 847 historical orders
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>← Previous</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">...</button>
                        <button class="pagination-btn">169</button>
                        <button class="pagination-btn">Next →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;

                    // Remove active class from all tabs and contents
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById(targetTab).classList.add('active');
                });
            });
        });

        <
        script >
            // Basic functionality for the orders page
            document.addEventListener('DOMContentLoaded', function() {
                // Select all functionality
                const selectAllHeader = document.getElementById('selectAllHeader');
                const selectAll = document.getElementById('selectAll');
                const orderCheckboxes = document.querySelectorAll('.order-checkbox[data-order-id]');
                const selectedCount = document.getElementById('selectedCount');

                function updateSelectedCount() {
                    const checked = document.querySelectorAll('.order-checkbox[data-order-id]:checked').length;
                    selectedCount.textContent = `${checked} selected`;
                }

                selectAllHeader.addEventListener('change', function() {
                    orderCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    selectAll.checked = this.checked;
                    updateSelectedCount();
                });

                selectAll.addEventListener('change', function() {
                    orderCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    selectAllHeader.checked = this.checked;
                    updateSelectedCount();
                });

                orderCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectedCount);
                });

                // Status change functionality
                const statusSelects = document.querySelectorAll('.status-select');
                statusSelects.forEach(select => {
                    select.addEventListener('change', function() {
                        const orderId = this.dataset.id;
                        const newStatus = this.value;

                        // Remove all status classes
                        this.classList.remove('pending', 'accepted', 'ready', 'completed', 'rejected');

                        // Add the new status class
                        this.classList.add(newStatus);

                        console.log(`Order ${orderId} status changed to: ${newStatus}`);

                        // Here you would make an AJAX call to update the database
                        // updateOrderStatus(orderId, newStatus);
                    });
                });

                // Bulk actions
                document.querySelector('.bulk-accept').addEventListener('click', function() {
                    const selected = document.querySelectorAll('.order-checkbox[data-order-id]:checked');
                    console.log(`Accepting ${selected.length} orders`);
                    // Implement bulk accept logic
                });

                document.querySelector('.bulk-complete').addEventListener('click', function() {
                    const selected = document.querySelectorAll('.order-checkbox[data-order-id]:checked');
                    console.log(`Marking ${selected.length} orders as ready`);
                    // Implement bulk ready logic
                });

                document.querySelector('.bulk-reject').addEventListener('click', function() {
                    const selected = document.querySelectorAll('.order-checkbox[data-order-id]:checked');
                    if (confirm(`Are you sure you want to reject ${selected.length} orders?`)) {
                        console.log(`Rejecting ${selected.length} orders`);
                        // Implement bulk reject logic
                    }
                });
            });
    </script>
</body>

</html>