<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/contact-admin.css">

</head>

<body>
    <?php

    require 'header.view.php';


    ?>


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
                    <div class="form-row mb-4">
                        <div class="form-group">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-input" value="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-input" value="CS2021001" required>
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-input" value="john.doe@student.edu" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" value="+91 98765 43210">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Subject</label>
                        <select class="form-input" required>
                            <option value="">Select a subject</option>
                            <option value="order_issue">Order Issue</option>
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
                        <label class="form-label">Priority Level</label>
                        <div class="priority-selector">
                            <div class="priority-option priority-low" data-priority="low">
                                <div>🟢 Low</div>
                                <small>General inquiry</small>
                            </div>
                            <div class="priority-option selected" data-priority="medium">
                                <div>🟡 Medium</div>
                                <small>Standard issue</small>
                            </div>
                            <div class="priority-option priority-high" data-priority="high">
                                <div>🔴 High</div>
                                <small>Urgent matter</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Message</label>
                        <textarea class="form-input" placeholder="Please describe your issue or inquiry in detail..." required>Hi Admin,

I'm having trouble with my recent order #ORD-2024-001. The order was placed yesterday but I haven't received any confirmation. Could you please help me check the status?

Thank you!</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Attachment (Optional)</label>
                        <input type="file" class="form-input" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                        <small style="color: var(--gray-500);">Max file size: 5MB. Supported formats: JPG, PNG, PDF, DOC</small>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        📤 Send Message
                    </button>
                </form>
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

    <script>
        // Priority selector functionality
        document.querySelectorAll('.priority-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.priority-option').forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

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
                document.querySelector('.priority-option[data-priority="medium"]').classList.add('selected');

                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }, 2000);
        });
    </script>
</body>

</html>