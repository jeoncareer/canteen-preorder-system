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

        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🍽️</span> Campus Canteen
            </div>
        </div>

        <div class="auth-container">

            <div class="auth-header">
                <h1 class="auth-title">Welcome!</h1>
                <p class="auth-subtitle">Create a new Account</p>
            </div>

            <form action="<?= ROOT ?>canteen/register" method="post">

                <!-- Email -->
                <div class="form-group">
                    <input name="email" type="email" class="form-input" placeholder=" " required>
                    <label class="form-label">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Canteen Name -->
                <div class="form-group">
                    <input type="text" name="canteen_name" class="form-input" placeholder=" " required>
                    <label class="form-label">Canteen Name</label>
                    <?php if (!empty($errors['canteen_name'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['canteen_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- College Select -->
                <div class="form-group">
                    <select class="form-input" name="college_id" required>
                        <option value="" disabled selected></option>
                        <?php foreach ($colleges as $college): ?>
                            <option value="<?= $college->id ?>"><?= $college->college_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="form-label">College Name</label>
                    <?php if (!empty($errors['college_id'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['college_id'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder=" " required>
                    <label class="form-label">Password</label>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['password'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="submit-btn">Create</button>
            </form>

            <div class="divider"><span>or</span></div>

            <div class="auth-switch">
                Already have an account? <a href="<?= ROOT ?>canteen/login">Login Here</a>
            </div>
            <div class="back-home">
                <a href="<?= ROOT ?>">
                    ← Back to Home
                </a>
            </div>
        </div>
    </div>
</body>

</html>