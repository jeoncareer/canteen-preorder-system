<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Registration Under Review - Campus Canteen System</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pending-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 700px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
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
            background: linear-gradient(90deg, #3498db, #2980b9, #3498db);
            background-size: 200% 100%;
            animation: progressBar 3s linear infinite;
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

        .pending-header {
            margin-bottom: 2rem;
        }

        .pending-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .pending-title {
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #3498db;
        }

        .pending-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .canteen-info-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border-left: 5px solid #3498db;
        }

        .canteen-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .canteen-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .canteen-details {
            text-align: left;
            flex: 1;
        }

        .canteen-details h2 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 1.5rem;
        }

        .canteen-details p {
            margin: 0.25rem 0;
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .application-id {
            background: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .review-progress {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .progress-header {
            margin-bottom: 2rem;
        }

        .progress-header h3 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 1.4rem;
        }

        .progress-bar-container {
            background: #e9ecef;
            border-radius: 10px;
            height: 8px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, #3498db, #2980b9);
            height: 100%;
            width: 60%;
            border-radius: 10px;
            animation: progressGrow 2s ease-out;
        }

        @keyframes progressGrow {
            from {
                width: 0%;
            }

            to {
                width: 60%;
            }
        }

        .progress-text {
            color: var(--gray-600);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .review-stages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stage-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .stage-card.completed {
            border-color: #27ae60;
            background: #d5f4e6;
        }

        .stage-card.current {
            border-color: #3498db;
            background: #ebf3fd;
            animation: pulse 2s infinite;
        }

        .stage-card.pending {
            border-color: #bdc3c7;
            background: #f8f9fa;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }

        .stage-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stage-card h4 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
            font-size: 1rem;
        }

        .stage-card p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .stage-status {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .completed .stage-status {
            background: #27ae60;
            color: white;
        }

        .current .stage-status {
            background: #3498db;
            color: white;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .documents-checklist {
            background: #e8f5e8;
            border: 1px solid #81c784;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }

        .documents-checklist h3 {
            margin: 0 0 1.5rem 0;
            color: #2e7d32;
            text-align: center;
        }

        .checklist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #4caf50;
        }

        .checklist-icon {
            font-size: 1.2rem;
            color: #4caf50;
        }

        .checklist-text {
            color: var(--gray-700);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .estimated-timeline {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .timeline-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .timeline-item {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .timeline-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        .timeline-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .action-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
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

        .contact-support {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .contact-support h4 {
            margin: 0 0 1rem 0;
            color: #856404;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .contact-item {
            text-align: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .contact-item h5 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
        }

        .contact-item p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.85rem;
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

            .canteen-header {
                flex-direction: column;
                text-align: center;
            }

            .canteen-logo {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .review-stages {
                grid-template-columns: 1fr;
            }

            .action-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="pending-container">
        <div class="pending-header">
            <div class="pending-icon">🏪</div>
            <h1 class="pending-title">Registration Under Review</h1>
            <p class="pending-subtitle">
                Excellent! Your canteen registration has been submitted successfully. Our verification team is currently reviewing your application and documents.
            </p>
        </div>

        <!-- Canteen Information -->
        <div class="canteen-info-card">
            <div class="canteen-header">
                <div class="canteen-logo">
                    <?php
                    $canteen_name = $_GET['name'] ?? 'Main Cafeteria';
                    echo strtoupper(substr($canteen_name, 0, 2));
                    ?>
                </div>
                <div class="canteen-details">
                    <h2><?= htmlspecialchars($canteen_name) ?></h2>
                    <p><strong>Type:</strong> Campus Food Service Provider</p>
                    <p><strong>Location:</strong> <?= $_GET['location'] ?? 'Main Campus Building' ?></p>
                    <p><strong>Submitted:</strong> <?= date('M d, Y g:i A') ?></p>
                    <div class="application-id">Application ID: #CNT-<?= date('Y') ?>-<?= rand(1000, 9999) ?></div>
                </div>
            </div>
        </div>

        <!-- Review Progress -->
        <div class="review-progress">
            <div class="progress-header">
                <h3>📊 Review Progress</h3>
                <div class="progress-bar-container">
                    <div class="progress-bar"></div>
                </div>
                <div class="progress-text">60% Complete - Document verification in progress</div>
            </div>

            <div class="review-stages">
                <div class="stage-card completed">
                    <div class="stage-status">✓</div>
                    <div class="stage-icon">📋</div>
                    <h4>Application Received</h4>
                    <p>Your registration form and initial documents have been successfully submitted</p>
                </div>

                <div class="stage-card current">
                    <div class="stage-status">⟳</div>
                    <div class="stage-icon">🔍</div>
                    <h4>Document Verification</h4>
                    <p>Verifying business license, health certificates, and compliance documents</p>
                </div>

                <div class="stage-card pending">
                    <div class="stage-icon">👨‍💼</div>
                    <h4>Admin Review</h4>
                    <p>Final review by administration team and policy compliance check</p>
                </div>

                <div class="stage-card pending">
                    <div class="stage-icon">🎉</div>
                    <h4>Approval & Setup</h4>
                    <p>Account activation, system setup, and welcome package delivery</p>
                </div>
            </div>
        </div>

        <!-- Documents Checklist -->
        <div class="documents-checklist">
            <h3>📄 Documents Under Review</h3>
            <div class="checklist-grid">
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Business Registration Certificate</div>
                </div>
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Food Safety License</div>
                </div>
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Health Department Clearance</div>
                </div>
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Insurance Documentation</div>
                </div>
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Menu & Pricing Structure</div>
                </div>
                <div class="checklist-item">
                    <div class="checklist-icon">✅</div>
                    <div class="checklist-text">Staff Verification Records</div>
                </div>
            </div>
        </div>

        <!-- Estimated Timeline -->
        <div class="estimated-timeline">
            <h3>⏰ Estimated Processing Timeline</h3>
            <div class="timeline-content">
                <div class="timeline-item">
                    <span class="timeline-number">2-3</span>
                    <span class="timeline-label">Business Days</span>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">24-48</span>
                    <span class="timeline-label">Hours Response</span>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">95%</span>
                    <span class="timeline-label">Approval Rate</span>
                </div>
                <div class="timeline-item">
                    <span class="timeline-number">1-2</span>
                    <span class="timeline-label">Days Setup</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-section">
            <button class="btn btn-primary" onclick="checkApplicationStatus()">
                🔄 Check Application Status
            </button>
            <button class="btn btn-secondary" onclick="downloadReceipt()">
                📄 Download Receipt
            </button>
            <a href="mailto:canteen-admin@campuscanteen.edu?subject=Canteen Application Inquiry" class="btn btn-secondary">
                📧 Contact Review Team
            </a>
        </div>

        <!-- Contact Support -->
        <div class="contact-support">
            <h4>🤝 Need Assistance?</h4>
            <p>Our canteen onboarding team is here to help you through the process</p>
            <div class="contact-grid">
                <div class="contact-item" onclick="window.location.href='mailto:canteen-admin@campuscanteen.edu'">
                    <h5>📧 Email Support</h5>
                    <p>canteen-admin@campuscanteen.edu</p>
                </div>
                <div class="contact-item" onclick="window.location.href='tel:+919876543210'">
                    <h5>📞 Phone Support</h5>
                    <p>+91 98765 43210</p>
                </div>
                <div class="contact-item">
                    <h5>🏢 Office Hours</h5>
                    <p>Mon-Fri: 9:00 AM - 6:00 PM</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh page every 15 minutes
        setTimeout(() => {
            window.location.reload();
        }, 900000); // 15 minutes

        function checkApplicationStatus() {
            const statusUpdates = [
                "📋 Your application is currently in the document verification phase.\n🔍 All submitted documents are being reviewed by our compliance team.\n⏱️ Expected completion: 24-48 hours.",

                "✅ Business license verification completed successfully!\n🔄 Moving to health certificate review phase.\n📧 You will be notified of any additional requirements.",

                "🚀 Your application is progressing faster than expected!\n📊 Currently at 75% completion.\n🎉 Approval notification may arrive sooner than estimated.",

                "📞 Our team may contact you for additional clarification.\n📄 Please ensure all contact information is up to date.\n✉️ Check your email regularly for updates."
            ];

            const randomUpdate = statusUpdates[Math.floor(Math.random() * statusUpdates.length)];
            alert('📊 Application Status Update:\n\n' + randomUpdate);
        }

        function downloadReceipt() {
            alert('📄 Application Receipt\n\n' +
                'Application ID: #CNT-' + new Date().getFullYear() + '-' + Math.floor(Math.random() * 9000 + 1000) + '\n' +
                'Canteen: <?= htmlspecialchars($canteen_name) ?>\n' +
                'Submitted: <?= date("M d, Y g:i A") ?>\n' +
                'Status: Under Review\n\n' +
                'Receipt download functionality would be implemented here.');
        }

        // Simulate progress updates
        let progressValue = 60;
        setInterval(() => {
            if (Math.random() > 0.7 && progressValue < 90) {
                progressValue += Math.floor(Math.random() * 5) + 1;
                document.querySelector('.progress-bar').style.width = progressValue + '%';
                document.querySelector('.progress-text').textContent =
                    progressValue + '% Complete - ' + getProgressMessage(progressValue);
            }
        }, 45000); // Update every 45 seconds

        function getProgressMessage(progress) {
            if (progress < 70) return 'Document verification in progress';
            if (progress < 85) return 'Admin review phase';
            if (progress < 95) return 'Final compliance check';
            return 'Preparing for approval';
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

        // Animate stage progression
        setTimeout(() => {
            const currentStage = document.querySelector('.stage-card.current');
            if (currentStage && Math.random() > 0.6) {
                // Simulate moving to next stage
                currentStage.classList.remove('current');
                currentStage.classList.add('completed');

                const nextStage = currentStage.nextElementSibling;
                if (nextStage && nextStage.classList.contains('stage-card')) {
                    nextStage.classList.remove('pending');
                    nextStage.classList.add('current');

                    // Update progress
                    progressValue = Math.min(progressValue + 20, 90);
                    document.querySelector('.progress-bar').style.width = progressValue + '%';
                    document.querySelector('.progress-text').textContent =
                        progressValue + '% Complete - ' + getProgressMessage(progressValue);
                }
            }
        }, 60000); // After 1 minute
    </script>
</body>

</html>