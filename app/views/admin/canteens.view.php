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
                            <p class="stat-value">8</p>
                            <p class="stat-label">Total Canteens</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-value">7</p>
                            <p class="stat-label">Active</p>
                        </div>
                        <div class="stat-item">
                            <p class="stat-value">₹45,280</p>
                            <p class="stat-label">Today's Revenue</p>
                        </div>
                    </div>
                </div>
                <button class="add-canteen-btn">
                    ➕ Add New Canteen
                </button>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <h3 class="filters-title">🔍 Filter Canteens</h3>
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="filter-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Location</label>
                        <select class="filter-select">
                            <option value="">All Locations</option>
                            <option value="main">Main Campus</option>
                            <option value="library">Library Block</option>
                            <option value="hostel">Hostel Area</option>
                            <option value="sports">Sports Complex</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" class="filter-input" placeholder="Search canteens...">
                    </div>
                    <div class="filter-group">
                        <button class="filter-btn">Apply Filters</button>
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
                                    <p class="canteen-stat-value">45</p>
                                    <p class="canteen-stat-label">Menu Items</p>
                                </div>
                            </div>
                            <div class="canteen-actions">
                                <div class="canteen-revenue">₹12,450 Today</div>
                                <div class="action-buttons">
                                    <a href="#" class="action-btn view-btn">👁️ View</a>

                                    <button class="action-btn delete-btn">🗑️ Block</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


            </div>
        </div>
    </div>

    <script>
        // Add some basic interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterBtn = document.querySelector('.filter-btn');
            const statusFilter = document.querySelector('.filter-select');
            const searchInput = document.querySelector('.filter-input');

            if (filterBtn) {
                filterBtn.addEventListener('click', function() {
                    // Add filter logic here
                    console.log('Filters applied');
                });
            }

            // Add canteen button
            const addBtn = document.querySelector('.add-canteen-btn');
            if (addBtn) {
                addBtn.addEventListener('click', function() {
                    // Add new canteen logic here
                    console.log('Add new canteen clicked');
                });
            }

            // Delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to delete this canteen?')) {
                        // Delete logic here
                        console.log('Canteen deleted');
                    }
                });
            });
        });
    </script>
</body>

</html>