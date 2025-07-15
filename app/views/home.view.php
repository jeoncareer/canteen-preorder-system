<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome - Canteen Preorder System</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }

    .container {
      background: white;
      padding: 3rem;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      margin-bottom: 50px;
    }

    h1 {
      margin-bottom: 2rem;
      color: #333;
    }

    .role-button {
      display: inline-block;
      margin: 1rem;
      padding: 1rem 2rem;
      background: #ff6b6b;
      color: white;
      text-decoration: none;
      font-size: 1.2rem;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .role-button:hover {
      background: rgb(248, 149, 149);
    }

    @media (max-width: 600px) {
      .role-button {
        display: block;
        margin: 1rem auto;
        width: 80%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Welcome! Who are you?</h1>
    <a href="/canteen-preorder-system/public/Students/signup" class="role-button">I am a Student</a>
    <a href="/canteen-preorder-system/public/CanteenStaff/signup" class="role-button">I am a Canteen Staff</a>
  </div>
</body>

</html>