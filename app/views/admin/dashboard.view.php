<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Campus Canteen</title>
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
            background: #667eea;
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

        .admin-content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
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

        @media (max-width: 1200px) {
            .admin-content-grid {
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
                    <h1>Welcome back, Admin! 👨‍💼</h1>
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
                    <h2 class="admin-stat-value">5</h2>
                    <p class="admin-stat-label">Total Canteens</p>
                </div>

                <div class="admin-stat-card students">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon students">
                            👨‍🎓
                        </div>
                    </div>
                    <h2 class="admin-stat-value">1,247</h2>
                    <p class="admin-stat-label">Registered Students</p>
                </div>

                <div class="admin-stat-card orders">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon orders">
                            📋
                        </div>
                    </div>
                    <h2 class="admin-stat-value">3,892</h2>
                    <p class="admin-stat-label">Total Orders</p>
                </div>

                <div class="admin-stat-card revenue">
                    <div class="admin-stat-header">
                        <div class="admin-stat-icon revenue">
                            💰
                        </div>
                    </div>
                    <h2 class="admin-stat-value">₹2,45,680</h2>
                    <p class="admin-stat-label">Total Revenue</p>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="admin-content-grid">
                <!-- Canteens Section -->
                <div class="admin-section">
                    <h2 class="admin-section-title">
                        🍽️ Canteens Overview
                    </h2>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Canteen Name</th>
                                <th>Status</th>
                                <th>Orders Today</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Main Campus Canteen</strong></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>45</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Engineering Block Canteen</strong></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>32</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Library Cafe</strong></td>
                                <td><span class="status-badge status-inactive">Inactive</span></td>
                                <td>0</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Sports Complex Canteen</strong></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>28</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Hostel Mess</strong></td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>67</td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="<?= ROOT ?>admin/canteens" class="view-all-link">
                        View All Canteens →
                    </a>
                </div>

                <!-- Students Section -->
                <div class="admin-section">
                    <h2 class="admin-section-title">
                        👨‍🎓 Recent Students
                    </h2>

                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>John Doe</strong></td>
                                <td>john.doe@college.edu</td>
                                <td><span class="status-badge status-verified">Verified</span></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jane Smith</strong></td>
                                <td>jane.smith@college.edu</td>
                                <td><span class="status-badge status-verified">Verified</span></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Rahul Kumar</strong></td>
                                <td>rahul.kumar@college.edu</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Priya Singh</strong></td>
                                <td>priya.singh@college.edu</td>
                                <td><span class="status-badge status-verified">Verified</span></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Alex Johnson</strong></td>
                                <td>alex.johnson@college.edu</td>
                                <td><span class="status-badge status-active">Active</span></td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="#" class="admin-action-btn view-btn">👁️ View</a>
                                        <a href="#" class="admin-action-btn edit-btn">✏️ Edit</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="<?= ROOT ?>admin/students" class="view-all-link">
                        View All Students →
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>