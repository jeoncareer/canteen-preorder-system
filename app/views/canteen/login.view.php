<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">

    <style>
        .error-msg {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 6px;
            display: block;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🍽️</span> Campus Canteen
            </div>
        </div>

        <div class="auth-container">

            <div class="auth-header">
                <h1 class="auth-title">Welcome!</h1>
                <p class="auth-subtitle">Login to your account</p>
            </div>

            <form action="<?= ROOT ?>canteen/login" method="post">

                <!-- Email -->
                <div class="form-group">
                    <input type="email" class="form-input" name="email" placeholder=" " required>
                    <label class="form-label">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <small class="error-msg"><?= $errors['email'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder=" " required>
                    <label class="form-label">Password</label>
                    <?php if (!empty($errors['password'])): ?>
                        <small class="error-msg"><?= $errors['password'] ?></small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <div class="divider">
                <span>or</span>
            </div>

            <div class="auth-switch">
                Don't have an account? <a href="<?= ROOT ?>canteen/register">Register Here</a>
            </div>

        </div>

    </div>

</body>

</html>