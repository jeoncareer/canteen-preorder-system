<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
</head>

<body>
    <div class="login-wrapper">
        <!-- Logo Section -->
        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🍴</span>
                Campus Canteen
            </div>
        </div>

        <!-- Login Form -->
        <form action="<?= ROOT ?>admin/login" method="post">
            <div class="auth-container">
                <div class="auth-header">
                    <h1 class="auth-title">Welcome!</h1>
                    <p class="auth-subtitle">Login to your account</p>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email" value="<?= $email ?? '' ?>" required>
                    <label class="form-label">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <label class="form-label">Password</label>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['password'] ?>, Try Again
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Login</button>

                <!-- Divider -->
                <div class="divider">
                    <span>or</span>
                </div>

                <!-- Switch to Register -->
                <div class="auth-switch">
                    Don't have an account?
                    <a href="<?= ROOT ?>admin/register">Register Here</a>
                </div>

                <!-- Back Home -->
                <div class="back-home">
                    <a href="<?= ROOT ?>">
                        ← Back to Home
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>