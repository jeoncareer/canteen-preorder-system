<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Status - Campus Canteen</title>
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

        .status-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
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

        .status-title {
            font-size: 2rem;
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

        .status-message {
            font-size: 1.1rem;
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .status-details {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: var(--gray-700);
        }

        .detail-value {
            color: var(--gray-600);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
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

        .contact-info {
            background: #e6fffa;
            border: 1px solid #81e6d9;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1.5rem;
        }

        .contact-info h4 {
            margin: 0 0 0.5rem 0;
            color: #234e52;
        }

        .contact-info p {
            margin: 0;
            color: #2d3748;
            font-size: 0.9rem;
        }

        .help-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .help-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .help-link:hover {
            color: #5a67d8;
            text-decoration: underline;
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
                font-size: 1.5rem;
            }

            .help-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="status-container">
        <!-- Dynamic content based on status -->
        <?php
        $status = $_GET['status'] ?? 'blocked'; // Default to blocked
        $reason = $_GET['reason'] ?? 'Account verification required';
        ?>

        <?php if ($status === 'blocked'): ?>
            <!-- Blocked Status -->
            <div class="status-icon blocked-icon">🚫</div>
            <h1 class="status-title blocked-title">Account Blocked</h1>
            <p class="status-message">
                Your student account has been temporarily blocked. Please contact the administration to resolve this issue.
            </p>

            <div class="status-details">
                <div class="detail-item">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value" style="color: #e74c3c; font-weight: 600;">Blocked</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Reason:</span>
                    <span class="detail-value"><?= htmlspecialchars($reason) ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value"><?= date('M d, Y') ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Reference ID:</span>
                    <span class="detail-value">#BLK-<?= date('Ymd') ?>-<?= rand(1000, 9999) ?></span>
                </div>
            </div>

        <?php else: ?>
            <!-- Pending Approval Status -->
            <div class="status-icon pending-icon">⏳</div>
            <h1 class="status-title pending-title">Pending Approval</h1>
            <p class="status-message">
                Your student account is currently under review. Please wait while our administration team verifies your information.
            </p>

            <div class="status-details">
                <div class="detail-item">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value" style="color: #f39c12; font-weight: 600;">Pending Review</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Submitted:</span>
                    <span class="detail-value"><?= date('M d, Y') ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Expected Response:</span>
                    <span class="detail-value">Within 24-48 hours</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Application ID:</span>
                    <span class="detail-value">#APP-<?= date('Ymd') ?>-<?= rand(1000, 9999) ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="mailto:admin@campuscanteen.edu?subject=Account Status Inquiry" class="btn btn-primary">
                📧 Contact Admin
            </a>
            <a href="<?= ROOT ?>home" class="btn btn-secondary">
                🏠 Back to Home
            </a>
        </div>

        <!-- Contact Information -->
        <div class="contact-info">
            <h4>📞 Need Immediate Help?</h4>
            <p><strong>Email:</strong> admin@campuscanteen.edu</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Office:</strong> Admin Block, Room 201</p>
        </div>

        <!-- Help Links -->
        <div class="help-links">
            <a href="#" class="help-link">📋 Account Guidelines</a>
            <a href="#" class="help-link">❓ FAQ</a>
            <a href="#" class="help-link">📞 Support Center</a>
        </div>
    </div>

    <script>
        // Auto-refresh page every 5 minutes for pending status
        <?php if ($status === 'pending'): ?>
            setTimeout(() => {
                window.location.reload();
            }, 300000); // 5 minutes
        <?php endif; ?>

        // Add some interactive feedback
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>

</html>