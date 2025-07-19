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
        /* Modal Form Spacing Improvements */
        .add-item-modal {
            max-width: 600px;
            width: 90%;
        }

        .modal-header {
            padding: 2rem 2.5rem 1.5rem 2.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .modal-body {
            padding: 2.5rem;
        }

        .add-item-form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.95rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 1rem 1.2rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: var(--transition);
            background: #f8fafc;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-help {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 0.5rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            margin-top: 1rem;
        }

        .btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(103, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #f8fafc;
            color: var(--primary-color);
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        .close-button {
            position: absolute;
            top: 1.5rem;
            right: 2rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: #64748b;
            cursor: pointer;
            transition: var(--transition);
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .close-button:hover {
            background: #f1f5f9;
            color: var(--danger-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .add-item-modal {
                width: 95%;
                margin: 1rem;
            }

            .modal-header,
            .modal-body {
                padding: 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .modal-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
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
            <div data-modal-target="#modal" class="add-item-section">
                <a href="#" class="add-new-item-btn">
                    <span class="add-icon">➕</span>
                    <div class="add-content">
                        <h3>Add New Menu Item</h3>
                        <p>Create a new dish for your menu</p>
                    </div>
                </a>
            </div>

            <div class="add-item-modal" id="modal">
                <div class="modal-header">
                    <div class="modal-title">🍽️ Add New Menu Item</div>
                    <button data-close-button="close-button" class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="add-item-form" method="POST" action="/canteen/add-item">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="item-name">Item Name *</label>
                                <input type="text" id="item-name" name="item_name" class="form-input" placeholder="e.g., Chicken Biryani" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="item-price">Price (₹) *</label>
                                <input type="number" id="item-price" name="price" class="form-input" placeholder="0.00" min="0" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="item-description">Description</label>
                            <textarea id="item-description" name="description" class="form-textarea" placeholder="Describe your delicious dish..." rows="3"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="item-category">Category *</label>
                                <select id="item-category" name="category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="main-course">Main Course</option>
                                    <option value="beverages">Beverages</option>
                                    <option value="snacks">Snacks</option>
                                    <option value="desserts">Desserts</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="item-status">Availability *</label>
                                <select id="item-status" name="status" class="form-select" required>
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="item-emoji">Food Emoji</label>
                            <input type="text" id="item-emoji" name="emoji" class="form-input" placeholder="🍛" maxlength="2">
                            <small class="form-help">Choose an emoji to represent your dish (optional)</small>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">➕</span>
                                Add Menu Item
                            </button>
                        </div>
                    </form>
                </div>
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

        <script src="/canteen-preorder-system/public/assets/js/add-item.js"></script>


</body>

</html>