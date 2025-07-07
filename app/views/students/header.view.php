<link rel="stylesheet" href="<?=ROOT?>assets/css/header.css">
          <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h1>🍽️ Campus Canteen</h1>
                <!-- <p>Preorder System - Welcome back!</p> -->
            </div>
            <div class="header-right">
                <!-- <div class="balance-card">
                    <div class="balance-amount">₹245.50</div>
                    <div>Wallet Balance</div>
                </div> -->
                <div class="user-profile">
                    <div class="user-avatar"><?=ucfirst($_SESSION['STUDENT']->email[0])?></div>
                    <div>
                        <div style="font-weight: 600;"><?=$_SESSION['STUDENT']->email?></div>
                        <!-- <div style="font-size: 14px; opacity: 0.8;">Student ID: CS2021001</div> -->
                    </div>
                </div>
            </div>
        </div>

