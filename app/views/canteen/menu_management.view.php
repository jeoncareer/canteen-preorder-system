<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Management - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/menu-management.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/add-item.css">
    <style>

    </style>
</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "menu_management";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title">🍽️ Menu Management</h1>
                </div>
            </div>

            <!-- Add New Item Section -->
            <div class="add-item-section">
                <a href="#" class="add-new-item-btn">
                    <span class="add-icon">➕</span>
                    <div class="add-content">
                        <h3>Add New Menu Item</h3>
                        <p>Create a new dish for your menu</p>
                    </div>
                </a>
            </div>

            <div class="add-item-modal" id="modal">
                <div class="model-header">
                    <div class="title">Example Modal</div>
                    <button class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Qui porro cupiditate non doloribus nobis minus cum itaque officiis
                    provident sit recusandae eveniet deleniti vero, pariatur at accusamus,
                    totam est velit ullam iure? Quas eos maiores vitae iure nobis voluptatem!
                    Voluptatibus accusantium, nostrum nihil libero consectetur sit
                    at architecto neque laudantium, assumenda repudiandae est debitis
                    rerum fugiat numquam quos, sequi pariatur illum natus quod hic ad
                    impedit recusandae. Labore magni
                    iure unde totam illo dolores minus corrupti id amet reiciendis? Natus.
                </div>

                <div id="overlay"></div>

                <!-- Search and Filter Section -->
                <div class="search-filter-section">
                    <div class="search-filter-grid">
                        <div class="form-group">
                            <label class="form-label">Search Menu Items</label>
                            <input type="text" class="form-input" placeholder="Search by name or description..." id="searchInput">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Filter by Category</label>
                            <select class="form-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="main-course">Main Course</option>
                                <option value="beverages">Beverages</option>
                                <option value="snacks">Snacks</option>
                                <option value="desserts">Desserts</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Filter by Status</label>
                            <select class="form-select" id="statusFilter">
                                <option value="">All Items</option>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Menu Items Grid -->
                <div class="menu-grid" id="menuGrid">
                    <!-- Sample Menu Items -->
                    <div class="menu-card" data-category="main-course" data-status="available">
                        <div class="menu-card-image">
                            🍛
                            <span class="status-badge status-available">Available</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Chicken Biryani</h3>
                            <p class="menu-item-description">Aromatic basmati rice cooked with tender chicken pieces and traditional spices</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹180</span>
                                <span class="menu-item-category">Main Course</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn available">🔄 Disable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card" data-category="beverages" data-status="available">
                        <div class="menu-card-image">
                            ☕
                            <span class="status-badge status-available">Available</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Masala Chai</h3>
                            <p class="menu-item-description">Traditional Indian tea brewed with aromatic spices and fresh milk</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹25</span>
                                <span class="menu-item-category">Beverages</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn available">🔄 Disable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card" data-category="snacks" data-status="unavailable">
                        <div class="menu-card-image">
                            🥪
                            <span class="status-badge status-unavailable">Unavailable</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Veg Sandwich</h3>
                            <p class="menu-item-description">Fresh vegetables with cheese and chutneys in toasted bread</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹60</span>
                                <span class="menu-item-category">Snacks</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn">🔄 Enable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card" data-category="main-course" data-status="available">
                        <div class="menu-card-image">
                            🍝
                            <span class="status-badge status-available">Available</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Pasta Alfredo</h3>
                            <p class="menu-item-description">Creamy white sauce pasta with herbs and parmesan cheese</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹120</span>
                                <span class="menu-item-category">Main Course</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn available">🔄 Disable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card" data-category="desserts" data-status="available">
                        <div class="menu-card-image">
                            🍰
                            <span class="status-badge status-available">Available</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Chocolate Cake</h3>
                            <p class="menu-item-description">Rich and moist chocolate cake with chocolate frosting</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹80</span>
                                <span class="menu-item-category">Desserts</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn available">🔄 Disable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card" data-category="beverages" data-status="available">
                        <div class="menu-card-image">
                            🥤
                            <span class="status-badge status-available">Available</span>
                        </div>
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Fresh Lime Soda</h3>
                            <p class="menu-item-description">Refreshing lime juice with soda water and a hint of mint</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹35</span>
                                <span class="menu-item-category">Beverages</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">✏️ Edit</button>
                                <button class="action-btn toggle-btn available">🔄 Disable</button>
                                <button class="action-btn delete-btn">🗑️ Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State (hidden by default) -->
                <div class="empty-state" id="emptyState" style="display: none;">
                    <div class="empty-state-icon">🍽️</div>
                    <h3 class="empty-state-title">No menu items found</h3>
                    <p class="empty-state-description">Try adjusting your search or filter criteria</p>
                </div>
            </div>
        </div>


</body>

</html>