<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Under Review - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pending-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 550px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .pending-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f39c12, #e67e22, #f39c12);
            background-size: 200% 100%;
            animation: progressBar 2s linear infinite;
        }

        @keyframes progressBar {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pending-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: rotate 3s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .pending-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #f39c12;
        }

        .pending-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .timeline-container {
            background: #f8fafc;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .timeline-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .timeline-header h3 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 1.3rem;
        }

        .timeline-header p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
            padding-left: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #e2e8f0;
        }

        .timeline-item.completed::before {
            background: #27ae60;
            box-shadow: 0 0 0 2px #27ae60;
        }

        .timeline-item.current::before {
            background: #f39c12;
            box-shadow: 0 0 0 2px #f39c12;
            animation: pulse 2s infinite;
        }

        .timeline-item.pending::before {
            background: #bdc3c7;
            box-shadow: 0 0 0 2px #bdc3c7;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .timeline-content h4 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 1rem;
        }

        .timeline-content p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .timeline-time {
            font-size: 0.8rem;
            color: var(--gray-500);
            font-weight: 600;
        }

        .status-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .status-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .status-card:hover {
            border-color: #f39c12;
            transform: translateY(-2px);
        }

        .status-card-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .status-card h4 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 0.9rem;
        }

        .status-card p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.8rem;
        }

        .estimated-time {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .estimated-time h3 {
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
        }

        .estimated-time p {
            margin: 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.5rem;
            min-width: 60px;
        }

        .countdown-number {
            font-size: 1.5rem;
            font-weight: bold;
            display: block;
        }

        .countdown-label {
            font-size: 0.7rem;
            opacity: 0.8;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #f39c12;
            color: white;
        }

        .btn-primary:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #f7fafc;
            color: var(--gray-700);
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #edf2f7;
            border-color: #cbd5e1;
        }

        .help-section {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: left;
        }

        .help-section h4 {
            margin: 0 0 1rem 0;
            color: #234e52;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .faq-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #b2f5ea;
        }

        .faq-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .faq-question {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .faq-answer {
            color: #4a5568;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .pending-container {
                padding: 2rem;
                margin: 1rem;
            }

            .pending-icon {
                font-size: 4rem;
            }

            .pending-title {
                font-size: 1.8rem;
            }

            .timeline {
                padding-left: 1.5rem;
            }

            .timeline-item {
                padding-left: 1.5rem;
            }

            .countdown-timer {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <div class="pending-container">
        <div class="pending-icon">⏳</div>
        <h1 class="pending-title">Account Under Review</h1>
        <p class="pending-subtitle">
            Great! Your student account has been submitted for verification. Our team is currently reviewing your information to ensure everything meets our standards.
        </p>

        <!-- Estimated Time -->
        <!-- <div class="estimated-time">
            <h3>⏰ Estimated Processing Time</h3>
            <p>Your account will be reviewed within 24-48 hours</p>
            <div class="countdown-timer">
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">24</span>
                    <span class="countdown-label">Hours</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">00</span>
                    <span class="countdown-label">Minutes</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="seconds">00</span>
                    <span class="countdown-label">Seconds</span>
                </div>
            </div>
        </div> -->

        <!-- Review Timeline -->
        <!-- <div class="timeline-container">
            <div class="timeline-header">
                <h3>📋 Review Process</h3>
                <p>Track the progress of your account verification</p>
            </div>
            <div class="timeline">
                <div class="timeline-item completed">
                    <div class="timeline-content">
                        <h4>Application Submitted</h4>
                        <p>Your registration form has been received successfully</p>
                        <div class="timeline-time">✅ Completed - <?= date('M d, Y g:i A', strtotime('-2 hours')) ?></div>
                    </div>
                </div>
                <div class="timeline-item current">
                    <div class="timeline-content">
                        <h4>Document Verification</h4>
                        <p>Verifying student ID, college enrollment, and personal information</p>
                        <div class="timeline-time">🔄 In Progress - Started <?= date('M d, Y g:i A', strtotime('-1 hour')) ?></div>
                    </div>
                </div>
                <div class="timeline-item pending">
                    <div class="timeline-content">
                        <h4>Admin Approval</h4>
                        <p>Final review and account activation by administration</p>
                        <div class="timeline-time">⏳ Pending</div>
                    </div>
                </div>
                <div class="timeline-item pending">
                    <div class="timeline-content">
                        <h4>Account Activation</h4>
                        <p>Welcome email sent and full access granted</p>
                        <div class="timeline-time">⏳ Pending</div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Status Cards -->
        <!-- <div class="status-cards">
            <div class="status-card">
                <div class="status-card-icon">📄</div>
                <h4>Documents</h4>
                <p>Under Review</p>
            </div>
            <div class="status-card">
                <div class="status-card-icon">🎓</div>
                <h4>Student ID</h4>
                <p>Verifying</p>
            </div>
            <div class="status-card">
                <div class="status-card-icon">🏫</div>
                <h4>College</h4>
                <p>Confirmed</p>
            </div>
            <div class="status-card">
                <div class="status-card-icon">📧</div>
                <h4>Email</h4>
                <p>Verified</p>
            </div>
        </div> -->

        <!-- Action Buttons -->
        <div class="action-buttons">
            <!-- <button class="btn btn-primary" onclick="checkStatus()">
                🔄 Check Status
            </button> -->
            <a href="mailto:admin@campuscanteen.edu?subject=Account Review Inquiry" class="btn btn-secondary">
                📧 Contact Support
            </a>
        </div>

        <!-- Help Section -->
        <div class="help-section">
            <h4>❓ Frequently Asked Questions</h4>

            <div class="faq-item">
                <div class="faq-question">Why is my account under review?</div>
                <div class="faq-answer">We review all new accounts to ensure security and verify student credentials with your college.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">What happens after approval?</div>
                <div class="faq-answer">You'll receive a welcome email with login instructions and can immediately start ordering from canteens.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Can I speed up the process?</div>
                <div class="faq-answer">The review process is automated and typically completes within 24-48 hours. Contact support if urgent.</div>
            </div>
        </div>
    </div>

    <script>
        // Countdown timer
        function updateCountdown() {
            const now = new Date().getTime();
            const targetTime = now + (24 * 60 * 60 * 1000); // 24 hours from now

            const distance = targetTime - now;

            const hours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

        // Auto-refresh page every 10 minutes
        setTimeout(() => {
            window.location.reload();
        }, 600000); // 10 minutes

        function checkStatus() {
            // Simulate status check with random progress
            const statusMessages = [
                "✅ Documents verified successfully!\n🔄 Moving to admin approval stage...",
                "📋 Your application is currently in the verification queue.\n⏱️ Expected completion: 18-24 hours remaining.",
                "🔍 Additional verification in progress.\n📧 You will be notified of any updates via email.",
                "⚡ Processing faster than expected!\n🎉 Approval may come sooner than estimated."
            ];

            const randomMessage = statusMessages[Math.floor(Math.random() * statusMessages.length)];
            alert('📊 Status Update:\n\n' + randomMessage);
        }

        // Add interactive feedback
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Simulate progress updates
        setTimeout(() => {
            const currentItem = document.querySelector('.timeline-item.current');
            if (currentItem && Math.random() > 0.5) {
                currentItem.classList.remove('current');
                currentItem.classList.add('completed');

                const nextItem = currentItem.nextElementSibling;
                if (nextItem && nextItem.classList.contains('timeline-item')) {
                    nextItem.classList.remove('pending');
                    nextItem.classList.add('current');
                }
            }
        }, 30000); // Update after 30 seconds
    </script>
</body>

</html>