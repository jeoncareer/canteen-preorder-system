<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Preorder System</title>
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/index.css">

    <style>
        /* Override any remaining red/orange colors with bluish theme */
        .checkout-btn,
        .addCart-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .checkout-btn:hover,
        .addCart-btn:hover {
            background: linear-gradient(135deg, #5a67d8, #667eea) !important;
        }

        .cart-header {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
        }

        .quantity-btn:hover:not(:disabled),
        .qty-btn:hover:not(:disabled) {
            background: #667eea !important;
        }

        .menu-item:hover {
            border-color: #667eea !important;
        }

        .menu-item.selected {
            border-color: #667eea !important;
            background: linear-gradient(135deg, #f0f4ff, #ffffff) !important;
            box-shadow: 0 8px 25px rgba(103, 126, 234, 0.2) !important;
        }

        .search-bar:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 4px rgba(103, 126, 234, 0.1) !important;
        }
    </style>

    <script src="index.js" defer></script>



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

            <?php
            $page = 'menu';
            require 'sidebar.view.php';
            ?>

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
                            <?php foreach ($grouped as $key => $values): ?>
                                <div class="category-section">
                                    <h2 class="category-title">
                                        <span>🍛</span>
                                        <span><?= $key ?></span>
                                    </h2>
                                    <div class="menu-items-grid">
                                        <?php foreach ($values as $value): ?>


                                            <div class="menu-item" data-item-id="<?= $value->item_id ?>">
                                                <div class="item-header">
                                                    <div class="item-name"><?= ucwords($value->item_name) ?></div>
                                                    <div class="item-price">₹<?= $value->price ?></div>
                                                </div>
                                                <div class="item-description">Fragrant basmati rice with tender chicken, aromatic spices, and boiled egg. Served with raita and pickle.</div>
                                                <div class="item-footer">
                                                    <div class="availability available">Available</div>

                                                </div>
                                            </div>
                                        <?php endforeach; ?>



                                    </div>
                                </div>

                            <?php endforeach; ?>




                        </div>


                        <form action="<?= ROOT ?>students/order">


                            <div class="cart-panel">
                                <div class="cart-header">
                                    <span class="cart-title">🛒 Your Order</span>
                                </div>
                                <div class="cart-items cart-item-template" id="cart-items">
                                    <?php if (!empty($carts)): ?>
                                        <?php foreach ($carts as $cart): ?>
                                            <div class="cart-item">

                                                <div class="item-details">
                                                    <div class="item-name"><?= ucfirst($cart->name) ?></div>
                                                    <div class="item-price">₹<?= $cart->price ?> each</div> <?php $total += ($cart->price * $cart->count) ?>
                                                    <div class="quantity-controls">
                                                        <button data-price="<?= $cart->price ?>" data-item-id="<?= $cart->item_id ?>" class="quantity-btn">−</button>
                                                        <span data-item-id="<?= $cart->item_id ?>" class="quantity"><?= $cart->count ?></span>
                                                        <button data-price="<?= $cart->price ?>" data-item-id="<?= $cart->item_id ?>" class="quantity-btn">+</button>
                                                    </div>
                                                </div>
                                                <div class="item-total"><span>₹</span>
                                                    <div data-item-id="<?= $cart->item_id ?>" class="total-price"><?= $cart->price * $cart->count ?></div>
                                                </div>
                                                <button data-item-id="<?= $cart->item_id ?>" data-cart-id="<?= $cart->id ?>" class="remove-btn" onclick="removeItem(this)">×</button>
                                            </div>


                                        <?php endforeach; ?>
                                    <?php endif; ?>




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
                                            <span id="total">₹ <h1=3 id="full-total-price"><?= $total ?></h3></span>

                                        </div>
                                        <button class="checkout-btn" id="checkout-btn" onclick="checkout()">
                                            Place Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <script defer src="<?= ROOT ?>assets/js/index.js"></script>


</body>






</html>