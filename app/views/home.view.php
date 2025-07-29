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
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7fafd;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background: #fff;
      padding: 3rem 2.5rem 2.5rem 2.5rem;
      border-radius: 22px;
      box-shadow: 0 8px 40px rgba(0, 0, 0, 0.13), 0 1.5px 0 #4f46e5;
      text-align: center;
      min-width: 320px;
      max-width: 95vw;
      border-top: 6px solid #4f46e5;
      transition: box-shadow 0.2s;
    }

    .container:hover {
      box-shadow: 0 16px 64px rgba(0, 0, 0, 0.18), 0 1.5px 0 #4f46e5;
    }

    .logo {
      font-size: 2.2rem;
      font-weight: bold;
      color: #4f46e5;
      margin-bottom: 1.5rem;
      letter-spacing: 1px;
    }

    h1 {
      margin-bottom: 2rem;
      color: #222;
      font-size: 1.7rem;
      font-weight: 600;
    }

    .role-buttons {
      display: flex;
      gap: 2rem;
      justify-content: center;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
    }

    .role-button {
      display: flex;
      flex-direction: column;
      align-items: center;
      background: #f7fafd;
      color: #4f46e5;
      text-decoration: none;
      font-size: 1.15rem;
      font-weight: 500;
      border-radius: 12px;
      padding: 2rem 2.5rem;
      box-shadow: 0 2px 12px rgba(255, 107, 107, 0.08);
      transition: transform 0.15s, box-shadow 0.15s, background 0.15s, color 0.15s;
      border: 2px solid #4f46e5;
      outline: none;
      min-width: 180px;
      cursor: pointer;
    }

    .role-button:hover,
    .role-button:focus {
      transform: translateY(-4px) scale(1.04);
      box-shadow: 0 8px 32px rgba(255, 107, 107, 0.16);
      background: #4f46e5;
      color: #fff;
    }

    .role-icon {
      font-size: 2.5rem;
      margin-bottom: 0.7rem;
      color: #4f46e5;
      transition: color 0.15s;
    }

    .role-button:hover .role-icon,
    .role-button:focus .role-icon {
      color: #fff;
    }

    .footer {
      margin-top: 2rem;
      color: #888;
      font-size: 0.98rem;
    }

    @media (max-width: 600px) {
      .container {
        padding: 1.5rem 0.5rem;
      }

      .role-buttons {
        flex-direction: column;
        gap: 1.2rem;
      }

      .role-button {
        width: 100%;
        min-width: unset;
        padding: 1.2rem 0.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">🍽️ Campus Canteen</div>
    <h1>Welcome! Who are you?</h1>
    <div class="role-buttons">
      <a href="/canteen-preorder-system/public/Students/signup" class="role-button">
        <span class="role-icon">🎓</span>
        I am a Student
      </a>
      <a href="/canteen-preorder-system/public/Canteen/signup" class="role-button">
        <span class="role-icon">👨‍🍳</span>
        I am a Canteen Staff
      </a>
    </div>
    <div class="footer">
      &copy; 2025 Canteen Preorder System
    </div>
  </div>
</body>

</html>