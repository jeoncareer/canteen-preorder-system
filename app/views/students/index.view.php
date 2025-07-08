<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Preorder System</title>

    <link rel="stylesheet" href="<?=ROOT?>assets/css/index.css">

    <style>
         .cart-panel {
            width: 400px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .cart-header {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .cart-title {
            font-size: 18px;
            font-weight: 600;
        }

        .cart-items {
            padding: 20px;
            max-height: 400px;
            overflow-y: auto;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .item-details {
            flex: 1;
            margin-right: 15px;
        }

        .item-name {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin-bottom: 4px;
        }

        .item-price {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .quantity-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #f5f5f5;
            border-color: #ff6b6b;
            color: #ff6b6b;
        }

        .quantity {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            min-width: 20px;
            text-align: center;
        }

        .item-total {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            min-width: 60px;
            text-align: right;
        }

        .cart-summary {
            padding: 20px;
            border-top: 1px solid #eee;
            background: #f9f9f9;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
            color: #666;
        }

        .summary-total {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            padding-top: 12px;
            border-top: 1px solid #ddd;
            margin-top: 8px;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #ff5252, #ff7979);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        }

        .remove-btn {
            background: #ff4757;
            color: white;
            border: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            transition: all 0.2s;
        }

        .remove-btn:hover {
            background: #ff3742;
            transform: scale(1.1);
        }

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .empty-cart-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        /* Scrollbar styling */
        .cart-items::-webkit-scrollbar {
            width: 6px;
        }

        .cart-items::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb:hover {
            background: #999;
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
                        <!-- <div class="cart-panel">
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
                            <div class="cart-summary" id="cart-summary" >
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
                        </div> -->

                        <div class="cart-panel">
        <div class="cart-header">
            <span class="cart-title">🛒 Your Order</span>
        </div>
        <div class="cart-items" id="cart-items">
            <!-- Cart Item 1 -->
            <div class="cart-item">
                <div class="item-image">🍛</div>
                <div class="item-details">
                    <div class="item-name">Idli</div>
                    <div class="item-price">₹10 each</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(this)">−</button>
                        <span class="quantity">2</span>
                        <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                    </div>
                </div>
                <div class="item-total">₹20</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- Cart Item 2 -->
            <div class="cart-item">
                <div class="item-image">🍚</div>
                <div class="item-details">
                    <div class="item-name">Dosa</div>
                    <div class="item-price">₹10 each</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(this)">−</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                    </div>
                </div>
                <div class="item-total">₹10</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- Cart Item 3 -->
            <div class="cart-item">
                <div class="item-image">🍛</div>
                <div class="item-details">
                    <div class="item-name">Biriyani</div>
                    <div class="item-price">₹150 each</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(this)">−</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                    </div>
                </div>
                <div class="item-total">₹150</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- Cart Item 4 -->
            <div class="cart-item">
                <div class="item-image">🍛</div>
                <div class="item-details">
                    <div class="item-name">Appam</div>
                    <div class="item-price">₹10 each</div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="decreaseQuantity(this)">−</button>
                        <span class="quantity">3</span>
                        <button class="quantity-btn" onclick="increaseQuantity(this)">+</button>
                    </div>
                </div>
                <div class="item-total">₹30</div>
                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>
        </div>

        <div class="cart-summary" id="cart-summary">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span id="subtotal">₹210</span>
            </div>
            <div class="summary-row">
                <span>Tax (5%):</span>
                <span id="tax">₹10.50</span>
            </div>
            <div class="summary-row summary-total">
                <span>Total:</span>
                <span id="total">₹220.50</span>
            </div>
            <button class="checkout-btn" id="checkout-btn" onclick="checkout()">
                Place Order
            </button>
        </div>
    </div>


                    </div>
                </div>

          
              
                                

                                    </body>

                                    <script>
                                        
                              
                                                                        

                                    </script>
</html>