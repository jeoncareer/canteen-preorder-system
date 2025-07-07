<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Preorder System</title>
    <link rel="stylesheet" href="<?=ROOT?>assets/css/sidebar.css">
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

        .app-container {
           
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
        }

       

        .balance-card {
            background: rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            min-width: 150px;
        }

        .balance-amount {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

     

        .main-content {
            display: flex;
            min-height: calc(100vh - 120px);
        }

        

        .page-title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
        }

        .menu-categories {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .category-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        }

        .category-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #ecf0f1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .menu-item {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            border: 2px solid #f1f3f4;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .menu-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            border-color: #ff6b6b;
        }

        .menu-item.selected {
            border-color: #ff6b6b;
            background: linear-gradient(135deg, #fff5f5, #ffffff);
            box-shadow: 0 8px 25px rgba(255,107,107,0.2);
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .item-name {
            font-weight: 700;
            font-size: 18px;
            color: #2c3e50;
        }

        .item-price {
            font-weight: bold;
            color: #27ae60;
            font-size: 18px;
        }

        .item-description {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .item-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .availability {
            padding: 6px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .available {
            background: #d4edda;
            color: #155724;
        }

        .limited {
            background: #fff3cd;
            color: #856404;
        }

        .unavailable {
            background: #f8d7da;
            color: #721c24;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #ff6b6b;
            background: white;
            color: #ff6b6b;
            border-radius: 50%;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover:not(:disabled) {
            background: #ff6b6b;
            color: white;
            transform: scale(1.1);
        }

        .qty-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .quantity {
            font-weight: bold;
            font-size: 18px;
            min-width: 40px;
            text-align: center;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .cart-panel {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            position: sticky;
            top: 40px;
            height: fit-content;
        }

        .cart-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }

        .cart-title {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
        }

        .cart-items {
            margin-bottom: 25px;
            max-height: 400px;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .cart-item-price {
            color: #7f8c8d;
            font-size: 14px;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-summary {
            border-top: 2px solid #f1f3f4;
            padding-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 20px;
            color: #2c3e50;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }

        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .checkout-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255,107,107,0.4);
        }

        .checkout-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: #7f8c8d;
        }

        .empty-cart-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
        }

        .order-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }

        .order-id {
            font-weight: bold;
            font-size: 18px;
            color: #2c3e50;
        }

        .order-status {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-preparing {
            background: #cce5ff;
            color: #004085;
        }

        .status-ready {
            background: #d4edda;
            color: #155724;
        }

        .order-items {
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #5a6c7d;
        }

        .order-meta {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .order-total {
            font-weight: bold;
            color: #27ae60;
            font-size: 20px;
            text-align: right;
        }

        .search-bar {
            width: 100%;
            max-width: 500px;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            font-size: 16px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            outline: none;
            border-color: #ff6b6b;
            box-shadow: 0 0 0 4px rgba(255,107,107,0.1);
        }

        @media (max-width: 1200px) {
            .menu-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .cart-panel {
                position: relative;
                top: 0;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            .content-area {
                padding: 20px;
            }
            
            .menu-items-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Header -->
    <!-- ?php $page = 'menu' ;
    require __DIR__ .'/../header.view.php';?  -->

    <?php
    require 'header.view.php';
    ?>

        <div class="main-content">
            <!-- Sidebar Navigation -->

            <?php require 'sidebar.view.php'; ?>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Menu Page -->
                <div id="menu-page" class="page active">
                    <div class="page-title">
                        <span>🍽️</span>
                        <span>Today's Menu</span>
                    </div>
                    
                    <input type="text" class="search-bar" placeholder="Search for dishes..." id="searchInput" oninput="searchItems()">
                    
                    <div class="menu-grid">
                        <div class="menu-categories">
                            <!-- Main Course -->
                             <?php foreach ($grouped as $key => $values):?>
                            <div class="category-section">
                                <h2 class="category-title">
                                    <span>🍛</span>
                                    <span><?=$key?></span>
                                </h2>
                                <div class="menu-items-grid">
                                    <?php foreach ($values as $value):?>

                                        <div class="menu-item" data-item="biryani" data-price="85" data-name="Chicken Biryani">
                                            <div class="item-header">
                                                <div class="item-name"><?=ucwords($value->item_name)?></div>
                                                <div class="item-price">₹<?=$value->price?></div>
                                            </div>
                                            <div class="item-description">Fragrant basmati rice with tender chicken, aromatic spices, and boiled egg. Served with raita and pickle.</div>
                                            <div class="item-footer">
                                                <div class="availability available">Available</div>
                                                <div class="quantity-controls">
                                                    <button class="qty-btn"  onclick="updateQuantity('<?=$value->item_id?>','<?=$_SESSION['STUDENT']->id?>', -1)">−</button>
                                                    <span class="quantity" id="qty-<?=$value->item_id?>">0</span>
                                                    <button class="qty-btn" onclick="updateQuantity('<?=$value->item_id?>','<?=$_SESSION['STUDENT']->id?>', 1)">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                              

                                 
                                </div>
                            </div>

                            <?php endforeach;?>

                            

                     
                        </div>

                        <!-- Cart Panel -->
                        <div class="cart-panel">
                            <div class="cart-header">
                                <span class="cart-title">🛒 Your Order</span>
                            </div>
                            <div class="cart-items" id="cart-items">
                                <div class="empty-cart">
                                    <div class="empty-cart-icon">🛒</div>
                                    <p>Your cart is empty</p>
                                    <p style="font-size: 14px; margin-top: 8px;">Add items from the menu to get started</p>
                                </div>
                            </div>
                            <div class="cart-summary" id="cart-summary" style="display: none;">
                                <div class="summary-row">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">₹0</span>
                                </div>
                                <div class="summary-row">
                                    <span>Tax (5%):</span>
                                    <span id="tax">₹0</span>
                                </div>
                                <div class="summary-row summary-total">
                                    <span>Total:</span>
                                    <span id="total">₹0</span>
                                </div>
                                <button class="checkout-btn" id="checkout-btn" onclick="checkout()">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Page -->
                <div id="orders-page" class="page" style="display: none;">
                    <div class="page-title">
                        <span>📋</span>
                        <span>My Orders</span>
                    </div>
                    
                    <div class="orders-grid">
                        <div class="order-card">
                            <div class="order-header">
                                <div class="order-id">#ORD-001234</div>
                                <div class="order-status status-ready">Ready</div>
                            </div>
                            <div class="order-items">
                                <div class="order-item">
                                    <span>Chicken Biryani × 1</span>
                                    <span>₹85</span>
                                </div>
                                

                                    </body>

                                    <script>
                                        
                              
                                                                        

                                    </script>
</html>