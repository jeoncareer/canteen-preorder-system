<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Register</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/auth.css">
    <style>

    </style>
</head>

<body>
    <div class="logo">Campus Canteen</div>

    <div class="auth-container">
        <div class="auth-header">
            <h1 class="auth-title">Welcome!</h1>
            <p class="auth-subtitle">Create a new Account</p>
        </div>

        <form method="post" action="<?= ROOT ?>students/signup">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-input" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label class="form-label">College Name</label>

                <select class="form-input" name="college_name" placeholder="Enter your college name" required>
                    <option disabled selected>Select College</option>
                    <?php foreach ($colleges as $college): ?>
                        <option value=""><?= $college ?></option>
                    <?php endforeach; ?>
                </select>
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
            Already have an account? <a href="./login">Login Here</a>
        </div>
    </div>
</body>

</html>