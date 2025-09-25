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
            grid-template-columns: 1fr 1fr;
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
            <!-- Header Section -->
            <div class="details-header">
                <div class="header-content">
                    <div class="canteen-info">
                        <h1 class="canteen-title">
                            🏢 Main Campus Canteen
                        </h1>
                        <p class="canteen-subtitle">
                            📍 Main Campus Building, Ground Floor
                        </p>
                        <div class="status-badge status-active">Active</div>
                    </div>
                    <div class="header-actions">
                        <a href="<?= ROOT ?>admin/canteens" class="action-btn back-btn">
                            ← Back to Canteens
                        </a>
                        <button class="action-btn edit-btn">
                            ✏️ Edit Canteen
                        </button>
                    </div>
                </div>
            </div>

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
                    <h3 class="stat-value">45</h3>
                    <p class="stat-label">Menu Items</p>
                </div>
                <div class="stat-card rating">
                    <div class="stat-icon">⭐</div>
                    <h3 class="stat-value">4.8</h3>
                    <p class="stat-label">Average Rating</p>
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
                            <span class="info-value">Main Campus Canteen</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📍 Location</span>
                            <span class="info-value">Main Campus Building, Ground Floor</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🕒 Operating Hours</span>
                            <span class="info-value">7:00 AM - 9:00 PM</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">👥 Seating Capacity</span>
                            <span class="info-value">120 seats</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📅 Established</span>
                            <span class="info-value">January 2020</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🔄 Status</span>
                            <span class="info-value">Active</span>
                        </div>
                    </div>
                </div>

                <!-- Manager & Contact Details -->
                <div class="details-section">
                    <h2 class="section-title">
                        👨‍💼 Manager & Contact Details
                    </h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">👤 Manager Name</span>
                            <span class="info-value">Rajesh Kumar</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📧 Email</span>
                            <span class="info-value">rajesh.kumar@college.edu</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📱 Phone</span>
                            <span class="info-value">+91 98765 43210</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">💼 Experience</span>
                            <span class="info-value">8 years</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">🏠 Address</span>
                            <span class="info-value">123 College Street, City</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">📋 Employee ID</span>
                            <span class="info-value">EMP001</span>
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
                    <!-- Main Course Category -->
                    <div class="category-section">
                        <h3 class="category-title">🍛 Main Course</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Chicken Biryani</h4>
                                    <span class="menu-item-price">₹180</span>
                                </div>
                                <p class="menu-item-desc">Aromatic basmati rice with tender chicken pieces and traditional spices</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Mutton Curry</h4>
                                    <span class="menu-item-price">₹220</span>
                                </div>
                                <p class="menu-item-desc">Tender mutton pieces cooked in rich spicy gravy</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Fish Fry</h4>
                                    <span class="menu-item-price">₹160</span>
                                </div>
                                <p class="menu-item-desc">Fresh fish marinated with spices and deep fried to perfection</p>
                            </div>
                        </div>
                    </div>

                    <!-- Vegetarian Category -->
                    <div class="category-section">
                        <h3 class="category-title">🥬 Vegetarian</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Paneer Butter Masala</h4>
                                    <span class="menu-item-price">₹150</span>
                                </div>
                                <p class="menu-item-desc">Cottage cheese cubes in rich tomato and butter gravy</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Dal Tadka</h4>
                                    <span class="menu-item-price">₹80</span>
                                </div>
                                <p class="menu-item-desc">Yellow lentils tempered with cumin, garlic and spices</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Aloo Gobi</h4>
                                    <span class="menu-item-price">₹90</span>
                                </div>
                                <p class="menu-item-desc">Potato and cauliflower curry with aromatic spices</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Veg Biryani</h4>
                                    <span class="menu-item-price">₹140</span>
                                </div>
                                <p class="menu-item-desc">Fragrant basmati rice with mixed vegetables and spices</p>
                            </div>
                        </div>
                    </div>

                    <!-- South Indian Category -->
                    <div class="category-section">
                        <h3 class="category-title">🥥 South Indian</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Masala Dosa</h4>
                                    <span class="menu-item-price">₹80</span>
                                </div>
                                <p class="menu-item-desc">Crispy rice crepe filled with spiced potato curry, served with chutney</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Idli Sambar</h4>
                                    <span class="menu-item-price">₹60</span>
                                </div>
                                <p class="menu-item-desc">Steamed rice cakes served with lentil curry and coconut chutney</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Uttapam</h4>
                                    <span class="menu-item-price">₹70</span>
                                </div>
                                <p class="menu-item-desc">Thick pancake topped with onions, tomatoes and green chilies</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Rava Upma</h4>
                                    <span class="menu-item-price">₹50</span>
                                </div>
                                <p class="menu-item-desc">Semolina cooked with vegetables and South Indian spices</p>
                            </div>
                        </div>
                    </div>

                    <!-- North Indian Category -->
                    <div class="category-section">
                        <h3 class="category-title">🫓 North Indian</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Chole Bhature</h4>
                                    <span class="menu-item-price">₹120</span>
                                </div>
                                <p class="menu-item-desc">Spicy chickpea curry served with fluffy fried bread</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Rajma Rice</h4>
                                    <span class="menu-item-price">₹100</span>
                                </div>
                                <p class="menu-item-desc">Red kidney beans curry served with steamed basmati rice</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Butter Naan</h4>
                                    <span class="menu-item-price">₹40</span>
                                </div>
                                <p class="menu-item-desc">Soft leavened bread brushed with butter</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Tandoori Roti</h4>
                                    <span class="menu-item-price">₹25</span>
                                </div>
                                <p class="menu-item-desc">Whole wheat bread cooked in tandoor oven</p>
                            </div>
                        </div>
                    </div>

                    <!-- Snacks Category -->
                    <div class="category-section">
                        <h3 class="category-title">🍟 Snacks</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Samosa</h4>
                                    <span class="menu-item-price">₹25</span>
                                </div>
                                <p class="menu-item-desc">Crispy pastry filled with spiced potatoes and peas</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Pakora</h4>
                                    <span class="menu-item-price">₹30</span>
                                </div>
                                <p class="menu-item-desc">Mixed vegetable fritters in chickpea flour batter</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Sandwich</h4>
                                    <span class="menu-item-price">₹45</span>
                                </div>
                                <p class="menu-item-desc">Grilled sandwich with vegetables and cheese</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Pav Bhaji</h4>
                                    <span class="menu-item-price">₹80</span>
                                </div>
                                <p class="menu-item-desc">Spiced vegetable curry served with buttered bread rolls</p>
                            </div>
                        </div>
                    </div>

                    <!-- Beverages Category -->
                    <div class="category-section">
                        <h3 class="category-title">🥤 Beverages</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Mango Lassi</h4>
                                    <span class="menu-item-price">₹60</span>
                                </div>
                                <p class="menu-item-desc">Refreshing yogurt drink blended with sweet mango pulp</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Masala Chai</h4>
                                    <span class="menu-item-price">₹20</span>
                                </div>
                                <p class="menu-item-desc">Traditional Indian tea brewed with aromatic spices</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Fresh Lime Soda</h4>
                                    <span class="menu-item-price">₹35</span>
                                </div>
                                <p class="menu-item-desc">Refreshing lime juice with soda water and mint</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Filter Coffee</h4>
                                    <span class="menu-item-price">₹30</span>
                                </div>
                                <p class="menu-item-desc">South Indian style strong coffee with milk and sugar</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Buttermilk</h4>
                                    <span class="menu-item-price">₹25</span>
                                </div>
                                <p class="menu-item-desc">Spiced yogurt drink with curry leaves and ginger</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Fresh Fruit Juice</h4>
                                    <span class="menu-item-price">₹50</span>
                                </div>
                                <p class="menu-item-desc">Seasonal fresh fruit juice (Orange/Apple/Pomegranate)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Desserts Category -->
                    <div class="category-section">
                        <h3 class="category-title">🍰 Desserts</h3>
                        <div class="menu-grid">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Gulab Jamun</h4>
                                    <span class="menu-item-price">₹40</span>
                                </div>
                                <p class="menu-item-desc">Soft milk dumplings soaked in rose-flavored sugar syrup</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Rasmalai</h4>
                                    <span class="menu-item-price">₹50</span>
                                </div>
                                <p class="menu-item-desc">Cottage cheese dumplings in sweetened milk with cardamom</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Ice Cream</h4>
                                    <span class="menu-item-price">₹35</span>
                                </div>
                                <p class="menu-item-desc">Vanilla, chocolate, or strawberry flavored ice cream</p>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <h4 class="menu-item-name">Kheer</h4>
                                    <span class="menu-item-price">₹45</span>
                                </div>
                                <p class="menu-item-desc">Rice pudding cooked in milk with nuts and cardamom</p>
                            </div>
                        </div>
                    </div>
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
                            <tr>
                                <td><strong>#ORD001</strong></td>
                                <td>Rahul Sharma</td>
                                <td>2x Chicken Biryani, 1x Lassi</td>
                                <td><strong>₹420</strong></td>
                                <td><span class="order-status status-completed">Completed</span></td>
                                <td>2 hours ago</td>
                            </tr>
                            <tr>
                                <td><strong>#ORD002</strong></td>
                                <td>Priya Patel</td>
                                <td>1x Masala Dosa, 1x Coffee</td>
                                <td><strong>₹110</strong></td>
                                <td><span class="order-status status-pending">Pending</span></td>
                                <td>1 hour ago</td>
                            </tr>
                            <tr>
                                <td><strong>#ORD003</strong></td>
                                <td>Amit Kumar</td>
                                <td>3x Samosa, 1x Tea</td>
                                <td><strong>₹95</strong></td>
                                <td><span class="order-status status-completed">Completed</span></td>
                                <td>3 hours ago</td>
                            </tr>
                            <tr>
                                <td><strong>#ORD004</strong></td>
                                <td>Sneha Reddy</td>
                                <td>1x Paneer Butter Masala, 2x Roti</td>
                                <td><strong>₹180</strong></td>
                                <td><span class="order-status status-cancelled">Cancelled</span></td>
                                <td>4 hours ago</td>
                            </tr>
                            <tr>
                                <td><strong>#ORD005</strong></td>
                                <td>Vikash Singh</td>
                                <td>1x Chole Bhature, 1x Lassi</td>
                                <td><strong>₹180</strong></td>
                                <td><span class="order-status status-completed">Completed</span></td>
                                <td>5 hours ago</td>
                            </tr>
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
                                    <p class="stat-change positive">↗ +12% from yesterday</p>
                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹12,450</h3>
                                    <p class="stat-label">Revenue Today</p>
                                    <p class="stat-change positive">↗ +8% from yesterday</p>
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
                                    <p class="stat-change positive">↗ +15% from last week</p>
                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹78,340</h3>
                                    <p class="stat-label">Revenue This Week</p>
                                    <p class="stat-change positive">↗ +18% from last week</p>
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
                                    <p class="stat-change positive">↗ +22% from last month</p>
                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹2,85,680</h3>
                                    <p class="stat-label">Revenue This Month</p>
                                    <p class="stat-change positive">↗ +25% from last month</p>
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
                                    <p class="stat-change positive">↗ +35% from last year</p>
                                </div>
                                <div class="stat-card revenue">
                                    <div class="stat-icon">💰</div>
                                    <h3 class="stat-value">₹24,56,890</h3>
                                    <p class="stat-label">Revenue This Year</p>
                                    <p class="stat-change positive">↗ +42% from last year</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Summary Stats -->
                    <div class="summary-stats">
                        <h4 class="summary-title">📈 Performance Summary</h4>
                        <div class="summary-grid">
                            <div class="summary-item">
                                <span class="summary-label">🏆 Best Day</span>
                                <span class="summary-value">Monday (₹15,680)</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">🕐 Peak Hours</span>
                                <span class="summary-value">12:00 PM - 2:00 PM</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">🍽️ Most Popular Item</span>
                                <span class="summary-value">Chicken Biryani</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">👥 Total Customers</span>
                                <span class="summary-value">1,245 unique</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</body>

</html>