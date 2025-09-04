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
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/add-item.css">
    <script>
        const ROOT = '<?= ROOT ?>';
    </script>
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

        .summary-card.verified .summary-value {
            color: var(--success-color);
        }

        .summary-card.pending .summary-value {
            color: var(--warning-color);
        }

        .summary-card.active .summary-value {
            color: #8b5cf6;
        }

        /* Filters Section */
        .filters-section {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input,
        .form-select {
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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
            align-items: center;
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
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .range-dropdown:hover {
            border-color: #cbd5e1;
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
                    <!-- <a href="#" class="add-student-btn">
                        ➕ Add New Student
                    </a> -->
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
                        <?php if (!empty($student_total_orders)): ?>
                            <?php foreach ($student_total_orders as $student): ?>
                                <tr>
                                    <td>
                                        <div class="student-info">
                                            <div class="student-avatar">ET</div>
                                            <div class="student-details">
                                                <h4><?= $student->student_name ?></h4>
                                                <p><?= $student->student_email ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong><?= $student->reg_no ?></strong></td>
                                    <td><span class="department-badge dept-cs">Computer Science</span></td>
                                    <td>3rd Year</td>
                                    <td><span class="status-badge status-<?= $student->status ?>"><?= $student->status ?></span></td>
                                    <td><?= $student->total_orders ?></td>
                                    <td>Jan 15, 2021</td>
                                    <td>
                                        <div class="student-actions">
                                            <div data-modal-target="#view-profile-modal" class="student-action-btn view-btn">👁️</div>
                                            <div class="student-action-btn edit-btn">✏️</div>
                                            <button class="student-action-btn suspend-btn">🚫</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </tbody>
                </table>

                <!-- Pagination with Horizontal Scroll -->
                <div class="pagination">
                    <div class="pagination-info">
                        Showing 1-10 of <?= number_format($totalRows) ?> students
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn nav-btn" id="prev-page-btn" disabled>← Previous</button>
                        <div class="page-numbers-container">
                            <div class="page-numbers" id="pageNumbers">
                                <?php for ($i = 1; $i < $totalPageNumbers; $i++): ?>
                                    <?php if ($i == 1): ?>
                                        <button value="<?= ($i - 1) * 10 ?>" class="pagination-btn active"><?= $i ?></button>
                                    <?php else: ?>
                                        <button value="<?= ($i - 1) * 10 ?>" class="pagination-btn "><?= $i ?></button>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <button class="pagination-btn nav-btn" id="next-page-btn">Next →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="view-profile-modal">
        <div class="modal-header">
            <div class="modal-title">👤 View Profile</div>
            <button data-close-button="close-button" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
            <div class="profile-card">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <p class="form-value">John Doe</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <p class="form-value">john.doe@example.com</p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <p class="form-value">+91 98765 43210</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <p class="form-value">Canteen Manager</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <p class="form-value">123, Main Street, Kochi, Kerala</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Joined On</label>
                    <p class="form-value">01 Jan 2024</p>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
                <button type="button" class="btn btn-primary">
                    <span class="btn-icon">✏️</span>
                    Edit Profile
                </button>
            </div>
        </div>
    </div>



    <script src="<?= ROOT ?>assets/js/index.js"></script>
    <script src="<?= ROOT ?>assets/js/add-item.js"></script>
    <script>
        let prevPageBtn = document.getElementById('prev-page-btn');
        let nextPageBtn = document.getElementById('next-page-btn');
        updateStudentsDetails();
        nextPageBtnListner();
        prevPageBtnListner();

        function updateStudentsDetails() {

            let pageNumbers = document.querySelector('#pageNumbers');
            pageNumbers.addEventListener('click', e => {
                let btn = e.target;
                if (btn.classList.contains("pagination-btn")) {
                    let value = parseInt(btn.value);

                    if (btn.classList.contains('active')) {
                        return false;
                    }
                    if (value === 0) {
                        prevPageBtn.disabled = true;
                    } else {
                        prevPageBtn.disabled = false;
                    }

                    if (btn.matches(":last-child")) {
                        nextPageBtn.disabled = true;
                    } else {
                        nextPageBtn.disabled = false;
                    }


                    console.log(value);
                    fetchStudentData(value);
                    paginationBtnChange(btn);
                }
            })




        }



        function fetchStudentData(value) {
            console.log("inside fetchstudentdata");
            const url = ROOT + 'OrdersController/students?offset=' + value;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let students = data.orders;
                        let tBody = document.querySelector('.students-table tbody');
                        tBody.innerHTML = '';

                        students.forEach(student => {
                            let tr = document.createElement('tr');
                            tr.innerHTML = `
                                      <td>
                                        <div class="student-info">
                                            <div class="student-avatar">ET</div>
                                            <div class="student-details">
                                                <h4>${student.student_name}</h4>
                                                <p>${student.student_email}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>${student.reg_no}</strong></td>
                                    <td><span class="department-badge dept-cs">Computer Science</span></td>
                                    <td>3rd Year</td>
                                    <td><span class="status-badge status-${student.status}">${student.status}</span></td>
                                    <td>${student.total_orders}</td>
                                    <td>Jan 15, 2021</td>
                                    <td>
                                        <div class="student-actions">
                                            <a href="#" class="student-action-btn view-btn">👁️</a>
                                            <a href="#" class="student-action-btn edit-btn">✏️</a>
                                            <button class="student-action-btn suspend-btn">🚫</button>
                                        </div>
                                    </td>
                            `;

                            tBody.appendChild(tr);
                        })
                    }
                })
        }

        function prevPageBtnListner() {
            prevPageBtn.addEventListener('click', () => {
                let activeBtn = document.querySelector('.pagination-btn.active');
                let value = parseInt(activeBtn.value) - 10;
                let newBtn = document.querySelector(`.pagination-btn[value="${value}"]`);

                fetchStudentData(value);
                paginationBtnChange(newBtn);
            })
        }

        function nextPageBtnListner() {
            nextPageBtn.addEventListener('click', () => {
                let activeBtn = document.querySelector('.pagination-btn.active');
                let value = parseInt(activeBtn.value) + 10;
                let newBtn = document.querySelector(`.pagination-btn[value="${value}"]`);
                fetchStudentData(value);
                paginationBtnChange(newBtn);
            })
        }

        function paginationBtnChange(newBtn) {
            currentButton = document.querySelector('.pagination-btn.active');
            currentButton.classList.remove('active');
            newBtn.classList.add('active');
            let value = parseInt(newBtn.value);

            if (value === 0) {
                prevPageBtn.disabled = true;
            } else {
                prevPageBtn.disabled = false;
            }

            if (newBtn.matches(":last-child")) {
                nextPageBtn.disabled = true;
            } else {
                nextPageBtn.disabled = false;
            }
        }
    </script>
</body>

</html>