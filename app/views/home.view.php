<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Campus Canteen - Smart Preorder System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #333;
      line-height: 1.6;
      overflow-x: hidden;
    }

    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      padding: 1rem 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .logo-nav {
      font-size: 1.5rem;
      font-weight: 700;
      color: #667eea;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .admin-btn {
      padding: 0.6rem 1.5rem;
      background: transparent;
      border: 2px solid #667eea;
      color: #667eea;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
      font-size: 0.9rem;
    }

    .admin-btn:hover {
      background: #667eea;
      color: white;
      transform: translateY(-2px);
    }

    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 6rem 5% 4rem 5%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      top: -200px;
      right: -200px;
      animation: float 6s ease-in-out infinite;
    }

    .hero::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      bottom: -150px;
      left: -150px;
      animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0) rotate(0deg);
      }

      50% {
        transform: translateY(-30px) rotate(5deg);
      }
    }

    .hero-content {
      max-width: 1200px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
      z-index: 1;
    }

    .hero-text {
      color: white;
    }

    .hero-text h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      line-height: 1.2;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-text p {
      font-size: 1.3rem;
      margin-bottom: 2.5rem;
      color: rgba(255, 255, 255, 0.95);
      line-height: 1.8;
    }

    .hero-image {
      position: relative;
      width: 100%;
      height: 450px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .hero-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 18px;
    }



    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.1);
      }
    }

    .placeholder-text {
      position: absolute;
      font-size: 1.2rem;
      color: rgba(255, 255, 255, 0.8);
      font-weight: 600;
      text-align: center;
      padding: 1rem;
    }

    .features {
      padding: 5rem 5%;
      background: white;
    }

    .section-title {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 3rem;
      color: #333;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2.5rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .feature-card {
      background: white;
      padding: 2.5rem 2rem;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s;
      border: 2px solid transparent;
      text-align: center;
    }

    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 40px rgba(102, 126, 234, 0.2);
      border-color: #667eea;
    }

    .feature-icon {
      font-size: 3.5rem;
      margin-bottom: 1.5rem;
      display: block;
    }

    .feature-card h3 {
      font-size: 1.4rem;
      margin-bottom: 1rem;
      color: #333;
    }

    .feature-card p {
      color: #666;
      line-height: 1.7;
    }

    .cta-section {
      padding: 5rem 5%;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .cta-content {
      max-width: 1000px;
      margin: 0 auto;
      text-align: center;
    }

    .cta-content h2 {
      font-size: 2.8rem;
      margin-bottom: 1.5rem;
      color: #333;
    }

    .cta-content p {
      font-size: 1.2rem;
      color: #666;
      margin-bottom: 3rem;
    }

    .role-buttons {
      display: flex;
      gap: 2rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    .role-button {
      display: flex;
      flex-direction: column;
      align-items: center;
      background: white;
      color: #667eea;
      text-decoration: none;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 16px;
      padding: 2.5rem 3rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      transition: all 0.3s;
      border: 3px solid #667eea;
      min-width: 220px;
      cursor: pointer;
    }

    .role-button:hover {
      transform: translateY(-8px) scale(1.05);
      box-shadow: 0 16px 50px rgba(102, 126, 234, 0.3);
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .role-icon {
      font-size: 3.5rem;
      margin-bottom: 1rem;
      transition: transform 0.3s;
    }

    .role-button:hover .role-icon {
      transform: scale(1.2) rotate(5deg);
    }

    .how-it-works {
      padding: 5rem 5%;
      background: white;
    }

    .steps {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 3rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .step {
      text-align: center;
      position: relative;
    }

    .step-number {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 700;
      margin: 0 auto 1.5rem;
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .step h3 {
      font-size: 1.3rem;
      margin-bottom: 1rem;
      color: #333;
    }

    .step p {
      color: #666;
      line-height: 1.7;
    }

    .image-showcase {
      padding: 5rem 5%;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .showcase-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 3rem auto 0;
    }

    .showcase-item {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .showcase-item:hover {
      transform: translateY(-10px);
    }

    .showcase-image {
      width: 100%;
      height: 250px;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
    }

    .showcase-text {
      padding: 1.5rem;
      text-align: center;
    }

    .showcase-text h4 {
      font-size: 1.2rem;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .showcase-text p {
      color: #666;
      font-size: 0.95rem;
    }

    footer {
      background: #2d3748;
      color: white;
      text-align: center;
      padding: 2rem 5%;
    }

    footer p {
      color: rgba(255, 255, 255, 0.8);
    }

    @media (max-width: 968px) {
      .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .hero-text h1 {
        font-size: 2.5rem;
      }

      .hero-text p {
        font-size: 1.1rem;
      }

      .hero-image {
        height: 350px;
      }

      .navbar {
        padding: 1rem 3%;
      }

      .role-buttons {
        flex-direction: column;
        align-items: center;
      }

      .role-button {
        width: 100%;
        max-width: 300px;
      }
    }

    @media (max-width: 600px) {
      .hero {
        padding: 5rem 3% 3rem 3%;
      }

      .hero-text h1 {
        font-size: 2rem;
      }

      .hero-text p {
        font-size: 1rem;
      }

      .section-title {
        font-size: 2rem;
      }

      .cta-content h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="logo-nav">
      🍽️ Campus Canteen
    </div>
    <a href="/canteen-preorder-system/public/Admin/login" class="admin-btn">Admin Login</a>
  </nav>

  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h1>Skip the Line, Savor the Time</h1>
        <p>Pre-order your favorite meals and pick them up without the wait. Campus dining made simple, smart, and delicious.</p>
      </div>
      <div class="hero-image">
        <img src="assets/images/intro2.png" alt="">
      </div>
    </div>
  </section>

  <section class="features">
    <h2 class="section-title">Why Choose Our System?</h2>
    <div class="features-grid">
      <div class="feature-card">
        <span class="feature-icon">⚡</span>
        <h3>Lightning Fast</h3>
        <p>Order in seconds and skip the queue. Your meal is ready when you arrive.</p>
      </div>
      <div class="feature-card">
        <span class="feature-icon">📱</span>
        <h3>Easy to Use</h3>
        <p>Simple, intuitive interface designed for busy students and staff.</p>
      </div>
      <div class="feature-card">
        <span class="feature-icon">⭐</span>
        <h3>Save Favorites</h3>
        <p>Quickly reorder your go-to meals with just one tap.</p>
      </div>
      <div class="feature-card">
        <span class="feature-icon">🍽️</span>
        <h3>Wide Variety</h3>
        <p>Diverse menu options to satisfy every taste and preference.</p>
      </div>
      <div class="feature-card">
        <span class="feature-icon">✨</span>
        <h3>Fresh Quality</h3>
        <p>All meals prepared fresh with quality ingredients daily.</p>
      </div>
    </div>
  </section>

  <section class="how-it-works">
    <h2 class="section-title">How It Works</h2>
    <div class="steps">
      <div class="step">
        <div class="step-number">1</div>
        <h3>Browse Menu</h3>
        <p>Explore available dishes and choose your favorites from our diverse menu.</p>
      </div>
      <div class="step">
        <div class="step-number">2</div>
        <h3>Place Order</h3>
        <p>Select items, customize your order, and choose your pickup time.</p>
      </div>
      <div class="step">
        <div class="step-number">3</div>
        <h3>Get Notified</h3>
        <p>Receive confirmation and updates when your order is being prepared.</p>
      </div>
      <div class="step">
        <div class="step-number">4</div>
        <h3>Pick Up & Enjoy</h3>
        <p>Grab your fresh meal and enjoy – no waiting in line required!</p>
      </div>
    </div>
  </section>

  <section class="image-showcase">
    <h2 class="section-title">Experience the Difference</h2>
    <div class="showcase-grid">
      <div class="showcase-item">
        <div class="showcase-image">🍕</div>
        <div class="showcase-text">
          <h4>Fresh Ingredients</h4>
          <p>Quality meals prepared with care</p>
        </div>
      </div>
      <div class="showcase-item">
        <div class="showcase-image">⏱️</div>
        <div class="showcase-text">
          <h4>Time Saver</h4>
          <p>More time for what matters</p>
        </div>
      </div>
      <div class="showcase-item">
        <div class="showcase-image">😊</div>
        <div class="showcase-text">
          <h4>Happy Students</h4>
          <p>Satisfied customers every day</p>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section">
    <div class="cta-content">
      <h2>Ready to Get Started?</h2>
      <p>Join hundreds of students and staff who are already enjoying hassle-free dining</p>
      <div class="role-buttons">
        <a href="/canteen-preorder-system/public/Students/signup" class="role-button">
          <span class="role-icon">🎓</span>
          I'm a Student
        </a>
        <a href="/canteen-preorder-system/public/Canteen/signup" class="role-button">
          <span class="role-icon">👨‍🍳</span>
          I'm Canteen Staff
        </a>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Campus Canteen Preorder System. All rights reserved.</p>
  </footer>
</body>

</html>