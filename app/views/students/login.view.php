<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
    <style>

    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🍽️</span>
                Campus Canteen
            </div>
        </div>

        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Welcome Back!</h1>
                <p class="auth-subtitle">Login to your account</p>
            </div>

            <!-- Error Message Example - Remove 'style="display: none;"' to show -->
            <!-- <div class="error-message">
                <span class="error-icon">⚠️</span>
                <span></span>
            </div>

            <div class="error-message">
                <span class="error-icon">⚠️</span>
                <span></span>
            </div> -->



            <!-- Success Message Example - Remove 'style="display: none;"' to show -->


            <form action="<?= ROOT ?>students/login" method="post">
                <div class="form-group">
                    <input type="email" class="form-input" name="email" placeholder="Email Address" required>
                    <label class="form-label">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <label class="form-label">Password</label>
                </div>

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <div class="divider">
                <span>or</span>
            </div>

            <div class="auth-switch">
                Don't have an account? <a href="./register">Register Here</a>
            </div>
        </div>

        <div class="back-home">
            <a href="<?= ROOT ?>">← Back to Home</a>
        </div>
    </div>
</body>

</html>