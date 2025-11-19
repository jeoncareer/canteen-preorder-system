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

        .students-table tbody {
            transition: opacity 0.3s;
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

        .summary-card.suspended .summary-value {
            color: #f33a0cff;
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
                    <a href="<?=ROOT?>/admin/exportStudents" class="export-btn">
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
                <div class="summary-card suspended">
                    <div class="summary-value">2,641</div>
                    <div class="summary-label">Suspended Users</div>
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
                        <label class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="verified">Verified</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="id">Name</option>
                            <option value="recent">Recently Joined</option>

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
                                <tr data-student-id="<?= $student->id ?>">
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
                                            <div data-student-id="<?= $student->id ?>" data-modal-target="#view-profile-modal" class="student-action-btn view-btn">View Profile</div>

                                        </div>
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
                                <?php for ($i = 1; $i <= $totalPageNumbers; $i++): ?>
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
                        <label class="form-label">Student Id</label>
                        <p class="form-value" id="profile-id"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <p class="form-value" id="profile-name"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <p class="form-value" id="profile-email"></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <p class="form-value" id="profile-phone"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <p class="form-value" id="profile-department"></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Year</label>
                        <p class="form-value" id="profile-year"></p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <span class="status-badge" id="profile-status"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <p class="form-value" id="profile-address"></p>
                </div>
                <div class="form-group">
                    <label class="form-label">Joined On</label>
                    <p class="form-value" id="profile-joined"></p>
                </div>
                <div class="form-group">
                    <label class="form-label">Total Orders</label>
                    <p class="form-value" id="profile-orders"></p>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
                <!-- <button type="button" class="btn btn-primary">
                    <span class="btn-icon">✏️</span>
                    Edit Profile
                </button> -->
                <button data-student-id="" data-status="" type="button" class="status-indicator btn btn-danger">
                    <span class="btn-icon"></span>

                </button>
            </div>
        </div>
    </div>

    <div id="overlay"></div>


    <script src="<?= ROOT ?>assets/js/add-item.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            summaryCardsUpdate();
            const pageNumbersContainer = document.querySelector('.page-numbers-container');
            const pageNumbers = document.getElementById('pageNumbers');
            const prevBtn = document.getElementById('prev-page-btn');
            const nextBtn = document.getElementById('next-page-btn');

            function updatePaginationButtons() {
                const activeBtn = pageNumbers.querySelector('.pagination-btn.active');
                const allBtns = pageNumbers.querySelectorAll('.pagination-btn');
                const activeIndex = Array.from(allBtns).indexOf(activeBtn);

                prevBtn.disabled = activeIndex === 0;
                nextBtn.disabled = activeIndex === allBtns.length - 1;
            }

            // Scroll page numbers horizontally when clicking prev/next
            prevBtn.addEventListener('click', function() {
                const activeBtn = pageNumbers.querySelector('.pagination-btn.active');
                const allBtns = pageNumbers.querySelectorAll('.pagination-btn');
                const activeIndex = Array.from(allBtns).indexOf(activeBtn);

                if (activeIndex > 0) {
                    allBtns[activeIndex].classList.remove('active');
                    allBtns[activeIndex - 1].classList.add('active');
                    allBtns[activeIndex - 1].scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center'
                    });
                    updatePaginationButtons();
                    // TODO: Fetch new data for the selected page
                }
            });

            nextBtn.addEventListener('click', function() {
                const activeBtn = pageNumbers.querySelector('.pagination-btn.active');
                const allBtns = pageNumbers.querySelectorAll('.pagination-btn');
                const activeIndex = Array.from(allBtns).indexOf(activeBtn);

                if (activeIndex < allBtns.length - 1) {
                    allBtns[activeIndex].classList.remove('active');
                    allBtns[activeIndex + 1].classList.add('active');
                    allBtns[activeIndex + 1].scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center'
                    });
                    updatePaginationButtons();
                    // TODO: Fetch new data for the selected page
                }
            });

            // Clicking a page number button
            pageNumbers.addEventListener('click', function(e) {
                if (e.target.classList.contains('pagination-btn')) {
                    pageNumbers.querySelectorAll('.pagination-btn').forEach(btn => btn.classList.remove('active'));
                    e.target.classList.add('active');
                    e.target.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center'
                    });
                    updatePaginationButtons();
                    // TODO: Fetch new data for the selected page
                }
            });

            function resetPagination(totalPages, activeIndex = 0) {
                const pageNumbers = document.getElementById('pageNumbers');
                pageNumbers.innerHTML = ''; // Clear existing buttons

                for (let i = 0; i < totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.value = i * 10;
                    btn.className = 'pagination-btn';
                    btn.textContent = i + 1;
                    if (i === activeIndex) btn.classList.add('active');
                    pageNumbers.appendChild(btn);
                }
            }

            function fetchStudents({
                offset = 0,
                fromFilter = false
            }) {
                // Get filter values
                const search = document.getElementById('searchInput').value;
                const status = document.getElementById('statusFilter').value;
                const sort = document.getElementById('sortBy').value;

                // If coming from filter, always reset offset to 0
                if (fromFilter) offset = 0;

                // Fetch data from API

                const url = ROOT + `/StudentController/students?offset=${offset}&search=${encodeURIComponent(search)}&status=${status}&sort=${sort}`;
                fetch(url)
                    .then(res => res.json())
                    .then(data => {

                        console.log(data);
                        let results = data.orders || [];

                        updateTable(results);
                        if (fromFilter) {
                            resetPagination(data.totalPageNumbers, 0);
                        }
                        // ...update table code here...
                    });
            }

            // Filter change events
            document.getElementById('searchInput').addEventListener('input', () => fetchStudents({
                fromFilter: true
            }));
            document.getElementById('statusFilter').addEventListener('change', () => fetchStudents({
                fromFilter: true
            }));
            document.getElementById('sortBy').addEventListener('change', () => fetchStudents({
                fromFilter: true
            }));

            // Pagination button click
            document.getElementById('pageNumbers').addEventListener('click', function(e) {
                if (e.target.classList.contains('pagination-btn')) {
                    const offset = parseInt(e.target.value, 10);
                    fetchStudents({
                        offset,
                        fromFilter: false
                    });
                }
            });


            function updateTable(data) {
                const tbody = document.querySelector('.students-table tbody');
                // Fade out
                tbody.style.opacity = 0;

                setTimeout(() => {
                    tbody.innerHTML = ''; // Clear old rows

                    data.forEach(student => {
                        const tr = document.createElement('tr');
                        tr.dataset.studentId = student.id;
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
                <td>${student.reg_no}</td>
                <td><span class="department-badge dept-cs">Computer Science</span></td>
                 <td>3rd Year</td>
                <td><span class="status-badge status-${student.status}">${student.status}</span></td>
                <td>${student.total_orders}</td>
                <td>Jan 15, 2021</td>
                <td>
                    <div class="student-actions">
                        <div data-student-id="${student.id}" data-modal-target="#view-profile-modal" class="student-action-btn view-btn">View Profile</div>
                      
                    </div>
                </td>

            `;
                        tbody.appendChild(tr);
                    });

                    // Fade in
                    tbody.style.transition = 'opacity 0.3s';
                    tbody.style.opacity = 1;
                }, 200); // Wait for fade out
            }


            updatePaginationButtons();
        });

        viewStudentProfile();

        function viewStudentProfile() {
            const tbody = document.querySelector('.students-table tbody');
            const modal = document.getElementById('view-profile-modal');

            tbody.addEventListener('click', function(e) {
                if (e.target.classList.contains('view-btn')) {
                    let btn = e.target;
                    let studentId = btn.dataset.studentId;
                    console.log("View profile for student ID:", studentId);
                    let url = ROOT + '/StudentController/student/' + studentId;

                    fetch(url)
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            if (data.student) {
                                const student = data.student;
                                console.log(data);
                                setViewStudentProfileModalData(student, modal);
                            } else {
                                alert('Student data not found.');
                            }
                        })
                        .catch(err => {
                            console.error('Error fetching student data:', err);
                            alert('Error fetching student data.');
                        });
                }
            })
        }

        function setViewStudentProfileModalData(student, modal) {
            document.getElementById('profile-id').textContent = student.id;
            document.getElementById('profile-name').textContent = student.student_name;
            document.getElementById('profile-email').textContent = student.email;
            document.getElementById('profile-phone').textContent = student.phone || 'N/A';
            document.getElementById('profile-department').textContent = student.department || 'N/A';
            document.getElementById('profile-year').textContent = student.year || 'N/A';
            const statusBadge = document.getElementById('profile-status');
            statusBadge.textContent = student.status;
            statusBadge.className = 'status-badge status-' + student.status;
            document.getElementById('profile-address').textContent = student.address || 'N/A';
            document.getElementById('profile-joined').textContent = new Date(student.created_at).toLocaleDateString();
            document.getElementById('profile-orders').textContent = student.total_orders || 0;
            let statusIndicatorBtn = modal.querySelector('.status-indicator');
            statusIndicatorBtn.dataset.studentId = student.id;
            statusIndicatorBtn.dataset.status = student.status;

            // Update button text and style based on status

            if (student.status === 'pending') {
                statusIndicatorBtn.textContent = 'Verify Student';
                statusIndicatorBtn.classList.remove('btn-danger', 'btn-success');
                statusIndicatorBtn.classList.add('btn-success');
            } else if (student.status === 'suspended') {
                statusIndicatorBtn.textContent = '🚫 Reactivate Profile';
                statusIndicatorBtn.classList.remove('btn-danger');
                statusIndicatorBtn.classList.add('btn-success');
            } else {
                statusIndicatorBtn.textContent = '🚫 Suspend Profile';
                statusIndicatorBtn.classList.remove('btn-success');
                statusIndicatorBtn.classList.add('btn-danger');
            }

            // Open modal
            modal.classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        let statusIndicatorBtn = document.querySelector('.status-indicator');
        statusIndicatorBtn.addEventListener('click', function() {
            let studentId = this.dataset.studentId;
            let currentStatus = this.dataset.status;

            console.log("Toggling status for student ID:", studentId, "Current status:", currentStatus);

            let newStatus = '';
            let studentTr = document.querySelector(`tr[data-student-id='${studentId}']`);

            let profileStatusBadge = document.getElementById('profile-status');
            if (currentStatus === 'suspended' || currentStatus === 'pending') {
                // Reactivate
                newStatus = 'verified';
                this.textContent = '🚫 Suspend Profile';
                this.dataset.status = 'verified';
                changeStudentStatusInViewModal(newStatus)
                changeStudentStatusInTable(studentTr, newStatus);
                this.classList.remove('btn-success');
                this.classList.add('btn-danger');
            } else {
                // Suspend
                newStatus = 'suspended';
                this.textContent = 'Reactivate Profile';
                this.dataset.status = 'suspended';
                changeStudentStatusInViewModal(newStatus)
                changeStudentStatusInTable(studentTr, newStatus);
                this.classList.remove('btn-danger');
                this.classList.add('btn-success');
            }
            console.log("New status:", newStatus);

            toggleStudentStatus(studentId, newStatus);

        });

        function toggleStudentStatus(studentId, status) {
            const url = ROOT + '/StudentController/toggleStudentStatus/' + studentId;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(res => res.text())
                .then(data => {
                    summaryCardsUpdate();
                    return data.success === true;
                })
                .catch(err => {
                    console.error('Error toggling student status:', err);
                    alert('Error in Changing  student status.');
                    return false;
                });


        }


        function changeStudentStatusInViewModal(status) {
            const statusBadge = document.getElementById('profile-status');
            statusBadge.textContent = status;
            statusBadge.className = 'status-badge';
            statusBadge.classList.add('status-' + status);
        }

        function changeStudentStatusInTable(row, status) {
            let statusBadge = row.querySelector('.status-badge');
            statusBadge.textContent = status;

            statusBadge.classList.remove('status-verified', 'status-pending', 'status-suspended');
            statusBadge.classList.add('status-' + status);

        }

        function summaryCardsUpdate() {
            let url = ROOT + '/StudentController/getStudentsCount';
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    document.querySelector('.summary-card.total .summary-value').textContent = data.count;
                    //document.querySelector('.summary-card.active .summary-value').textContent = data.verifiedCount;
                    document.querySelector('.summary-card.pending .summary-value').textContent = data.pending;
                    document.querySelector('.summary-card.verified .summary-value').textContent = data.verified;
                    document.querySelector('.summary-card.suspended .summary-value').textContent = data.suspended

                })
                .catch(err => {
                    console.error('Error fetching students count:', err);
                });
        }
    </script>
</body>

</html>