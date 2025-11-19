<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Status - Campus Canteen System</title>
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

        .status-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 600px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            animation: slideUp 0.6s ease-out;
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

        .status-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .blocked-icon {
            color: #e74c3c;
        }

        .pending-icon {
            color: #f39c12;
        }

        .suspended-icon {
            color: #e67e22;
        }

        .status-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--gray-800);
        }

        .blocked-title {
            color: #e74c3c;
        }

        .pending-title {
            color: #f39c12;
        }

        .suspended-title {
            color: #e67e22;
        }

        .status-message {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .canteen-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .canteen-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .canteen-logo {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            font-weight: bold;
        }

        .canteen-details h3 {
            margin: 0;
            color: var(--gray-800);
            font-size: 1.3rem;
        }

        .canteen-details p {
            margin: 0.25rem 0 0 0;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .status-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .detail-item {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .detail-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .blocked .detail-item {
            border-left-color: #e74c3c;
        }

        .pending .detail-item {
            border-left-color: #f39c12;
        }

        .suspended .detail-item {
            border-left-color: #e67e22;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
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
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #5a67d8;
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

        .btn-warning {
            background: #fed7d7;
            color: #c53030;
            border: 2px solid #feb2b2;
        }

        .btn-warning:hover {
            background: #fbb6ce;
            border-color: #f687b3;
        }

        .requirements-section {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .requirements-section h4 {
            margin: 0 0 1rem 0;
            color: #234e52;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .requirements-list li {
            padding: 0.5rem 0;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .requirements-list li::before {
            content: "✓";
            color: #38a169;
            font-weight: bold;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .contact-card {
            background: #f7fafc;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .contact-card h5 {
            margin: 0 0 0.5rem 0;
            color: var(--gray-800);
        }

        .contact-card p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .status-container {
                padding: 2rem;
                margin: 1rem;
            }

            .status-icon {
                font-size: 4rem;
            }

            .status-title {
                font-size: 1.8rem;
            }

            .status-details {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .canteen-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="status-container">
        <!-- Dynamic content based on status -->
        <?php
        $status = $_GET['status'] ?? 'blocked'; // blocked, pending, suspended
        $reason = $_GET['reason'] ?? 'License verification required';
        $canteen_name = $_GET['name'] ?? 'Main Cafeteria';
        ?>

        <div class="<?= $status ?>">
            <?php if ($status === 'blocked'): ?>
                <!-- Blocked Status -->
                <div class="status-icon blocked-icon">🚫</div>
                <h1 class="status-title blocked-title">Canteen Access Blocked</h1>
                <p class="status-message">
                    Your canteen operations have been temporarily blocked. Please resolve the issues mentioned below to restore access.
                </p>

            <?php elseif ($status === 'suspended'): ?>
                <!-- Suspended Status -->
                <div class="status-icon suspended-icon">⚠️</div>
                <h1 class="status-title suspended-title">Canteen Suspended</h1>
                <p class="status-message">
                    Your canteen has been suspended due to policy violations. Contact administration immediately to resolve this matter.
                </p>

            <?php else: ?>
                <!-- Pending Approval Status -->
                <div class="status-icon pending-icon">⏳</div>
                <h1 class="status-title pending-title">Pending Approval</h1>
                <p class="status-message">
                    Your canteen registration is under review. Our team is verifying your documents and will respond soon.
                </p>
            <?php endif; ?>

            <!-- Canteen Information -->
            <div class="canteen-info">
                <div class="canteen-header">
                    <div class="canteen-logo">
                        <?= strtoupper(substr($canteen_name, 0, 2)) ?>
                    </div>
                    <div class="canteen-details">
                        <h3><?= htmlspecialchars($canteen_name) ?></h3>
                        <p>Campus Canteen Partner</p>
                        <p>ID: #CNT-<?= date('Y') ?>-<?= rand(100, 999) ?></p>
                    </div>
                </div>

                <div class="status-details">
                    <div class="detail-item">
                        <div class="detail-label">Current Status</div>
                        <div class="detail-value" style="color: <?= $status === 'blocked' ? '#e74c3c' : ($status === 'suspended' ? '#e67e22' : '#f39c12') ?>;">
                            <?= ucfirst($status) ?>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Date</div>
                        <div class="detail-value"><?= date('M d, Y') ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Reason</div>
                        <div class="detail-value"><?= htmlspecialchars($reason) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Reference</div>
                        <div class="detail-value">#<?= strtoupper($status) ?>-<?= date('Ymd') ?>-<?= rand(1000, 9999) ?></div>
                    </div>
                </div>
            </div>

            <?php if ($status === 'pending'): ?>
                <!-- Requirements for Pending -->
                <div class="requirements-section">
                    <h4>📋 Required Documents Under Review</h4>
                    <ul class="requirements-list">
                        <li>Business License & Registration</li>
                        <li>Food Safety Certification</li>
                        <li>Health Department Clearance</li>
                        <li>Insurance Documentation</li>
                        <li>Menu & Pricing Details</li>
                        <li>Staff Verification Records</li>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="mailto:admin@campuscanteen.edu?subject=Canteen Status Inquiry - <?= htmlspecialchars($canteen_name) ?>" class="btn btn-primary">
                    📧 Contact Admin
                </a>
                <?php if ($status === 'blocked' || $status === 'suspended'): ?>
                    <a href="#" class="btn btn-warning" onclick="showAppealForm()">
                        📝 Submit Appeal
                    </a>
                <?php else: ?>
                    <a href="#" class="btn btn-secondary" onclick="checkStatus()">
                        🔄 Check Status
                    </a>
                <?php endif; ?>
            </div>

            <!-- Contact Information -->
            <div class="contact-grid">
                <div class="contact-card">
                    <h5>📧 Email Support</h5>
                    <p>admin@campuscanteen.edu</p>
                    <p>Response within 24 hours</p>
                </div>
                <div class="contact-card">
                    <h5>📞 Phone Support</h5>
                    <p>+91 98765 43210</p>
                    <p>Mon-Fri: 9:00 AM - 6:00 PM</p>
                </div>
                <div class="contact-card">
                    <h5>🏢 Office Visit</h5>
                    <p>Admin Block, Room 201</p>
                    <p>Ground Floor, Main Building</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh for pending status
        <?php if ($status === 'pending'): ?>
            setTimeout(() => {
                window.location.reload();
            }, 300000); // 5 minutes
        <?php endif; ?>

        function showAppealForm() {
            alert('Appeal form functionality would be implemented here.\n\nFor now, please contact admin directly via email or phone.');
        }

        function checkStatus() {
            // Simulate status check
            const statusMessages = [
                "Your application is currently under review by our verification team.",
                "Documents are being processed. Expected completion: 24-48 hours.",
                "Additional verification may be required. You will be contacted if needed."
            ];

            const randomMessage = statusMessages[Math.floor(Math.random() * statusMessages.length)];
            alert('Status Update:\n\n' + randomMessage);
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

        // Add hover effects to contact cards
        document.querySelectorAll('.contact-card').forEach(card => {
            card.addEventListener('click', function() {
                const email = this.textContent.includes('@') ? this.textContent.match(/[\w.-]+@[\w.-]+/)[0] : null;
                const phone = this.textContent.includes('+91') ? this.textContent.match(/\+91 [\d ]+/)[0] : null;

                if (email) {
                    window.location.href = `mailto:${email}`;
                } else if (phone) {
                    window.location.href = `tel:${phone.replace(/\s/g, '')}`;
                }
            });
        });
    </script>
</body>

</html>