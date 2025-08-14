<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Admin Dashboard - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <style>
        /* Admin Dashboard Specific Styles */
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .admin-stat-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .admin-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .admin-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
        }

        .admin-stat-card.canteens::before {
            background: #4f46e5;
        }

        .admin-stat-card.students::before {
            background: var(--success-color);
        }

        .admin-stat-card.orders::before {
            background: var(--warning-color);
        }

        .admin-stat-card.revenue::before {
            background: var(--secondary-color);
        }

        .admin-stat-card.staff::before {
            background: #8b5cf6;
        }

        .admin-stat-card.categories::before {
            background: #06b6d4;
        }

        .admin-stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .admin-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .admin-stat-icon.canteens {
            background: #4f46e5;
        }

        .admin-stat-icon.students {
            background: var(--success-color);
        }

        .admin-stat-icon.orders {
            background: var(--warning-color);
        }

        .admin-stat-icon.revenue {
            background: var(--secondary-color);
        }

        .admin-stat-icon.staff {
            background: #8b5cf6;
        }

        .admin-stat-icon.categories {
            background: #06b6d4;
        }

        .admin-stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--primary-color);
        }

        .admin-stat-label {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 500;
            margin: 0.5rem 0 0 0;
        }

        .admin-stat-change {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .admin-stat-change.positive {
            color: var(--success-color);
        }

        .admin-stat-change.negative {
            color: var(--danger-color);
        }

        .admin-content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .admin-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .admin-section-title {
            margin: 0 0 1.5rem 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background: #f8fafc;
            color: var(--primary-color);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9rem;
        }

        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .admin-table tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
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

        .status-verified {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .admin-actions {
            display: flex;
            gap: 0.3rem;
        }

        .admin-action-btn {
            padding: 0.3rem 0.6rem;
            border: none;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            text-align: center;
        }

        .view-btn {
            background: var(--secondary-color);
            color: white;
        }

        .view-btn:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .edit-btn {
            background: var(--warning-color);
            color: white;
        }

        .edit-btn:hover {
            background: #d68910;
            transform: translateY(-1px);
        }

        .delete-btn {
            background: var(--danger-color);
            color: white;
        }

        .delete-btn:hover {
            background: #c0392b;
            transform: translateY(-1px);
        }

        .view-all-link {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            margin-top: 1rem;
        }

        .view-all-link:hover {
            color: #2980b9;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-action-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .quick-action-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .quick-action-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .quick-action-desc {
            font-size: 0.9rem;
            color: #64748b;
        }

        .performance-metrics {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .metric-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .metric-chart {
            height: 200px;
            background: #f8fafc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 600;
        }

        @media (max-width: 1200px) {
            .admin-content-grid {
                grid-template-columns: 1fr;
            }

            .performance-metrics {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 900px) {
            .main-content {
                padding: 1rem;
            }

            .admin-stats {
                grid-template-columns: 1fr;
            }

            .admin-table {
                font-size: 0.9rem;
            }

            .admin-table th,
            .admin-table td {
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
        <?php $page = "dashboard";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-content">
                    <h1>Welcome back, College Admin! 🎓</h1>
                    <p>Here's an overview of your campus canteen system</p>
                </div>
            </div>

            <!-- Admin Stats -->
            <div class="admin-stats">
                <div class="admin-stat-card canteens">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon canteens">
                            🍽️
                        </div>
                    </div>
                    <h2 class="admin-stat-value">8</h2>
                    <p class="admin-stat-label">Active Canteens</p>
                    <p class="admin-stat-change positive">
                        ↗ +2 new this semester
                    </p>
                </div>

                <div class="admin-stat-card students">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon students">
                            👨‍🎓
                        </div>
                    </div>
                    <h2 class="admin-stat-value">2,847</h2>
                    <p class="admin-stat-label">Registered Students</p>
                    <p class="admin-stat-change positive">
                        ↗ +156 this month
                    </p>
                </div>

                <div class="admin-stat-card orders">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon orders">
                            📋
                        </div>
                    </div>
                    <h2 class="admin-stat-value">15,892</h2>
                    <p class="admin-stat-label">Total Orders</p>
                    <p class="admin-stat-change positive">
                        ↗ +8% this week
                    </p>
                </div>

                <div class="admin-stat-card revenue">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon revenue">
                            💰
                        </div>
                    </div>
                    <h2 class="admin-stat-value">₹8,45,680</h2>
                    <p class="admin-stat-label">Total Revenue</p>
                    <p class="admin-stat-change positive">
                        ↗ +15% this month
                    </p>
                </div>

                <div class="admin-stat-card staff">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon staff">
                            👨‍🍳
                        </div>
                    </div>
                    <h2 class="admin-stat-value">24</h2>
                    <p class="admin-stat-label">Canteen Staff</p>
                    <p class="admin-stat-change positive">
                        ↗ +3 new hires
                    </p>
                </div>

                <div class="admin-stat-card categories">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon categories">
                            🏷️
                        </div>
                    </div>
                    <h2 class="admin-stat-value">45</h2>
                    <p class="admin-stat-label">Menu Categories</p>
                    <p class="admin-stat-change positive">
                        ↗ +5 new categories
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            <!-- <div class="quick-actions-grid">
                <div class="quick-action-card">
                    <div class="quick-action-icon">🏢</div>
                    <div class="quick-action-title">Manage Canteens</div>
                    <div class="quick-action-desc">Add, edit, or remove canteens</div>
                </div>

                <div class="quick-action-card">
                    <div class="quick-action-icon">👥</div>
                    <div class="quick-action-title">Student Management</div>
                    <div class="quick-action-desc">View and manage student accounts</div>
                </div>

                <div class="quick-action-card">
                    <div class="quick-action-icon">📊</div>
                    <div class="quick-action-title">Analytics</div>
                    <div class="quick-action-desc">View detailed reports and insights</div>
                </div>

                <div class="quick-action-card">
                    <div class="quick-action-icon">⚙️</div>
                    <div class="quick-action-title">System Settings</div>
                    <div class="quick-action-desc">Configure system preferences</div>
                </div>
            </div> -->




            <!-- Content Grid -->
            <div class="admin-content-grid">
                <!-- Canteens Overview -->
                <div class="admin-section">
                    <h2 class="admin-section-title">
                        🍽️ Canteens Overview
                    </h2>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Canteen Name</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Orders Today</th>
                                <th>Revenue</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Main Campus Canteen</strong></td>
                                <td>Central Block</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>67</td>
                                <td>₹18,450</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Engineering Block Canteen</strong></td>
                                <td>Engineering Wing</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>45</td>
                                <td>₹12,300</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Library Cafe</strong></td>
                                <td>Library Building</td>
                                <td><span class="status-badge status-inactive">Maintenance</span></td>
                                <td>0</td>
                                <td>₹0</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Sports Complex Canteen</strong></td>
                                <td>Sports Complex</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>32</td>
                                <td>₹8,750</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Hostel Mess A</strong></td>
                                <td>Boys Hostel</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>89</td>
                                <td>₹24,680</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#" class="view-all-link">
                        View All Canteens →
                    </a>
                </div>

                <!-- Recent Students & Activity -->
                <div>
                    <!-- Recent Students -->
                    <div class="admin-section">
                        <h2 class="admin-section-title">
                            👨‍🎓 Recent Student Registrations
                        </h2>

                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Emma Thompson</strong></td>
                                    <td>Computer Science</td>
                                    <td><span class="status-badge status-verified">Verified</span></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="#" class="admin-action-btn view-btn">👁️</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>David Kumar</strong></td>
                                    <td>Mechanical Eng.</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="#" class="admin-action-btn view-btn">👁️</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Lisa Chen</strong></td>
                                    <td>Business Admin</td>
                                    <td><span class="status-badge status-verified">Verified</span></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="#" class="admin-action-btn view-btn">👁️</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Robert Singh</strong></td>
                                    <td>Electrical Eng.</td>
                                    <td><span class="status-badge status-verified">Verified</span></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="#" class="admin-action-btn view-btn">👁️</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Maria Garcia</strong></td>
                                    <td>Civil Engineering</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <td>
                                        <div class="admin-actions">
                                            <a href="#" class="admin-action-btn view-btn">👁️</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="#" class="view-all-link">
                            View All Students →
                        </a>
                    </div>

                    <!-- System Alerts -->
                    <div class="admin-section" style="margin-top: 2rem;">
                        <h2 class="admin-section-title">
                            🚨 System Alerts
                        </h2>

                        <div style="space-y: 1rem;">
                            <div style="padding: 1rem; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 6px; margin-bottom: 1rem;">
                                <div style="font-weight: 600; color: #92400e;">Library Cafe Offline</div>
                                <div style="font-size: 0.9rem; color: #78716c;">Equipment maintenance in progress</div>
                            </div>

                            <div style="padding: 1rem; background: #dbeafe; border-left: 4px solid #3b82f6; border-radius: 6px; margin-bottom: 1rem;">
                                <div style="font-weight: 600; color: #1e40af;">High Order Volume</div>
                                <div style="font-size: 0.9rem; color: #475569;">Main Campus Canteen experiencing peak hours</div>
                            </div>

                            <div style="padding: 1rem; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 6px;">
                                <div style="font-weight: 600; color: #065f46;">System Update Complete</div>
                                <div style="font-size: 0.9rem; color: #475569;">All systems running smoothly</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>