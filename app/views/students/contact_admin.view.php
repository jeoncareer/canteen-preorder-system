<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <script>
        const ROOT = '<?= ROOT ?>';
    </script>
    <style>
        /* Main content with sidebar layout */
        .main-content {
            flex: 1;
            padding: 2rem;
            background: #f8fafc;
            overflow-y: auto;
        }

        .contact-container {
            max-width: 100%;
            margin: 0;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .contact-header h1 {
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .contact-header p {
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        .contact-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .contact-method {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            text-align: center;
            transition: var(--transition);
        }

        .contact-method:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .contact-method h3 {
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .contact-method p {
            color: var(--gray-600);
            margin-bottom: 1rem;
        }

        .contact-info {
            font-weight: 600;
            color: var(--primary-color);
        }

        .contact-form-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .priority-selector {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .priority-option {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            background: white;
        }

        .priority-option:hover {
            border-color: var(--primary-color);
        }

        .priority-option.selected {
            border-color: var(--primary-color);
            background: rgba(103, 126, 234, 0.1);
            color: var(--primary-color);
        }

        .priority-low {
            border-color: var(--success-color);
        }

        .priority-low.selected {
            border-color: var(--success-color);
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .priority-high {
            border-color: var(--danger-color);
        }

        .priority-high.selected {
            border-color: var(--danger-color);
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        .faq-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
        }

        .faq-item {
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 0;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            font-weight: 600;
            color: var(--gray-800);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .faq-question:hover {
            color: var(--primary-color);
        }

        .faq-answer {
            color: var(--gray-600);
            margin-top: 0.5rem;
            padding-left: 1rem;
            display: none;
        }

        .faq-answer.show {
            display: block;
        }

        .faq-toggle {
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .faq-toggle.rotate {
            transform: rotate(45deg);
        }

        .success-message {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }

        /* Past Messages Section Styles */
        .past-messages-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
        }

        .section-header {
            margin-bottom: 2rem;
        }

        .section-subtitle {
            color: var(--gray-600);
            margin: 0.5rem 0 0 0;
            font-size: 1rem;
        }

        .messages-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .message-thread {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: var(--transition);
        }

        .message-thread:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .thread-header {
            background: #f8fafc;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            border-bottom: 1px solid #e2e8f0;
        }

        .thread-info {
            flex: 1;
        }

        .thread-subject {
            margin: 0 0 0.5rem 0;
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .thread-meta {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .thread-date {
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .thread-status {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-resolved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-open {
            background: #fef3c7;
            color: #92400e;
        }

        .toggle-thread-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: var(--transition);
        }

        .toggle-thread-btn:hover {
            background: #e2e8f0;
        }

        .toggle-icon {
            font-size: 1.2rem;
            color: var(--gray-600);
            transition: var(--transition);
        }

        .toggle-icon.rotated {
            transform: rotate(180deg);
        }

        .thread-messages {
            padding: 1.5rem;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .message-item {
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
        }

        .student-msg {
            background: #f0f9ff;
            border-left: 4px solid var(--secondary-color);
            margin-right: 2rem;
        }

        .admin-msg {
            background: #f0fdf4;
            border-left: 4px solid var(--success-color);
            margin-left: 2rem;
        }

        .message-header {
            margin-bottom: 1rem;
        }

        .sender-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sender-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .admin-avatar {
            background: var(--success-color);
            color: white;
        }

        .sender-details {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .sender-details strong {
            font-size: 0.95rem;
            color: var(--primary-color);
        }

        .message-time {
            font-size: 0.8rem;
            color: var(--gray-600);
        }

        .message-content {
            line-height: 1.6;
            color: var(--gray-800);
        }

        .message-content p {
            margin-bottom: 1rem;
        }

        .message-content p:last-child {
            margin-bottom: 0;
        }

        .message-content ul {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .message-content li {
            margin-bottom: 0.5rem;
        }

        .empty-messages {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray-600);
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-messages h3 {
            margin: 0 0 0.5rem 0;
            color: var(--primary-color);
        }

        .empty-messages p {
            margin: 0;
        }

        /* Reply Form Styles */
        .thread-reply-form {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .reply-header {
            margin-bottom: 1rem;
        }

        .reply-header h4 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .reply-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .reply-textarea {
            width: 100%;
            min-height: 80px;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            transition: var(--transition);
            box-sizing: border-box;
        }

        .reply-textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .reply-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-cancel {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e9ecef;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
        }

        .btn-cancel:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            color: #495057;
        }

        .btn-reply {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-reply:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .reply-success {
            background: #d1fae5;
            color: #065f46;
            padding: 0.8rem;
            border-radius: 6px;
            margin-top: 1rem;
            display: none;
            font-size: 0.9rem;
        }

        /* Delete Message Styles */
        .message-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
            opacity: 0;
            transition: var(--transition);
        }

        .message-item:hover .message-actions {
            opacity: 1;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-delete:hover {
            background: #fecaca;
            border-color: #f87171;
            transform: translateY(-1px);
        }

        .btn-delete:active {
            transform: translateY(0);
        }

        /* Delete confirmation modal styles */
        .delete-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .delete-modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .delete-modal h3 {
            color: #dc2626;
            margin: 0 0 1rem 0;
            font-size: 1.3rem;
        }

        .delete-modal p {
            color: var(--gray-600);
            margin: 0 0 2rem 0;
            line-height: 1.5;
        }

        .delete-modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-confirm-delete {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-confirm-delete:hover {
            background: #b91c1c;
        }

        .btn-cancel-delete {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-cancel-delete:hover {
            background: #e5e7eb;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .priority-selector {
                flex-direction: column;
            }

            .contact-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php
        $page = "contact_admin";
        require 'sidebar.view.php';
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="contact-container">
                <!-- Contact Header -->
                <div class="contact-header">
                    <h1>📞 Contact Admin</h1>
                    <p>Need help? Get in touch with our administrative team</p>
                </div>

                <!-- Contact Methods -->
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-icon">📧</div>
                        <h3>Email Support</h3>
                        <p>Send us an email for general inquiries</p>
                        <div class="contact-info">admin@campuscanteen.edu</div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">📱</div>
                        <h3>Phone Support</h3>
                        <p>Call us during business hours</p>
                        <div class="contact-info">+91 98765 43210</div>
                        <small style="color: var(--gray-500);">Mon-Fri: 9:00 AM - 6:00 PM</small>
                    </div>

                    <div class="contact-method">
                        <div class="contact-icon">🏢</div>
                        <h3>Office Visit</h3>
                        <p>Visit our administrative office</p>
                        <div class="contact-info">Admin Block, Room 201</div>
                        <small style="color: var(--gray-500);">Ground Floor, Main Building</small>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-section">
                    <h2 class="mb-4">📝 Send Message</h2>

                    <div class="success-message" id="successMessage">
                        ✅ Your message has been sent successfully! We'll get back to you within 24 hours.
                    </div>
                    <form id="contactForm">


                        <div class="form-group mb-4">
                            <label class="form-label">Subject</label>
                            <select name="subject" class="form-input" required>
                                <option value="">Select a subject</option>
                                <option value="order_issue" selected>Order Issue</option>
                                <option value="payment_problem">Payment Problem</option>
                                <option value="account_access">Account Access</option>
                                <option value="menu_feedback">Menu Feedback</option>
                                <option value="technical_support">Technical Support</option>
                                <option value="general_inquiry">General Inquiry</option>
                                <option value="complaint">Complaint</option>
                                <option value="suggestion">Suggestion</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-input" placeholder="Please describe your issue or inquiry in detail..." required>
                                Hi Admin,
                                I'm having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven't received any confirmation. Could you please help me check the status?
                                Thank you!
                            </textarea>
                        </div>

                        <!-- <div class="form-group mb-4">
                            <label class="form-label">Attachment (Optional)</label>
                            <input type="file" name="attachment" class="form-input" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <small style="color: var(--gray-500);">Max file size: 5MB. Supported formats: JPG, PNG, PDF, DOC</small>
                        </div> -->

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            📤 Send Message
                        </button>
                    </form>

                </div>

                <!-- Past Messages Section -->
                <div class="past-messages-section">
                    <div class="section-header">
                        <h2 class="mb-4">💬 My Past Messages</h2>
                        <p class="section-subtitle">View your previous conversations with admin</p>
                    </div>

                    <div class="messages-container">
                        <?php if (isset($conversations)): ?>
                            <?php foreach ($conversations as $conversation): ?>
                                <div class="message-thread">
                                    <div class="thread-header">
                                        <div class="thread-info">
                                            <h3 class="thread-subject">Subject - <?= formatLabel($conversation->subject) ?></h3>
                                            <div class="thread-meta">
                                                <span class="thread-date"><?= timeAgoOrDate($conversation->created_at, false, '1 day') ?></span>
                                                <span class="thread-status status-<?= $conversation->status ?>"> <?= ucfirst($conversation->status) ?></span>
                                            </div>
                                        </div>
                                        <button class="toggle-thread-btn" onclick="toggleThread(this)">
                                            <span class="toggle-icon">▼</span>
                                        </button>
                                    </div>

                                    <div class="thread-messages">
                                        <?php foreach ($conversation->messages as $message): ?>
                                            <div class="message-item <?= $message->sender_type ?>-msg" data-message-id="<?= $message->id ?>">
                                                <div class="message-actions">
                                                    <button class="btn-delete" onclick="showDeleteModal(<?= $message->id ?>)">
                                                        🗑️ Delete
                                                    </button>
                                                </div>
                                                <div class="message-header">
                                                    <div class="sender-info">

                                                        <div class="sender-details">
                                                            <strong>You</strong>
                                                            <span class="message-time"><?= timeAgoOrDate($message->created_at, true, '0 minutes') ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message-content">

                                                    <?= $message->message_text; ?>
                                                    <!-- <p>Hi Admin,</p>
                                                    <p>I placed order #ORD-2024-001 yesterday but received only 2 items instead of 3. The chicken biryani was missing from my order. Could you please help me with this?</p>
                                                    <p>Thank you!</p> -->

                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="thread-reply-form">
                                            <div class="reply-header">
                                                <h4>💬 Add Reply</h4>
                                            </div>
                                            <form action="<?= ROOT ?>MessagesController/reply/<?= $conversation->id ?>" class="reply-form">
                                                <div class="form-group">
                                                    <textarea name="reply_message" class="reply-textarea" placeholder="Type your reply here..." required></textarea>
                                                </div>
                                                <div class="reply-actions">
                                                    <button type="button" class="btn-cancel" onclick="cancelReply(this)">Cancel</button>
                                                    <button type="submit" class="btn-reply">📤 Send Reply</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>



                        <?php else: ?>



                            <!-- Empty State (when no messages) -->
                            <div class="empty-messages" style="display: none;">
                                <div class="empty-icon">📭</div>
                                <h3>No Messages Yet</h3>
                                <p>You haven't sent any messages to admin yet. Use the form above to get in touch!</p>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="faq-section">
                    <h2 class="mb-4">❓ Frequently Asked Questions</h2>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>How do I reset my password?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            You can reset your password by clicking on "Forgot Password" on the login page. Enter your email address and you'll receive a reset link within 5 minutes.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>How can I cancel my order?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            Orders can be cancelled within 15 minutes of placing them. Go to "My Orders" and click the "Cancel" button next to your recent order. After 15 minutes, please contact admin for cancellation.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>What are the canteen operating hours?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            The canteen operates Monday to Friday from 8:00 AM to 8:00 PM, and weekends from 9:00 AM to 6:00 PM. Online ordering is available 24/7, but orders are processed during operating hours only.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>How do I add money to my wallet?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            You can add money to your wallet through the "Add Funds" option in your profile. We accept UPI, credit/debit cards, and net banking. Minimum top-up amount is ₹50.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>What if my order is incorrect or missing items?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            If your order is incorrect or missing items, please contact us immediately through this form or call our support number. We'll resolve the issue and provide a refund or replacement as appropriate.
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span>How long does it take to get a response?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            We typically respond to messages within 2-4 hours during business hours. High priority issues are addressed within 1 hour. For urgent matters, please call our support number directly.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="delete-modal" id="deleteModal">
        <div class="delete-modal-content">
            <h3>🗑️ Delete Message</h3>
            <p>Are you sure you want to delete this message? This action cannot be undone.</p>
            <div class="delete-modal-actions">
                <button class="btn-cancel-delete" onclick="hideDeleteModal()">Cancel</button>
                <button class="btn-confirm-delete" onclick="confirmDelete()">Delete Message</button>
            </div>
        </div>
    </div>

    <script>
        // Message thread toggle functionality
        function toggleThread(button) {
            const threadMessages = button.closest('.message-thread').querySelector('.thread-messages');
            const toggleIcon = button.querySelector('.toggle-icon');

            if (threadMessages.style.display === 'none' || threadMessages.style.display === '') {
                threadMessages.style.display = 'flex';
                toggleIcon.classList.add('rotated');
                toggleIcon.textContent = '▲';
            } else {
                threadMessages.style.display = 'none';
                toggleIcon.classList.remove('rotated');
                toggleIcon.textContent = '▼';
            }
        }

        // Submit reply functionality
        function submitReply(event, conversationId) {
            event.preventDefault();

            const form = event.target;
            const textarea = form.querySelector('.reply-textarea');
            const replyText = textarea.value.trim();

            if (!replyText) {
                alert('Please enter a reply message.');
                return;
            }

            // Create new message element
            const messageContainer = form.closest('.thread-messages');
            const newMessage = createMessageElement(replyText, 'You', new Date());

            // Insert before the reply form
            const replyForm = form.closest('.thread-reply-form');
            messageContainer.insertBefore(newMessage, replyForm);

            // Clear the form
            textarea.value = '';

            // Show success message
            showReplySuccess(form);

            // Here you would normally send the data to the server
            console.log('Reply submitted for conversation:', conversationId, 'Message:', replyText);
        }

        // Cancel reply functionality
        function cancelReply(button) {
            const textarea = button.closest('.reply-form').querySelector('.reply-textarea');
            textarea.value = '';
            textarea.focus();
        }

        // Create new message element
        function createMessageElement(text, sender, timestamp) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message-item student-msg';

            const timeString = timestamp.toLocaleDateString() + ' - ' + timestamp.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });

            messageDiv.innerHTML = `
                <div class="message-header">
                    <div class="sender-info">
                        <div class="sender-avatar">👨‍🎓</div>
                        <div class="sender-details">
                            <strong>${sender}</strong>
                            <span class="message-time">${timeString}</span>
                        </div>
                    </div>
                </div>
                <div class="message-content">
                    <p>${text}</p>
                </div>
            `;

            return messageDiv;
        }

        // Show reply success message
        function showReplySuccess(form) {
            // Create success message if it doesn't exist
            let successMsg = form.querySelector('.reply-success');
            if (!successMsg) {
                successMsg = document.createElement('div');
                successMsg.className = 'reply-success';
                successMsg.textContent = '✅ Reply sent successfully!';
                form.appendChild(successMsg);
            }

            // Show success message
            successMsg.style.display = 'block';

            // Hide after 3 seconds
            setTimeout(() => {
                successMsg.style.display = 'none';
            }, 3000);
        }

        // FAQ toggle functionality
        function toggleFaq(element) {
            const answer = element.nextElementSibling;
            const toggle = element.querySelector('.faq-toggle');

            if (answer.classList.contains('show')) {
                answer.classList.remove('show');
                toggle.classList.remove('rotate');
                toggle.textContent = '+';
            } else {
                // Close all other FAQs
                document.querySelectorAll('.faq-answer').forEach(ans => ans.classList.remove('show'));
                document.querySelectorAll('.faq-toggle').forEach(tog => {
                    tog.classList.remove('rotate');
                    tog.textContent = '+';
                });

                // Open clicked FAQ
                answer.classList.add('show');
                toggle.classList.add('rotate');
                toggle.textContent = '×';
            }
        }

        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Show success message
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';

            // Scroll to success message
            successMessage.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Reset form after 2 seconds
            setTimeout(() => {
                this.reset();
                // Reset priority selector
                document.querySelectorAll('.priority-option').forEach(opt => opt.classList.remove('selected'));


                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }, 2000);



            let url = ROOT + 'MessagesController/messages';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        subject: this.subject.value,
                        message: this.message.value,

                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                })
        });

        // Delete message functionality
        let messageToDelete = null;

        function showDeleteModal(messageId) {
            messageToDelete = messageId;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function hideDeleteModal() {
            //messageToDelete = null;
            document.getElementById('deleteModal').style.display = 'none';
        }

        function confirmDelete() {
            if (messageToDelete) {
                // Find the message element
                const messageElement = document.querySelector(`[data-message-id="${messageToDelete}"]`);

                if (messageElement) {
                    // Add fade out animation
                    messageElement.style.transition = 'all 0.3s ease';
                    messageElement.style.opacity = '0';
                    messageElement.style.transform = 'translateX(-20px)';

                    // Remove the element after animation
                    setTimeout(() => {
                        messageElement.remove();

                        // Show success message
                        showDeleteSuccess();

                        let url = ROOT + 'MessagesController/deleteMessage/' + messageToDelete;
                        console.log(messageToDelete);
                        fetch(url)
                            .then(res => res.text())
                            .then(data => {
                                console.log(data);
                            });

                    }, 300);
                }

                hideDeleteModal();
            }
        }

        function showDeleteSuccess() {
            // Create and show a temporary success message
            const successDiv = document.createElement('div');
            successDiv.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #d1fae5;
                color: #065f46;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1001;
                font-weight: 600;
                animation: slideIn 0.3s ease;
            `;
            successDiv.innerHTML = '✅ Message deleted successfully';

            document.body.appendChild(successDiv);

            // Remove after 3 seconds
            setTimeout(() => {
                successDiv.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (successDiv.parentNode) {
                        successDiv.parentNode.removeChild(successDiv);
                    }
                }, 300);
            }, 3000);
        }

        // Add CSS animations for success message
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('deleteModal').style.display === 'flex') {
                hideDeleteModal();
            }
        });
    </script>
</body>

</html>