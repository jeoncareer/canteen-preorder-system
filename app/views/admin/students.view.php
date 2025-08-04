<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Students Management - College Admin</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <style>
        /* Students Management Specific Styles */
        .students-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .students-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .students-actions {
            display: flex;
            gap: 1rem;
        }

        .add-student-btn,
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

        .add-student-btn:hover {
            background: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }

        .export-btn:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        . summary-cards {
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

        .summary-card.verified .summary-value {
            color: var(--success-color);
        }

        .summary-card.pending .summary-value {
            color: var(--warning-color);
        }

        .summary-card.active .summary-value {
            color: #8b5cf6;
        }

        .students-table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .students-table {
            width: 100%;
            border-collapse: collapse;
        }

        .students-table th {
            background: #f8fafc;
            color: var(--primary-color);
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.9rem;
        }

        .students-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .students-table tr:hover {
            background: #f8fafc;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .student-details h4 {
            margin: 0;
            font-weight: 600;
            color: var(--primary-color);
        }

        .student-details p {
            margin: 0.2rem 0 0 0;
            font-size: 0.9rem;
            color: #64748b;
        }

        .department-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dept-cs {
            background: #dbeafe;
            color: #1e40af;
        }

        .dept-me {
            background: #fef3c7;
            color: #92400e;
        }

        .dept-ee {
            background: #d1fae5;
            color: #065f46;
        }

        .dept-ce {
            background: #fee2e2;
            color: #991b1b;
        }

        .dept-ba {
            background: #f3e8ff;
            color: #7c3aed;
        }

        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-verified {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-suspended {
            background: #fee2e2;
            color: #991b1b;
        }

        .student-actions {
            display: flex;
            gap: 0.3rem;
        }

        .student-action-btn {
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

        .suspend-btn {
            background: var(--danger-color);
            color: white;
        }

        .suspend-btn:hover {
            background: #c0392b;
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

        @media (max-width: 900px) {
            .main-content {
                padding: 1rem;
            }

            .students-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .students-actions {
                justify-content: center;
            }

            .students-table {
                font-size: 0.8rem;
            }

            .students-table th,
            .students-table td {
                padding: 0.5rem;
            }

            .student-info {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
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
        <?php $page = "students";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title">👨‍🎓 Students Management</h1>
                </div>
            </div>

            <!-- Students Header -->
            <div class="students-header">
                <h2 class="students-title">
                    All Registered Students
                </h2>
                <div class="students-actions">
                    <a href="#" class="add-student-btn">
                        ➕ Add New Student
                    </a>
                    <a href="#" class="export-btn">
                        📊 Export Data
                    </a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card total">
                    <div class="summary-value">2,847</div>
                    <div class="summary-label">Total Students</div>
                </div>
                <div class="summary-card verified">
                    <div class="summary-value">2,654</div>
                    <div class="summary-label">Verified</div>
                </div>
                <div class="summary-card pending">
                    <div class="summary-value">187</div>
                    <div class="summary-label">Pending</div>
                </div>
                <div class="summary-card active">
                    <div class="summary-value">2,641</div>
                    <div class="summary-label">Active Users</div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="form-group">
                        <label class="form-label">Search Students</label>
                        <input type="text" class="form-input" placeholder="Search by name, email, or student ID..." id="searchInput">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <select class="form-select" id="departmentFilter">
                            <option value="">All Departments</option>
                            <option value="cs">Computer Science</option>
                            <option value="me">Mechanical Engineering</option>
                            <option value="ee">Electrical Engineering</option>
                            <option value="ce">Civil Engineering</option>
                            <option value="ba">Business Administration</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="verified">Verified</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="name">Name</option>
                            <option value="recent">Recently Joined</option>
                            <option value="department">Department</option>
                            <option value="orders">Order Count</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="students-table-container">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Student ID</th>
                            <th>Department</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Orders</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">ET</div>
                                    <div class="student-details">
                                        <h4>Emma Thompson</h4>
                                        <p>emma.thompson@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>CS2021001</strong></td>
                            <td><span class="department-badge dept-cs">Computer Science</span></td>
                            <td>3rd Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>47</td>
                            <td>Jan 15, 2021</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">DK</div>
                                    <div class="student-details">
                                        <h4>David Kumar</h4>
                                        <p>david.kumar@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>ME2022015</strong></td>
                            <td><span class="department-badge dept-me">Mechanical Eng.</span></td>
                            <td>2nd Year</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>23</td>
                            <td>Aug 20, 2022</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">LC</div>
                                    <div class="student-details">
                                        <h4>Lisa Chen</h4>
                                        <p>lisa.chen@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>BA2020087</strong></td>
                            <td><span class="department-badge dept-ba">Business Admin</span></td>
                            <td>4th Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>89</td>
                            <td>Sep 10, 2020</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">RS</div>
                                    <div class="student-details">
                                        <h4>Robert Singh</h4>
                                        <p>robert.singh@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>EE2021045</strong></td>
                            <td><span class="department-badge dept-ee">Electrical Eng.</span></td>
                            <td>3rd Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>156</td>
                            <td>Feb 28, 2021</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">MG</div>
                                    <div class="student-details">
                                        <h4>Maria Garcia</h4>
                                        <p>maria.garcia@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>CE2023012</strong></td>
                            <td><span class="department-badge dept-ce">Civil Engineering</span></td>
                            <td>1st Year</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>8</td>
                            <td>Jul 15, 2023</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">AJ</div>
                                    <div class="student-details">
                                        <h4>Alex Johnson</h4>
                                        <p>alex.johnson@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>CS2022089</strong></td>
                            <td><span class="department-badge dept-cs">Computer Science</span></td>
                            <td>2nd Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>67</td>
                            <td>Jan 05, 2022</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">SP</div>
                                    <div class="student-details">
                                        <h4>Sarah Patel</h4>
                                        <p>sarah.patel@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>ME2020156</strong></td>
                            <td><span class="department-badge dept-me">Mechanical Eng.</span></td>
                            <td>4th Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>234</td>
                            <td>Aug 12, 2020</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="student-info">
                                    <div class="student-avatar">JW</div>
                                    <div class="student-details">
                                        <h4>James Wilson</h4>
                                        <p>james.wilson@college.edu</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>EE2023034</strong></td>
                            <td><span class="department-badge dept-ee">Electrical Eng.</span></td>
                            <td>1st Year</td>
                            <td><span class="status-badge status-verified">Verified</span></td>
                            <td>12</td>
                            <td>Sep 03, 2023</td>
                            <td>
                                <div class="student-actions">
                                    <a href="#" class="student-action-btn view-btn">👁️</a>
                                    <a href="#" class="student-action-btn edit-btn">✏️</a>
                                    <button class="student-action-btn suspend-btn">🚫</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        Showing 1-8 of 2,847 students
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>← Previous</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">...</button>
                        <button class="pagination-btn">356</button>
                        <button class="pagination-btn">Next →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>