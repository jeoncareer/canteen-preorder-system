<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Register</title>
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

    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">Welcome!</h1>
            <p class="auth-subtitle">Create a new Account</p>
        </div>

        <form method="post" action="<?= ROOT ?>admin/register">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" value="<?= $values['email'] ?? '' ?>" class=" form-input" placeholder="Enter your email" required>
                <?php if (!empty($errors['email'])): ?>

                    <small class="error-msg"><?= $errors['email'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">College Name</label>
                <input type="text" value="<?= $values['college_name'] ?? '' ?>" class=" form-input" name="college_name" placeholder="Enter your college name" autocomplete="off" required>
                <?php if (!empty($errors['college_name'])): ?>

                    <small class="error-msg"><?= $errors['college_name'] ?></small>
                <?php endif; ?>


            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                <?php if (!empty($errors['password'])): ?>

                    <small class="error-msg"><?= $errors['password'] ?>,Try Again</small>
                <?php endif; ?>
            </div>

            <button type="submit" class="submit-btn">Create</button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="auth-switch">
            Already have an account? <a href="./login">Login Here</a>
        </div>
    </div>
</body>

</html>