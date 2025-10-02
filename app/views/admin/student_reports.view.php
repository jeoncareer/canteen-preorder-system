<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Reports - Admin Dashboard</title>
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

        /* Email-style Layout */
        .reports-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 600px;
        }

        /* Sidebar (Email List) */
        .reports-sidebar {
            background: #f8f9fa;
            border-right: 1px solid #e1e5e9;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #e1e5e9;
            background: white;
        }

        .sidebar-header h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 1.2rem;
        }

        .filter-tabs {
            display: flex;
            gap: 5px;
        }

        .filter-tab {
            padding: 8px 16px;
            border: none;
            background: #f8f9fa;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
        }

        .filter-tab.active {
            background: #4a90e2;
            color: white;
        }

        .filter-tab:hover:not(.active) {
            background: #e9ecef;
        }

        /* Reports List */
        .reports-list {
            flex: 1;
            overflow-y: auto;
        }

        .report-item {
            padding: 15px 20px;
            border-bottom: 1px solid #e1e5e9;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .report-item:hover {
            background: #e3f2fd;
        }

        .report-item.active {
            background: #e3f2fd;
            border-right: 3px solid #4a90e2;
        }

        .report-item.unread {
            background: #fff3cd;
            font-weight: 600;
        }

        .report-item.unread::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background: #ffc107;
            border-radius: 50%;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .student-name {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .report-time {
            font-size: 12px;
            color: #666;
        }

        .report-subject {
            font-size: 13px;
            color: #333;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .report-preview {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .priority-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .priority-urgent {
            background: #dc3545;
        }

        .priority-high {
            background: #fd7e14;
        }

        .priority-medium {
            background: #ffc107;
        }

        .priority-low {
            background: #28a745;
        }

        /* Main Content Area */
        .reports-content {
            display: flex;
            flex-direction: column;
        }

        .content-header {
            padding: 20px;
            border-bottom: 1px solid #e1e5e9;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-title {
            margin: 0;
            color: #333;
            font-size: 1.3rem;
        }

        .content-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-reply {
            background: #4a90e2;
            color: white;
        }

        .btn-resolve {
            background: #28a745;
            color: white;
        }

        .btn-archive {
            background: #6c757d;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        /* Email Content */
        .email-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .email-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e1e5e9;
        }

        .email-from {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .student-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #4a90e2;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }

        .student-details h4 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }

        .student-details p {
            margin: 2px 0 0 0;
            color: #666;
            font-size: 14px;
        }

        .email-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .meta-item {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .meta-label {
            font-weight: 600;
            color: #333;
        }

        .meta-value {
            color: #666;
        }

        .priority-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .priority-badge.urgent {
            background: #dc3545;
            color: white;
        }

        .priority-badge.high {
            background: #fd7e14;
            color: white;
        }

        .priority-badge.medium {
            background: #ffc107;
            color: #212529;
        }

        .priority-badge.low {
            background: #28a745;
            color: white;
        }

        .category-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .category-food {
            background: #ffe6e6;
            color: #dc3545;
        }

        .category-order {
            background: #fff3cd;
            color: #856404;
        }

        .category-payment {
            background: #d4edda;
            color: #155724;
        }

        .category-service {
            background: #cce5ff;
            color: #004085;
        }

        .category-technical {
            background: #f8d7da;
            color: #721c24;
        }

        .category-suggestion {
            background: #e2e3e5;
            color: #383d41;
        }

        .email-body {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            line-height: 1.6;
            color: #333;
            margin-top: 20px;
        }

        /* Reply Section */
        .reply-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
        }

        .reply-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .reply-form h4 {
            margin: 0 0 15px 0;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

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
            min-height: 120px;
        }

        .reply-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-send {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-draft {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e1e5e9;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Empty State */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #666;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .empty-state p {
            margin: 0;
            font-size: 14px;
        }

        /* Statistics */
        .reports-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-left: 4px solid;
        }

        .stat-card.unread {
            border-left-color: #ffc107;
        }

        .stat-card.urgent {
            border-left-color: #dc3545;
        }

        .stat-card.resolved {
            border-left-color: #28a745;
        }

        .stat-card.total {
            border-left-color: #4a90e2;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }

        /* Message Thread Styles */
        .message-thread {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .message-item {
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
        }

        .student-message {
            background: #f8fafc;
            border-left: 4px solid #4a90e2;
            margin-right: 2rem;
        }

        .admin-message {
            background: #f0f9ff;
            border-left: 4px solid #10b981;
            margin-left: 2rem;
            border: 1px solid #e0f2fe;
        }

        .message-header {
            margin-bottom: 1rem;
        }

        .message-from {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .message-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }

        .admin-avatar {
            background: #10b981;
            color: white;
        }

        .message-details {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .message-details strong {
            font-size: 0.95rem;
            color: #1f2937;
        }

        .message-time {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .admin-badge {
            background: #10b981;
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-badge.resolved {
            background: #059669;
        }

        .message-content {
            line-height: 1.6;
            color: #374151;
        }

        .message-content p {
            margin-bottom: 1rem;
        }

        .message-content ul,
        .message-content ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .message-content li {
            margin-bottom: 0.5rem;
        }

        .resolution-summary {
            background: #ecfdf5;
            border: 1px solid #d1fae5;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.9rem;
            line-height: 1.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .reports-container {
                grid-template-columns: 1fr;
            }

            .reports-sidebar {
                display: none;
            }

            .reports-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .student-message {
                margin-right: 0.5rem;
            }

            .admin-message {
                margin-left: 0.5rem;
            }

            .message-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
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
        <?php $page = "student_reports";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Welcome Header -->
            <div class="welcome-header">
                <h1>Student Reports & Messages 📧</h1>
                <p>Manage student concerns, feedback, and support requests</p>
            </div>

            <!-- Statistics -->
            <div class="reports-stats">
                <div class="stat-card unread">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Unread</div>
                </div>
                <div class="stat-card urgent">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Urgent</div>
                </div>
                <div class="stat-card resolved">
                    <div class="stat-number">45</div>
                    <div class="stat-label">Resolved</div>
                </div>
                <div class="stat-card total">
                    <div class="stat-number">89</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>

            <!-- Email-style Interface -->
            <div class="reports-container">
                <!-- Reports Sidebar (Email List) -->
                <div class="reports-sidebar">
                    <div class="sidebar-header">
                        <h3>Student Messages</h3>
                        <div class="filter-tabs">
                            <button class="filter-tab active" onclick="filterReports('all')">All</button>
                            <button class="filter-tab" onclick="filterReports('unread')">Unread</button>
                            <button class="filter-tab" onclick="filterReports('urgent')">Urgent</button>
                        </div>
                    </div>

                    <div class="reports-list">
                        <!-- Report Item 1 -->
                        <div class="report-item unread active" onclick="selectReport(1)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-urgent"></span>
                                    Emma Thompson
                                </div>
                                <div class="report-time">2 min ago</div>
                            </div>
                            <div class="report-subject">Food Poisoning Complaint</div>
                            <div class="report-preview">
                                I experienced severe food poisoning after eating the chicken curry from the main cafeteria yesterday. Several other students also reported similar symptoms...
                            </div>
                        </div>

                        <!-- Report Item 2 -->
                        <div class="report-item unread" onclick="selectReport(2)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-high"></span>
                                    David Kumar
                                </div>
                                <div class="report-time">15 min ago</div>
                            </div>
                            <div class="report-subject">Order Payment Issue</div>
                            <div class="report-preview">
                                My payment was deducted but the order was not placed. Transaction ID: TXN123456789. Please help me resolve this issue...
                            </div>
                        </div>

                        <!-- Report Item 3 -->
                        <div class="report-item" onclick="selectReport(3)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-medium"></span>
                                    Lisa Chen
                                </div>
                                <div class="report-time">1 hour ago</div>
                            </div>
                            <div class="report-subject">Suggestion for Menu</div>
                            <div class="report-preview">
                                Could you please add more vegetarian options to the menu? Many students are requesting healthier food choices...
                            </div>
                        </div>

                        <!-- Report Item 4 -->
                        <div class="report-item" onclick="selectReport(4)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-high"></span>
                                    Robert Singh
                                </div>
                                <div class="report-time">2 hours ago</div>
                            </div>
                            <div class="report-subject">App Technical Issue</div>
                            <div class="report-preview">
                                The mobile app keeps crashing when I try to place an order. This has been happening for the past 3 days...
                            </div>
                        </div>

                        <!-- Report Item 5 -->
                        <div class="report-item unread" onclick="selectReport(5)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-medium"></span>
                                    Maria Garcia
                                </div>
                                <div class="report-time">3 hours ago</div>
                            </div>
                            <div class="report-subject">Canteen Service Feedback</div>
                            <div class="report-preview">
                                The staff at the library canteen were very rude today. I would like to report this incident...
                            </div>
                        </div>

                        <!-- Report Item 6 -->
                        <div class="report-item" onclick="selectReport(6)">
                            <div class="report-header">
                                <div class="student-name">
                                    <span class="priority-indicator priority-low"></span>
                                    Alex Johnson
                                </div>
                                <div class="report-time">1 day ago</div>
                            </div>
                            <div class="report-subject">Extended Hours Request</div>
                            <div class="report-preview">
                                During exam periods, could the canteen stay open later? Many students study late and need food options...
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="reports-content">
                    <div class="content-header">
                        <h3 class="content-title">Food Poisoning Complaint</h3>
                        <div class="content-actions">
                            <button class="action-btn btn-reply">📧 Reply</button>
                            <button class="action-btn btn-resolve">✅ Resolve</button>
                            <button class="action-btn btn-archive">📁 Archive</button>
                            <button class="action-btn btn-delete">🗑️ Delete</button>
                        </div>
                    </div>

                    <div class="email-content">
                        <div class="email-header">
                            <div class="email-from">
                                <div class="student-avatar">ET</div>
                                <div class="student-details">
                                    <h4>Emma Thompson</h4>
                                    <p>emma.thompson@college.edu • CS2021001</p>
                                </div>
                            </div>

                            <div class="email-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Category:</span>
                                    <span class="category-badge category-food">Food Quality</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Priority:</span>
                                    <span class="priority-badge urgent">Urgent</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Date:</span>
                                    <span class="meta-value">March 15, 2024 - 2:30 PM</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Status:</span>
                                    <span class="meta-value">Unread</span>
                                </div>
                            </div>
                        </div>

                        <!-- Original Student Message -->
                        <div class="email-body">
                            <div class="message-thread">
                                <!-- Student Message -->
                                <div class="message-item student-message">
                                    <div class="message-header">
                                        <div class="message-from">
                                            <div class="message-avatar student-avatar">ET</div>
                                            <div class="message-details">
                                                <strong>Emma Thompson</strong>
                                                <span class="message-time">March 15, 2024 - 2:30 PM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p><strong>Subject:</strong> Food Poisoning Complaint</p>

                                        <p>Dear Admin,</p>

                                        <p>I am writing to report a serious food safety issue that occurred yesterday at the main cafeteria. I ordered the chicken curry meal around 1:00 PM and consumed it immediately.</p>

                                        <p>Within 2-3 hours of eating, I started experiencing severe symptoms including:</p>
                                        <ul>
                                            <li>Nausea and vomiting</li>
                                            <li>Stomach cramps</li>
                                            <li>Diarrhea</li>
                                            <li>Fever</li>
                                        </ul>

                                        <p>I had to visit the college medical center and was diagnosed with food poisoning. The doctor confirmed that it was likely caused by contaminated food.</p>

                                        <p>What's more concerning is that I've spoken to at least 4 other students who ate from the same cafeteria yesterday and experienced similar symptoms. This suggests a serious food safety issue that needs immediate attention.</p>

                                        <p>I request you to:</p>
                                        <ol>
                                            <li>Investigate the food preparation and storage practices at the main cafeteria</li>
                                            <li>Check if other students have reported similar issues</li>
                                            <li>Take necessary action to prevent this from happening again</li>
                                            <li>Consider temporary closure of the cafeteria until the issue is resolved</li>
                                        </ol>

                                        <p>I have attached my medical report for your reference. Please take this matter seriously as it affects the health and safety of all students.</p>

                                        <p>I look forward to your prompt response and action on this matter.</p>

                                        <p>Best regards,<br>
                                            Emma Thompson<br>
                                            Student ID: CS2021001<br>
                                            Phone: +1 (555) 123-4567</p>
                                    </div>
                                </div>

                                <!-- Admin Reply 1 -->
                                <div class="message-item admin-message">
                                    <div class="message-header">
                                        <div class="message-from">
                                            <div class="message-avatar admin-avatar">AD</div>
                                            <div class="message-details">
                                                <strong>College Administration</strong>
                                                <span class="message-time">March 15, 2024 - 4:15 PM</span>
                                                <span class="admin-badge">Admin Reply</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p>Dear Emma,</p>

                                        <p>Thank you for bringing this serious matter to our immediate attention. We sincerely apologize for the health issues you experienced and take full responsibility for this incident.</p>

                                        <p><strong>Immediate Actions Taken:</strong></p>
                                        <ul>
                                            <li>✅ Main cafeteria has been temporarily closed for investigation</li>
                                            <li>✅ All chicken curry batches from March 14th have been disposed of</li>
                                            <li>✅ Kitchen staff and food preparation areas are being thoroughly sanitized</li>
                                            <li>✅ We are contacting all students who may have been affected</li>
                                        </ul>

                                        <p><strong>Investigation Status:</strong> Our food safety team is conducting a comprehensive review of:</p>
                                        <ul>
                                            <li>Food storage temperatures and procedures</li>
                                            <li>Kitchen hygiene protocols</li>
                                            <li>Staff training records</li>
                                            <li>Supplier quality certifications</li>
                                        </ul>

                                        <p>We will cover any medical expenses related to this incident. Please submit your medical bills to the administration office.</p>

                                        <p>We expect to complete our investigation within 48 hours and will keep you updated on our findings and corrective measures.</p>

                                        <p>Once again, we deeply apologize for this incident and appreciate your patience as we work to resolve this matter.</p>

                                        <p>Best regards,<br>
                                            Dr. Sarah Johnson<br>
                                            Dean of Student Affairs<br>
                                            Phone: +1 (555) 987-6543<br>
                                            Email: admin@college.edu</p>
                                    </div>
                                </div>

                                <!-- Student Follow-up -->
                                <div class="message-item student-message">
                                    <div class="message-header">
                                        <div class="message-from">
                                            <div class="message-avatar student-avatar">ET</div>
                                            <div class="message-details">
                                                <strong>Emma Thompson</strong>
                                                <span class="message-time">March 16, 2024 - 10:30 AM</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p>Dear Dr. Johnson,</p>

                                        <p>Thank you for your prompt response and the immediate actions taken. I appreciate the seriousness with which you've handled this matter.</p>

                                        <p>I'm feeling much better now, and I've submitted my medical bills to the administration office as requested.</p>

                                        <p>I wanted to update you that two more students (David Chen - CS2021045 and Lisa Park - CS2021078) have also reported similar symptoms after eating from the main cafeteria on March 14th.</p>

                                        <p>I look forward to hearing about the investigation results and the measures being implemented to prevent future incidents.</p>

                                        <p>Thank you again for your quick action.</p>

                                        <p>Best regards,<br>
                                            Emma Thompson</p>
                                    </div>
                                </div>

                                <!-- Final Admin Reply -->
                                <div class="message-item admin-message">
                                    <div class="message-header">
                                        <div class="message-from">
                                            <div class="message-avatar admin-avatar">AD</div>
                                            <div class="message-details">
                                                <strong>College Administration</strong>
                                                <span class="message-time">March 17, 2024 - 2:00 PM</span>
                                                <span class="admin-badge resolved">Case Resolved</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p>Dear Emma,</p>

                                        <p>Thank you for the additional information and for your patience during our investigation.</p>

                                        <p><strong>Investigation Results:</strong></p>
                                        <p>We identified the root cause as a refrigeration malfunction that occurred on March 13th evening, which compromised the chicken storage temperature. The issue went undetected until your report.</p>

                                        <p><strong>Corrective Measures Implemented:</strong></p>
                                        <ul>
                                            <li>✅ All refrigeration units have been serviced and equipped with temperature monitoring alarms</li>
                                            <li>✅ Enhanced food safety training completed for all kitchen staff</li>
                                            <li>✅ New food safety protocols implemented with hourly temperature checks</li>
                                            <li>✅ Third-party food safety audit scheduled monthly</li>
                                            <li>✅ Student feedback system improved for faster reporting</li>
                                        </ul>

                                        <p><strong>Medical Expenses:</strong> All medical bills for affected students have been processed and reimbursed.</p>

                                        <p>The main cafeteria has reopened with enhanced safety measures. We've also reached out to David Chen and Lisa Park to ensure they receive proper care.</p>

                                        <p>We truly appreciate your responsible reporting, which helped us prevent a larger health crisis. As a token of our appreciation, we're providing you with a $100 dining credit.</p>

                                        <p>Please don't hesitate to contact us if you have any further concerns.</p>

                                        <p>Best regards,<br>
                                            Dr. Sarah Johnson<br>
                                            Dean of Student Affairs</p>

                                        <div class="resolution-summary">
                                            <strong>Case Status:</strong> ✅ Resolved<br>
                                            <strong>Resolution Date:</strong> March 17, 2024<br>
                                            <strong>Follow-up Required:</strong> None
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reply Section -->
                        <div class="reply-section">
                            <div class="reply-form">
                                <h4>📧 Reply to Student</h4>

                                <div class="form-group">
                                    <label for="replyStatus">Update Status</label>
                                    <select id="replyStatus">
                                        <option value="investigating">Under Investigation</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="resolved">Resolved</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="replyMessage">Response Message</label>
                                    <textarea id="replyMessage" placeholder="Type your response to the student...">Dear Emma,

Thank you for bringing this serious matter to our attention. We take food safety very seriously and are immediately investigating this incident.

We have:
1. Temporarily suspended the chicken curry from our menu
2. Initiated a thorough inspection of our food preparation and storage facilities
3. Contacted other students who may have been affected
4. Arranged for additional food safety training for our kitchen staff

We sincerely apologize for this incident and any inconvenience caused. Your health and safety are our top priority.

We will keep you updated on our investigation and the steps we're taking to prevent such incidents in the future.

Best regards,
College Administration</textarea>
                                </div>

                                <div class="reply-actions">
                                    <button class="btn-draft">💾 Save Draft</button>
                                    <button class="btn-send">📧 Send Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectReport(id) {
            // Remove active class from all items
            document.querySelectorAll('.report-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to selected item
            event.currentTarget.classList.add('active');

            // Remove unread status
            event.currentTarget.classList.remove('unread');

            // Update content based on selected report
            updateReportContent(id);
        }

        function updateReportContent(id) {
            // This would normally fetch content from server
            // For demo, we'll just update the title
            const titles = {
                1: 'Food Poisoning Complaint',
                2: 'Order Payment Issue',
                3: 'Suggestion for Menu',
                4: 'App Technical Issue',
                5: 'Canteen Service Feedback',
                6: 'Extended Hours Request'
            };

            document.querySelector('.content-title').textContent = titles[id] || 'Select a report';
        }

        function filterReports(filter) {
            // Remove active class from all tabs
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Add active class to clicked tab
            event.currentTarget.classList.add('active');

            // Filter logic would go here
            console.log('Filtering by:', filter);
        }

        // Action buttons
        document.querySelector('.btn-reply').addEventListener('click', function() {
            document.querySelector('.reply-section').scrollIntoView({
                behavior: 'smooth'
            });
        });

        document.querySelector('.btn-resolve').addEventListener('click', function() {
            if (confirm('Mark this report as resolved?')) {
                alert('Report marked as resolved!');
            }
        });

        document.querySelector('.btn-archive').addEventListener('click', function() {
            if (confirm('Archive this report?')) {
                alert('Report archived!');
            }
        });

        document.querySelector('.btn-delete').addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this report? This action cannot be undone.')) {
                alert('Report deleted!');
            }
        });

        document.querySelector('.btn-send').addEventListener('click', function() {
            const message = document.getElementById('replyMessage').value;
            const status = document.getElementById('replyStatus').value;

            if (message.trim()) {
                alert('Reply sent successfully!');
                // Clear form
                document.getElementById('replyMessage').value = '';
            } else {
                alert('Please enter a response message.');
            }
        });

        document.querySelector('.btn-draft').addEventListener('click', function() {
            alert('Draft saved!');
        });
    </script>
</body>

</html>