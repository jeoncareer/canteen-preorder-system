<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Rejected - Campus Canteen</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/base.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
    <style>
        body {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .blocked-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            margin: 2rem;
        }

        .blocked-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: #dc2626;
            animation: shake 0.5s ease-in-out infinite alternate;
        }

        @keyframes shake {
            0% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(5px);
            }
        }

        .blocked-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .blocked-message {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .rejection-details {
            background: #fef2f2;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #dc2626;
        }

        .rejection-details h3 {
            color: #dc2626;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .rejection-reasons {
            text-align: left;
            color: #7f1d1d;
            line-height: 1.8;
        }

        .rejection-reasons li {
            margin-bottom: 0.5rem;
        }

        .next-steps {
            background: #f0f9ff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #0ea5e9;
        }

        .next-steps h3 {
            color: #0369a1;
            margin-bottom: 1rem;
        }

        .next-steps ul {
            text-align: left;
            color: #0c4a6e;
            line-height: 1.8;
        }

        .next-steps li {
            margin-bottom: 0.5rem;
        }

        .contact-info {
            background: #f9fafb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .contact-info h3 {
            color: #374151;
            margin-bottom: 1rem;
        }

        .contact-info p {
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .reapply-btn {
            background: linear-gradient(135deg, #10b981, #059669);
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

        .reapply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .contact-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .logout-link {
            color: #6b7280;
            text-decoration: none;
            margin-top: 1rem;
            display: block;
            font-size: 0.9rem;
        }

        .logout-link:hover {
            color: #374151;
            text-decoration: underline;
        }

        .status-badge {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .reapply-btn,
            .contact-btn {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="blocked-container">
        <div class="blocked-icon">❌</div>

        <div class="status-badge">Account Rejected</div>

        <h1 class="blocked-title">Registration Declined</h1>

        <p class="blocked-message">
            We're sorry, but your registration request has been declined by our administrators.
            This decision was made after careful review of your submitted information.
        </p>

        <div class="rejection-details">
            <h3>🚫 Common Rejection Reasons</h3>
            <ul class="rejection-reasons">
                <li>Invalid or unverifiable student registration number</li>
                <li>Incomplete or incorrect personal information</li>
                <li>Non-matching college email domain</li>
                <li>Duplicate account registration</li>
                <li>Violation of platform terms and conditions</li>
            </ul>
        </div>

        <div class="next-steps">
            <h3>🔄 What You Can Do</h3>
            <ul>
                <li>Review and correct your registration information</li>
                <li>Ensure your student ID and email are valid</li>
                <li>Contact the admin team for specific rejection reasons</li>
                <li>Reapply with correct and complete information</li>
                <li>Visit the college office for manual verification if needed</li>
            </ul>
        </div>

        <div class="contact-info">
            <h3>📞 Get Help</h3>
            <p><strong>Email:</strong> canteen.admin@college.edu</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Office:</strong> Student Services, Ground Floor</p>
            <p><strong>Hours:</strong> Mon-Fri, 9:00 AM - 5:00 PM</p>
        </div>

        <div class="action-buttons">
            <a href="<?= ROOT ?>register" class="reapply-btn">
                🔄 Reapply Now
            </a>
            <a href="mailto:canteen.admin@college.edu" class="contact-btn">
                📧 Contact Admin
            </a>
        </div>

        <a href="<?= ROOT ?>students/login" class="logout-link">← Return to Login Page</a>
    </div>

    <script>
        // Log the rejection for analytics
        console.log('User account rejected - showing rejection page');

        // Optional: Track rejection reasons for improvement
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Rejection page loaded at:', new Date().toISOString());
        });
    </script>
</body>

</html>