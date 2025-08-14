<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
    <style>
        .error-msg {
            color: red;
            font-size: 0.85rem;
            margin-top: 4px;
            display: block;
        }
    </style>
</head>

<body>
    <div class="logo">Campus Canteen</div>
    <form action="<?= ROOT ?>admin/login" method="post">
        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Welcome!</h1>
                <p class="auth-subtitle">Login to your account</p>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="<?= $email ?? '' ?>" name="email" placeholder="Enter your email" required>
                <?php if (!empty($errors['email'])): ?>

                    <small class="error-msg"><?= $errors['email'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                <?php if (!empty($errors['password'])): ?>

                    <small class="error-msg"><?= $errors['password'] ?>,Try Again</small>
                <?php endif; ?>
            </div>
            <button type="submit" class="submit-btn">Login</button>
            <div class="divider">
                <span>or</span>
            </div>
            <div class="auth-switch">
                Don't have an account? <a href="<?= ROOT ?>admin/register">Register Here</a>
            </div>
        </div>
    </form>
</body>

</html>