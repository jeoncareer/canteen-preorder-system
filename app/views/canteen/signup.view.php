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
        <form action="<?= ROOT ?>canteen/signin" method="post">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-input" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label class="form-label">College Name</label>
                <input type="text" class="form-input" name="college_name" list="colleges" placeholder="Enter your college name" required>
                <datalist id="colleges">
                    <?php foreach ($colleges as $college): ?>
                        <option value="<?= $college ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Create a password" required>
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