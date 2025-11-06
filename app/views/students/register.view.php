<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Student Register</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
</head>

<body>
    <div class="login-wrapper">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-text">
                <span class="logo-icon">🎓</span>
                Campus Canteen
            </div>
        </div>

        <!-- Registration Container -->
        <div class="auth-container">
            <div class="auth-header">
                <h1 class="auth-title">Welcome!</h1>
                <p class="auth-subtitle">Create a new student account</p>
            </div>

            <form method="post" action="<?= ROOT ?>students/register">

                <!-- Name -->
                <div class="form-group">
                    <input name="student_name" type="text" class="form-input" placeholder="Your Name" value="<?= $values['student_name'] ?? '' ?>" required>
                    <label class="form-label">Name</label>
                    <?php if (!empty($errors['student_name'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['student_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input name="email" type="email" class="form-input" placeholder="Email" value="<?= $values['email'] ?? '' ?>" required>
                    <label class="form-label">Email</label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['email'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Register Number -->
                <div class="form-group">
                    <input name="reg_no" type="text" class="form-input" placeholder="Register Number" value="<?= $values['reg_no'] ?? '' ?>" required>
                    <label class="form-label">Register No:</label>
                    <?php if (!empty($errors['reg_no'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['reg_no'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- College -->
                <div class="form-group">
                    <select name="college_id" class="form-input" required>
                        <option disabled selected>Select College</option>
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
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <label class="form-label">Password</label>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="error-message">
                            <span class="error-icon">⚠️</span>
                            <?= $errors['password'] ?>, Try Again
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn">Create Account</button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>or</span>
            </div>

            <!-- Switch to Login -->
            <div class="auth-switch">
                Already have an account?
                <a href="<?= ROOT ?>students/login">Login Here</a>
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