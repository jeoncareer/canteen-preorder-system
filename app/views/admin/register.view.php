<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Register</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
</head>

<body>
    <div class="login-wrapper">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🍴</span>
                Campus Canteen
            </div>
        </div>

        <!-- Register Container -->
        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Welcome!</h1>
                <p class="auth-subtitle">Create a new account</p>
            </div>

            <form method="post" action="<?= ROOT ?>admin/register">

                <!-- Email -->
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email" value="<?= $values['email'] ?? '' ?>" required>
                    <label class="form-label">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- College Name -->
                <div class="form-group">
                    <input type="text" name="college_name" class="form-input" placeholder="College Name" value="<?= $values['college_name'] ?? '' ?>" autocomplete="off" required>
                    <label class="form-label">College Name</label>
                    <?php if (!empty($errors['college_name'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['college_name'] ?>
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
                <button type="submit" class="submit-btn">Create Account</button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>or</span>
            </div>

            <!-- Switch to Login -->
            <div class="auth-switch">
                Already have an account?
                <a href="<?= ROOT ?>admin/login">Login Here</a>
            </div>

            <!-- Back to Home -->
            <div class="back-home">
                <a href="<?= ROOT ?>">
                    ← Back to Home
                </a>
            </div>
        </div>
    </div>
</body>

</html>