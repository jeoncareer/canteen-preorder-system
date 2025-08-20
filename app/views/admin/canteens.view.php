<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Canteens Management - College Admin</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/menu-management.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/add-item.css">

    <style>
        /* Canteens Management Specific Styles */
        .canteens-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .canteens-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .canteens-actions {
            display: flex;
            gap: 1rem;
        }

        .add-canteen-btn,
        .export-btn {
            padding: 0.8rem 1.5rem;
            border: 2px solid var(--secondary-color);
            background: var(--secondary-color);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .export-btn {
            background: white;
            color: var(--secondary-color);
        }

        .add-canteen-btn:hover {
            background: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .export-btn:hover {
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
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        .canteens-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .canteen-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .canteen-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .canteen-header {
            background: #4f46e5;
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .canteen-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .canteen-status.active {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .canteen-status.inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .canteen-status.maintenance {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .canteen-name {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .canteen-location {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }

        .canteen-body {
            padding: 2rem;
        }

        .canteen-stats {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .canteen-stat {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
        }

        .canteen-stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .canteen-stat-label {
            font-size: 0.8rem;
            color: #64748b;
            margin: 0.3rem 0 0 0;
        }

        .canteen-info {
            margin-bottom: 2rem;
        }

        .canteen-info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .canteen-info-item:last-child {
            border-bottom: none;
        }

        .canteen-info-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .canteen-info-value {
            color: #64748b;
        }

        .canteen-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .canteen-action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            /* space between emoji/icon and text */
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .canteen-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Specific styles */
        .view-details-btn {
            background: var(--secondary-color);
            color: #fff;
        }

        .view-details-btn:hover {
            background: #2980b9;
        }

        .edit-canteen-btn {
            background: var(--warning-color);
            color: #fff;
        }

        .edit-canteen-btn:hover {
            background: #d68910;
        }

        .toggle-status-btn {
            background: var(--success-color);
            color: #fff;
        }

        .toggle-status-btn:hover {
            background: #229954;
        }

        .toggle-status-btn.inactive {
            background: var(--danger-color);
        }

        .toggle-status-btn.inactive:hover {
            background: #c0392b;
        }


        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .summary-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .summary-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .summary-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .summary-card.total .summary-value {
            color: var(--secondary-color);
        }

        .summary-card.active .summary-value {
            color: var(--success-color);
        }

        .summary-card.inactive .summary-value {
            color: var(--danger-color);
        }

        .summary-card.maintenance .summary-value {
            color: var(--warning-color);
        }

        @media (max-width: 1200px) {
            .canteens-grid {
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            }

            .filters-grid {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 900px) {
            .main-content {
                padding: 1rem;
            }

            .canteens-grid {
                grid-template-columns: 1fr;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .canteens-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .canteens-actions {
                justify-content: center;
            }

            .canteen-stats {
                grid-template-columns: 1fr;
            }

            .canteen-actions {
                flex-direction: column;
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
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title">🍽️ Canteens Management</h1>
                </div>
            </div>

            <!-- Canteens Header -->
            <div class="canteens-header">
                <h2 class="canteens-title">
                    All Campus Canteens
                </h2>
                <div class="canteens-actions">
                    <a href="#" class="add-canteen-btn">
                        ➕ Add New Canteen
                    </a>
                    <a href="#" class="export-btn">
                        📊 Export Data
                    </a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card total">
                    <div class="summary-value">8</div>
                    <div class="summary-label">Total Canteens</div>
                </div>
                <div class="summary-card active">
                    <div class="summary-value">6</div>
                    <div class="summary-label">Active</div>
                </div>
                <div class="summary-card maintenance">
                    <div class="summary-value">1</div>
                    <div class="summary-label">Maintenance</div>
                </div>
                <div class="summary-card inactive">
                    <div class="summary-value">1</div>
                    <div class="summary-label">Inactive</div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="form-group">
                        <label class="form-label">Search Canteens</label>
                        <input type="text" class="form-input" placeholder="Search by name or location..." id="searchInput">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status Filter</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <select class="form-select" id="locationFilter">
                            <option value="">All Locations</option>
                            <option value="central">Central Block</option>
                            <option value="engineering">Engineering Wing</option>
                            <option value="library">Library Building</option>
                            <option value="sports">Sports Complex</option>
                            <option value="hostel">Hostel Area</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="name">Name</option>
                            <option value="orders">Orders (High to Low)</option>
                            <option value="revenue">Revenue (High to Low)</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Canteens Grid -->
            <div class="canteens-grid">
                <!-- Main Campus Canteen -->
                <div class="canteen-card">
                    <div class="canteen-header">
                        <div class="canteen-status active">Active</div>
                        <h3 class="canteen-name">Main Campus Canteen</h3>
                        <p class="canteen-location">📍 Central Block, Ground Floor</p>
                    </div>
                    <div class="canteen-body">
                        <div class="canteen-stats">
                            <div class="canteen-stat">
                                <div class="canteen-stat-value">67</div>
                                <div class="canteen-stat-label">Orders Today</div>
                            </div>
                            <div class="canteen-stat">
                                <div class="canteen-stat-value">₹18,450</div>
                                <div class="canteen-stat-label">Revenue</div>
                            </div>
                            <div class="canteen-stat">
                                <div class="canteen-stat-value">4.8</div>
                                <div class="canteen-stat-label">Rating</div>
                            </div>
                        </div>

                        <div class="canteen-info">
                            <div class="canteen-info-item">
                                <span class="canteen-info-label">Manager</span>
                                <span class="canteen-info-value">Rajesh Kumar</span>
                            </div>
                            <div class="canteen-info-item">
                                <span class="canteen-info-label">Staff Count</span>
                                <span class="canteen-info-value">8 members</span>
                            </div>
                            <div class="canteen-info-item">
                                <span class="canteen-info-label">Operating Hours</span>
                                <span class="canteen-info-value">7:00 AM - 9:00 PM</span>
                            </div>
                            <div class="canteen-info-item">
                                <span class="canteen-info-label">Contact</span>
                                <span class="canteen-info-value">+91 98765 43210</span>
                            </div>
                        </div>

                        <div class="canteen-actions">
                            <a href="#" data-modal-target="#canteen-view-modal" class="canteen-action-btn view-details-btn"> View Details</a>
                            <a href="#" class="canteen-action-btn edit-canteen-btn"> Edit</a>
                            <button class="canteen-action-btn toggle-status-btn"> Disable</button>
                        </div>
                    </div>
                </div>









            </div>
        </div>
    </div>

    <!-- View Canteen Modal -->
    <div class="modal" id="canteen-view-modal">
        <div class="modal-header">
            <div class="modal-title">🏫 Canteen Details</div>
            <button data-close-button="close-button" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
            <div class="canteen-details">
                <!-- Basic Details -->
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <p class="form-value" id="canteen-name">Main Campus Canteen</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Location</label>
                    <p class="form-value" id="canteen-location">Central Block, Ground Floor</p>
                </div>

                <!-- Revenue Section with Toggle -->
                <div class="form-group">
                    <label class="form-label">Revenue</label>
                    <div class="revenue-section">
                        <select id="revenue-filter" class="form-input">
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                        <p class="form-value" id="canteen-revenue">₹18,450</p>
                    </div>
                </div>

                <!-- Rating -->
                <div class="form-group">
                    <label class="form-label">Rating</label>
                    <p class="form-value" id="canteen-rating">4.8 ⭐</p>
                </div>

                <!-- Messaging Feature -->
                <div class="form-group">
                    <label class="form-label">Message Manager</label>
                    <textarea id="message-text" class="form-input" rows="3" placeholder="Type your message..."></textarea>
                    <button class="btn btn-primary mt-2" id="send-message-btn">📨 Send</button>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>assets/js/add-item.js"></script>
</body>

</html>