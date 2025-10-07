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

        [hidden] {
            display: none !important;
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

    <script>
        let ROOT = "<?= ROOT ?>";
        let college_id = "<?= $_SESSION['COLLEGE']->id ?>";
    </script>
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
                <div class="stat-card open">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Open</div>
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

                        <?php if (isset($conversations)): ?>
                            <?php foreach ($conversations as $conversation): ?>
                                <div class="report-item <?= !$conversation->is_read_by_admin ? 'unread' : '' ?> " onclick="selectReport(<?= $conversation->id ?>)">
                                    <div class="report-header">
                                        <div class="student-name">
                                            <span class="priority-indicator "></span>
                                            <?= $conversation->student->student_name ?>
                                        </div>
                                        <div class="report-time"><?= timeAgoOrDate($conversation->created_at, false, '1 day') ?></div>
                                    </div>
                                    <div class="report-subject"><?= ucwords($conversation->subject) ?></div>
                                    <div class="report-preview">
                                        <?= $conversation->messages[0]->message_text  ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>







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
                                    <span class="category-badge">Food Quality</span>
                                </div>

                                <div class="meta-item">
                                    <span class="meta-label">Date:</span>
                                    <span class="meta-value date">March 15, 2024 - 2:30 PM</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Status:</span>
                                    <span class="meta-value status">Unread</span>
                                </div>
                            </div>
                        </div>

                        <!-- Original Student Message -->
                        <div class="email-body">
                            <div class="message-thread">

                            </div>
                        </div>

                        <!-- Reply Section -->
                        <div class="reply-section">
                            <div class="reply-form">
                                <h4>📧 Reply to Student</h4>

                                <div class="form-group">
                                    <label for="replyStatus">Update Status</label>
                                    <select name="status" id="replyStatus">
                                        <option value="open">Open</option>

                                        <option value="resolved">Resolved</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="replyMessage">Response Message</label>
                                    <textarea name="message" id="replyMessage" placeholder="Type your response to the student..."></textarea>
                                </div>

                                <div class="reply-actions">
                                    <button class="btn-draft">💾 Save Draft</button>
                                    <button id="adminMessageSend" class="btn-send">📧 Send Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>assets/js/functions.js"></script>
    <script>
        updateReportStats();
        let currentConversationId = null;
        const emailHeader = document.querySelector('.email-header');
        const contentHeader = document.querySelector('.content-header');
        const replySection = document.querySelector('.reply-section');

        emailHeader.hidden = true;
        contentHeader.hidden = true;
        replySection.hidden = true;

        function selectReport(id) {
            // Remove active class from all items
            document.querySelectorAll('.report-item').forEach(item => {
                item.classList.remove('active');
            });

            if (emailHeader.hidden) {
                emailHeader.hidden = false;
            }

            // if (contentHeader.hidden) {
            //     contentHeader.hidden = false;
            // }

            if (replySection.hidden) {
                replySection.hidden = false;
            }


            // Add active class to selected item
            event.currentTarget.classList.add('active');

            // Remove unread status
            event.currentTarget.classList.remove('unread');

            // Update content based on selected report
            updateReportContent(id);
            const messageThread = document.querySelector('.message-thread');
            let url = ROOT + 'AdminMessagesController/conversationFetch/' + id;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    let conversation = data.conversation;
                    currentConversationId = conversation.id;
                    console.log(currentConversationId);
                    let messages = conversation.messages;

                    messageThread.innerHTML = '';
                    console.log(conversation);
                    messages.forEach(message => {

                        createMessageItem(conversation, message, messageThread);
                        setEmailHeader(conversation);

                    })



                })
        }


        const replyStatus = document.querySelector('#replyStatus');

        replyStatus.addEventListener('change', e => {
            let status = replyStatus.value;

            let url = ROOT + 'AdminMessagesController/updateStatus/' + currentConversationId;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(res => res.json())
                .then(data => {

                    document.querySelector('.email-meta .meta-item .status').textContent = status;
                })

            updateReportStats();

        })




        function createMessageItem(conversation, message, messageThread) {
            let messageItem = document.createElement('div');
            messageItem.classList.add('message-item');
            messageItem.classList.add(message.sender_type + '-message');
            messageItem.innerHTML = `
                                          <div class="message-header">
                                        <div class="message-from">
                                            <div class="message-avatar student-avatar">ET</div>
                                            <div class="message-details">
                                                <strong>${conversation.student.student_name}</strong>
                                                <span class="message-time">${timeAgoOrDate(message.created_at,false,'1 minutes')}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p><strong>Subject:</strong> ${formatLabel(conversation.subject)}</p>

                    ${message.message_text}
                                    </div>

                        
                        `;

            messageThread.prepend(messageItem);
        }




        function setEmailHeader(conversation) {
            const emailHeader = document.querySelector('.email-header');
            emailHeader.querySelector('.student-avatar').textContent = getInitials(conversation.student.student_name);
            emailHeader.querySelector('.student-details h4').textContent = formatLabel(conversation.student.student_name);
            emailHeader.querySelector('.student-details p').textContent = conversation.student.email;
            emailHeader.querySelector('.email-meta .meta-item .category-badge').textContent = formatLabel(conversation.subject);
            emailHeader.querySelector('.email-meta .meta-item .date').textContent = timeAgoOrDate(conversation.created_at, false, '1 day');
            emailHeader.querySelector('.email-meta .meta-item .status').textContent = conversation.status;
        }

        function updateReportStats() {

            fetch(ROOT + 'AdminMessagesController/getMessageStats/' + college_id)
                .then(res => res.json())
                .then(data => {
                    document.querySelector('.stat-card.open .stat-number').textContent = data.open_conversations;
                    document.querySelector('.stat-card.total .stat-number').textContent = data.total_conversations;
                    document.querySelector('.stat-card.resolved .stat-number').textContent = data.closed_conversations;
                })
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
                let url = ROOT + "AdminMessagesController/reply/" + currentConversationId;
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            reply_message: message,
                            status: status
                        })
                    }).then(res => res.json())
                    .then(data => {
                        location.reload();
                    })
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