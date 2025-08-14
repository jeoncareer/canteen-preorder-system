<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Register</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
</head>

<body>
    <div class="logo">Campus Canteen</div>
    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">Welcome!</h1>
            <p class="auth-subtitle">Create a new Account</p>
        </div>
        <form action="<?= ROOT ?>canteen/register" method="post">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-input" placeholder="Enter your email" required>
                <?php if (!empty($errors['email'])): ?>

                    <small class="error-msg"><?= $errors['email'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Canteen Name</label>
                <input type="text" name="canteen_name" class="form-input" placeholder="Enter Canteen Name" required>
                <?php if (!empty($errors['canteen_name'])): ?>

                    <small class="error-msg"><?= $errors['canteen_name'] ?></small>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">College Name</label>
                <select class="form-input" name="college_id" placeholder="Enter your college name" required>
                    <option value="" disabled selected>Select College</option>
                    <?php foreach ($colleges as $college): ?>
                        <option value="<?= $college->id ?>"><?= $college->college_name ?></option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($errors['college_id'])): ?>

                    <small class="error-msg"><?= $errors['college_id'] ?></small>
                <?php endif; ?>

            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                <?php if (!empty($errors['password'])): ?>

                    <small class="error-msg"><?= $errors['password'] ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="submit-btn">Create</button>
        </form>
        <div class="divider">
            <span>or</span>
        </div>
        <div class="auth-switch">
            Already have an account? <a href="<?= ROOT ?>canteen/login">Login Here</a>
        </div>
    </div>
</body>

</html>