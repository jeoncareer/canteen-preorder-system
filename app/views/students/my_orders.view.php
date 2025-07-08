<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - My Orders</title>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?=ROOT?>assets/css/my-orders.css">
    <style>
 


      



       


    </style>
</head>
<body>
  <?php require 'header.view.php' ?>

    <div class="container">
    <?php require 'sidebar.view.php' ?>

        <div class="main-content">
            <div class="page-header">
                <h2>My Orders</h2>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Search for orders...">
            </div>

            <div class="orders-section">
                <div class="section-title">Current Orders</div>

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-001</div>
                            <div class="order-time">Today, 11:30 AM</div>
                        </div>
                        <div class="order-status status-ready">READY</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Chicken Biryani</div>
                                <div class="item-specs">Qty: 1 | Spice Level: Medium</div>
                            </div>
                            <div class="item-price">₹180</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Mango Lassi</div>
                                <div class="item-specs">Qty: 1 | Size: Large</div>
                            </div>
                            <div class="item-price">₹60</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Pickup: Counter 2 - Main Canteen</div>
                            <div>Status: Ready for collection</div>
                        </div>
                        <div class="order-total">Total: ₹240</div>
                        <div class="order-actions">
                            <button class="btn btn-primary">✓ Pick Up</button>
                            <button class="btn btn-secondary">View Details</button>
                        </div>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-002</div>
                            <div class="order-time">Today, 12:15 PM</div>
                        </div>
                        <div class="order-status status-preparing">PREPARING</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Veg Burger</div>
                                <div class="item-specs">Qty: 2 | Add-ons: Extra Cheese</div>
                            </div>
                            <div class="item-price">₹120</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">French Fries</div>
                                <div class="item-specs">Qty: 1 | Size: Medium</div>
                            </div>
                            <div class="item-price">₹80</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Pickup: Counter 1 - Main Canteen</div>
                            <div>Status: Being prepared</div>
                        </div>
                        <div class="order-total">Total: ₹200</div>
                        <div class="order-actions">
                            <button class="btn btn-secondary">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- 
        <div class="order-sidebar">
            <div class="balance-info">
                <div class="balance-amount">₹245.50</div>
                <div class="balance-label">Wallet Balance</div>
            </div>

            <div class="order-sidebar-title">Your Order</div>
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <div>Your cart is empty</div>
                <div style="font-size: 14px; margin-top: 10px;">Add items from the menu to get started</div>
            </div>
        </div> -->
    </div>
</body>
</html>