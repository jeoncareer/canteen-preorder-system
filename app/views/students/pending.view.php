<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .pending-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            margin: 2rem;
        }

        .pending-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .pending-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .pending-message {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .pending-details {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #f59e0b;
        }

        .pending-details h3 {
            color: #1f2937;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .pending-details ul {
            text-align: left;
            color: #4b5563;
            line-height: 1.8;
        }

        .pending-details li {
            margin-bottom: 0.5rem;
        }

        .contact-info {
            background: #e0f2fe;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .contact-info h3 {
            color: #0369a1;
            margin-bottom: 1rem;
        }

        .contact-info p {
            color: #0c4a6e;
            margin-bottom: 0.5rem;
        }

        .refresh-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .logout-link {
            color: #6b7280;
            text-decoration: none;
            margin-top: 1rem;
            display: inline-block;
            font-size: 0.9rem;
        }

        .logout-link:hover {
            color: #374151;
            text-decoration: underline;
        }

        .status-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="pending-container">
        <div class="pending-icon">⏳</div>

        <div class="status-badge">Account Under Review</div>

        <h1 class="pending-title">Verification Pending</h1>

        <p class="pending-message">
            Thank you for registering with Campus Canteen! Your account is currently under review by our administrators.
            We're verifying your student credentials to ensure a secure platform for all users.
        </p>

        <div class="pending-details">
            <h3>📋 What happens next?</h3>
            <ul>
                <li>Our admin team will verify your student registration details</li>
                <li>This process typically takes 24-48 hours during working days</li>
                <li>You'll receive an email notification once approved</li>
                <li>After approval, you can access the full canteen ordering system</li>
            </ul>
        </div>

        <div class="contact-info">
            <h3>📞 Need Help?</h3>
            <p><strong>Email:</strong> canteen.admin@college.edu</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Office Hours:</strong> Mon-Fri, 9:00 AM - 5:00 PM</p>
        </div>

        <!-- <button class="refresh-btn" onclick="window.location.reload()">
            🔄 Check Status Again
        </button> -->

        <br>
        <a href="<?= ROOT ?>students/logout" class="logout-link">← Logout and try different account</a>
    </div>

    <script>
        // Auto-refresh every 30 seconds to check for status updates
        setTimeout(function() {
            window.location.reload();
        }, 30000);

        // Show a notification every 5 minutes
        setInterval(function() {
            console.log('Checking account status...');
        }, 300000);
    </script>
</body>

</html>