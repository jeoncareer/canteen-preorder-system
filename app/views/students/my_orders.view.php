<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - My Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
              font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
     
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .container {
            display: flex;
            
            margin: 0 auto;
            background-color: white;
            min-height: calc(100vh - 80px);
        }

        .sidebar {
            width: 200px;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            padding: 20px 0;
        }

        .sidebar-item {
            padding: 15px 25px;
            color: #666;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .sidebar-item.active {
            background-color: #fff5f5;
            color: #ff6b6b;
            border-right: 3px solid #ff6b6b;
        }

        .sidebar-item::before {
            content: "📋";
            font-size: 16px;
        }

        .sidebar-item:nth-child(1)::before {
            content: "🍽️";
        }

        .sidebar-item:nth-child(3)::before {
            content: "💳";
        }

        .sidebar-item:nth-child(4)::before {
            content: "📊";
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 24px;
            color: #333;
        }

        .page-header::before {
            content: "📋";
            font-size: 24px;
        }

        .search-bar {
            margin-bottom: 30px;
        }

        .search-bar input {
            width: 100%;
            max-width: 400px;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f8f9fa;
        }

        .search-bar input::placeholder {
            color: #999;
        }

        .orders-section {
            background-color: white;
        }

        .section-title {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: "📦";
            font-size: 20px;
        }

        .order-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-id {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .order-time {
            color: #666;
            font-size: 14px;
        }

        .order-status {
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-ready {
            background-color: #d4edda;
            color: #155724;
        }

        .status-preparing {
            background-color: #fff3cd;
            color: #856404;
        }

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            color: #333;
            margin-bottom: 4px;
        }

        .item-specs {
            font-size: 14px;
            color: #666;
        }

        .item-price {
            font-weight: bold;
            color: #28a745;
            font-size: 16px;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
        }

        .order-info {
            font-size: 14px;
            color: #666;
        }

        .order-total {
            font-weight: bold;
            color: #333;
            font-size: 18px;
        }

        .order-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #ff6b6b;
            color: white;
        }

        .btn-primary:hover {
            background-color: #ff5252;
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        .order-sidebar {
            width: 300px;
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 1px solid #e0e0e0;
        }

        .order-sidebar-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-sidebar-title::before {
            content: "🛒";
            font-size: 18px;
        }

        .empty-cart {
            text-align: center;
            color: #666;
            margin-top: 50px;
        }

        .empty-cart-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .balance-info {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .balance-amount {
            font-size: 24px;
            font-weight: bold;
            color: #28a745;
        }

        .balance-label {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
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