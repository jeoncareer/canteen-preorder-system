<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses Management - Admin Dashboard</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <style>
        /* Welcome Header Styling */
        .welcome-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .welcome-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .welcome-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-color: #4a90e2;
        }

        .action-card-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }

        .action-card h3 {
            margin: 0 0 8px 0;
            color: #333;
            font-size: 1.3rem;
        }

        .action-card p {
            margin: 0;
            color: #666;
            font-size: 0.95rem;
        }

        /* Stats Cards */
        .courses-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
        }

        .stat-card.total {
            border-left-color: #4a90e2;
        }

        .stat-card.active {
            border-left-color: #28a745;
        }

        .stat-card.departments {
            border-left-color: #fd7e14;
        }

        .stat-card.students {
            border-left-color: #6f42c1;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Filters */
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .filter-select,
        .filter-input {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            background: white;
            font-size: 14px;
        }

        .filter-btn {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Courses Table */
        .courses-table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .courses-table {
            width: 100%;
            border-collapse: collapse;
        }

        .courses-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #e1e5e9;
            color: #333;
        }

        .courses-table td {
            padding: 15px;
            border-bottom: 1px solid #e1e5e9;
            vertical-align: middle;
        }

        .courses-table tr:hover {
            background: #f8f9fa;
        }

        .course-info {
            display: flex;
            flex-direction: column;
        }

        .course-name {
            font-weight: 600;
            margin-bottom: 4px;
            color: #333;
        }

        .course-code {
            font-size: 12px;
            color: #666;
            font-family: monospace;
        }

        .department-tag {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .dept-engineering {
            background: #e3f2fd;
            color: #1976d2;
        }

        .dept-business {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .dept-science {
            background: #e8f5e8;
            color: #388e3c;
        }

        .dept-arts {
            background: #fff3e0;
            color: #f57c00;
        }

        .duration-badge {
            padding: 4px 8px;
            background: #f8f9fa;
            border-radius: 6px;
            font-size: 12px;
            color: #666;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-edit,
        .btn-view,
        .btn-delete {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-edit {
            background: #4a90e2;
            color: white;
        }

        .btn-view {
            background: #e9ecef;
            color: #495057;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e1e5e9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .close {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: #999;
        }

        .close:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn-primary {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e1e5e9;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Pagination with Horizontal Scroll */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
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

        .page-btn {
            padding: 8px 16px;
            border: 2px solid #e1e5e9;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .page-btn.active {
            background: #4a90e2;
            color: white;
            border-color: #4a90e2;
        }

        .page-btn:hover:not(.active) {
            background: #f8f9fa;
        }

        .nav-btn {
            flex-shrink: 0;
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
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .range-dropdown:hover {
            border-color: #cbd5e1;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "courses";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Header -->
            <div class="welcome-header">
                <h1>Course Management 📚</h1>
                <p>Manage and organize all college courses and programs</p>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-card" onclick="openModal('addCourseModal')">
                    <span class="action-card-icon">➕</span>
                    <h3>Add New Course</h3>
                    <p>Create a new course or program</p>
                </div>
                <div class="action-card" onclick="openModal('addDepartmentModal')">
                    <span class="action-card-icon">🏢</span>
                    <h3>Add Department</h3>
                    <p>Create a new academic department</p>
                </div>
                <div class="action-card" onclick="exportCourses()">
                    <span class="action-card-icon">📊</span>
                    <h3>Export Data</h3>
                    <p>Download courses report</p>
                </div>
            </div>

            <!-- Statistics -->
            <div class="courses-stats">
                <div class="stat-card total">
                    <div class="stat-number">47</div>
                    <div class="stat-label">Total Courses</div>
                </div>
                <div class="stat-card active">
                    <div class="stat-number">42</div>
                    <div class="stat-label">Active Courses</div>
                </div>
                <div class="stat-card departments">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Departments</div>
                </div>
                <div class="stat-card students">
                    <div class="stat-number">2,847</div>
                    <div class="stat-label">Enrolled Students</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label>Search Courses</label>
                        <input type="text" class="filter-input" placeholder="Search by name or code...">
                    </div>
                    <div class="filter-group">
                        <label>Department</label>
                        <select class="filter-select">
                            <option value="">All Departments</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business</option>
                            <option value="science">Science</option>
                            <option value="arts">Arts & Humanities</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Duration</label>
                        <select class="filter-select">
                            <option value="">All Durations</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                            <option value="4">4 Years</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select class="filter-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Courses Table -->
            <div class="courses-table-container">
                <table class="courses-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Department</th>
                            <th>Duration</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Bachelor of Computer Science</div>
                                    <div class="course-code">CS-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-engineering">Engineering</span></td>
                            <td><span class="duration-badge">4 Years</span></td>
                            <td>342</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(1)">View</button>
                                    <button class="btn-edit" onclick="editCourse(1)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(1)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Master of Business Administration</div>
                                    <div class="course-code">MBA-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-business">Business</span></td>
                            <td><span class="duration-badge">2 Years</span></td>
                            <td>156</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(2)">View</button>
                                    <button class="btn-edit" onclick="editCourse(2)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(2)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Bachelor of Science in Physics</div>
                                    <div class="course-code">PHY-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-science">Science</span></td>
                            <td><span class="duration-badge">3 Years</span></td>
                            <td>89</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(3)">View</button>
                                    <button class="btn-edit" onclick="editCourse(3)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(3)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Bachelor of Arts in English Literature</div>
                                    <div class="course-code">ENG-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-arts">Arts & Humanities</span></td>
                            <td><span class="duration-badge">3 Years</span></td>
                            <td>124</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(4)">View</button>
                                    <button class="btn-edit" onclick="editCourse(4)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(4)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Bachelor of Engineering in Mechanical</div>
                                    <div class="course-code">ME-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-engineering">Engineering</span></td>
                            <td><span class="duration-badge">4 Years</span></td>
                            <td>278</td>
                            <td><span class="status-badge status-active">Active</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(5)">View</button>
                                    <button class="btn-edit" onclick="editCourse(5)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(5)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="course-info">
                                    <div class="course-name">Master of Science in Data Science</div>
                                    <div class="course-code">DS-001</div>
                                </div>
                            </td>
                            <td><span class="department-tag dept-science">Science</span></td>
                            <td><span class="duration-badge">2 Years</span></td>
                            <td>67</td>
                            <td><span class="status-badge status-inactive">Inactive</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" onclick="viewCourse(6)">View</button>
                                    <button class="btn-edit" onclick="editCourse(6)">Edit</button>
                                    <button class="btn-delete" onclick="deleteCourse(6)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination with Horizontal Scroll -->
            <div class="pagination">
                <button class="page-btn nav-btn" id="prevBtn">Previous</button>
                <div class="page-numbers-container">
                    <div class="page-numbers" id="pageNumbers">
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">5</button>
                        <button class="page-btn">6</button>
                        <button class="page-btn">7</button>
                        <button class="page-btn">8</button>
                        <button class="page-btn">9</button>
                        <button class="page-btn">10</button>
                        <button class="page-btn">11</button>
                        <button class="page-btn">12</button>
                        <button class="page-btn">13</button>
                        <button class="page-btn">14</button>
                        <button class="page-btn">15</button>
                    </div>
                </div>
                <button class="page-btn nav-btn" id="nextBtn">Next</button>
            </div>div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="addCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Course</h3>
                <span class="close" onclick="closeModal('addCourseModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="courseName">Course Name *</label>
                            <input type="text" id="courseName" placeholder="e.g., Bachelor of Computer Science" required>
                        </div>
                        <div class="form-group">
                            <label for="courseCode">Course Code *</label>
                            <input type="text" id="courseCode" placeholder="e.g., CS-001" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="department">Department *</label>
                            <select id="department" required>
                                <option value="">Select Department</option>
                                <option value="engineering">Engineering</option>
                                <option value="business">Business</option>
                                <option value="science">Science</option>
                                <option value="arts">Arts & Humanities</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration *</label>
                            <select id="duration" required>
                                <option value="">Select Duration</option>
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Course Description</label>
                        <textarea id="description" placeholder="Describe the course curriculum and objectives..."></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="fees">Course Fees</label>
                            <input type="number" id="fees" placeholder="Annual fees amount">
                        </div>
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select id="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="closeModal('addCourseModal')">Cancel</button>
                        <button type="submit" class="btn-primary">Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Department Modal -->
    <div id="addDepartmentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Department</h3>
                <span class="close" onclick="closeModal('addDepartmentModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="deptName">Department Name *</label>
                        <input type="text" id="deptName" placeholder="e.g., Computer Science & Engineering" required>
                    </div>

                    <div class="form-group">
                        <label for="deptCode">Department Code *</label>
                        <input type="text" id="deptCode" placeholder="e.g., CSE" required>
                    </div>

                    <div class="form-group">
                        <label for="deptHead">Department Head</label>
                        <input type="text" id="deptHead" placeholder="Head of Department name">
                    </div>

                    <div class="form-group">
                        <label for="deptDescription">Description</label>
                        <textarea id="deptDescription" placeholder="Describe the department and its focus areas..."></textarea>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="closeModal('addDepartmentModal')">Cancel</button>
                        <button type="submit" class="btn-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function viewCourse(id) {
            alert('View course details for ID: ' + id);
        }

        function editCourse(id) {
            alert('Edit course for ID: ' + id);
        }

        function deleteCourse(id) {
            if (confirm('Are you sure you want to delete this course?')) {
                alert('Course deleted: ' + id);
            }
        }

        function exportCourses() {
            alert('Exporting courses data...');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>

</html>

<script>
    // Horizontal Scrolling Pagination JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const pageNumbersContainer = document.querySelector('.page-numbers-container');
        const prevBtn = document.querySelector('#prevBtn');
        const nextBtn = document.querySelector('#nextBtn');
        const paginationBtns = document.querySelectorAll('.page-btn:not(.nav-btn)');

        let currentPage = 1;
        const totalCourses = 47;
        const itemsPerPage = 10;
        const totalPages = Math.ceil(totalCourses / itemsPerPage);

        // Handle page number clicks
        paginationBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.classList.contains('nav-btn')) {
                    // Remove active class from all buttons
                    paginationBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    currentPage = parseInt(this.textContent);
                    updatePaginationState();

                    // Scroll the clicked button into view
                    this.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            });
        });

        // Handle Previous button
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updateActivePage();
                updatePaginationState();
                scrollToActivePage();
            }
        });

        // Handle Next button
        nextBtn.addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                updateActivePage();
                updatePaginationState();
                scrollToActivePage();
            }
        });

        // Update active page button
        function updateActivePage() {
            paginationBtns.forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.textContent) === currentPage) {
                    btn.classList.add('active');
                }
            });
        }

        // Update pagination state (enable/disable prev/next buttons)
        function updatePaginationState() {
            prevBtn.disabled = currentPage === 1;
            nextBtn.disabled = currentPage >= totalPages;
        }

        // Scroll active page into view
        function scrollToActivePage() {
            const activeBtn = document.querySelector('.page-btn.active:not(.nav-btn)');
            if (activeBtn) {
                activeBtn.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        // Mouse wheel scrolling for page numbers
        if (pageNumbersContainer) {
            pageNumbersContainer.addEventListener('wheel', function(e) {
                e.preventDefault();
                this.scrollLeft += e.deltaY;
            });

            // Touch scrolling for mobile
            let isScrolling = false;
            let startX = 0;
            let scrollLeft = 0;

            pageNumbersContainer.addEventListener('touchstart', function(e) {
                isScrolling = true;
                startX = e.touches[0].pageX - this.offsetLeft;
                scrollLeft = this.scrollLeft;
            });

            pageNumbersContainer.addEventListener('touchmove', function(e) {
                if (!isScrolling) return;
                e.preventDefault();
                const x = e.touches[0].pageX - this.offsetLeft;
                const walk = (x - startX) * 2;
                this.scrollLeft = scrollLeft - walk;
            });

            pageNumbersContainer.addEventListener('touchend', function() {
                isScrolling = false;
            });
        }

        // Initialize pagination state
        updatePaginationState();
    });
</script>