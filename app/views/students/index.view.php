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

        /* Toast styles */
        .order-toast {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 2000;
            min-width: 260px;
            max-width: 360px;
            background: #10b981;
            /* green */
            color: #fff;
            padding: 14px 16px;
            border-radius: 10px;
            box-shadow: 0 8px 28px rgba(16, 185, 129, 0.14);
            display: flex;
            gap: 12px;
            align-items: center;
            transform: translateY(-12px) scale(.98);
            opacity: 0;
            pointer-events: none;
            transition: transform .22s ease, opacity .22s ease;
            font-weight: 600;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        .order-toast.show {
            transform: translateY(0) scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        .order-toast .icon {
            font-size: 1.2rem;
            line-height: 1;
        }

        .order-toast .message {
            flex: 1;
            font-size: 0.95rem;
        }

        .order-toast.success {
            background: #10b981;
        }

        .order-toast.error {
            background: #ef4444;
            /* red for errors */
        }

        .item-header {
            align-items: center !important;
            gap: 12px;
        }

        .item-title-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .item-canteen {
            margin-top: 0;
            padding: 6px 10px;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(102, 126, 234, 0.18));
            color: #3b4a6b;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            letter-spacing: 0.3px;
        }

        .item-canteen span {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 700;
            color: #526091;
            letter-spacing: 0.6px;
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

                    <input type="text" class="search-bar" data-from="s" placeholder="Search for dishes..." id="searchInput">

                    <div class="menu-grid">
                        <div class="menu-categories">
                            <!-- Main Course -->
                            <?php if (!empty($grouped)): ?>
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
                                                    <div class="item-title-group">
                                                        <div class="item-name"><?= ucwords($value->item_name) ?></div>
                                                        <div class="item-canteen">
                                                            <span>Canteen</span>
                                                            Skyline Bites
                                                        </div>
                                                    </div>
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
                            <?php endif; ?>




                        </div>





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


                                    <div class="summary-row summary-total">
                                        <span>Total:</span>
                                        <span id="total">₹ <h1=3 id="full-total-price"><?= $total ?></h3></span>

                                    </div>
                                    <button class="checkout-btn" id="checkout-btn">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="testing"></div>

                    <!-- Order Confirmation Modal -->

                    <!-- Order toast (place near end of body) -->
                    <div id="order-toast" class="order-toast" aria-live="polite" role="status"></div>

                    <script src="<?= ROOT ?>assets/js/index.js"></script>

                    <script src="<?= ROOT ?>assets/js/get-items.js">
                    </script>

                    <script>
                        const checkoutBtn = document.getElementById('checkout-btn');
                        checkoutBtn.addEventListener('click', () => {

                            let url = ROOT + 'students/order';
                            fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({})
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        showOrderToast('Order placed successfully!', 3000, 'success').then(() => {
                                            // Optionally refresh the page or clear the cart
                                            window.location.reload();
                                        });
                                    }
                                });
                        });
                        /**
                         * Show a temporary order toast.
                         * @param {string} message - Text to show.
                         * @param {number} duration - Milliseconds before auto-hide (default 3000).
                         * @param {'success'|'error'} type - Visual type (default 'success').
                         * @returns {Promise<boolean>} resolves true when shown.
                         *
                         * Example:
                         *   showOrderToast('Order placed successfully', 3500);
                         */
                        function showOrderToast(message = 'Order placed successfully', duration = 3000, type = 'success') {
                            return new Promise((resolve) => {
                                const toast = document.getElementById('order-toast');
                                if (!toast) return resolve(false);

                                // Clear existing hide timer if any
                                if (toast._hideTimer) {
                                    clearTimeout(toast._hideTimer);
                                    toast._hideTimer = null;
                                }

                                // Set content & classes
                                toast.className = 'order-toast show ' + (type === 'error' ? 'error' : 'success');
                                toast.innerHTML = `
            <div class="icon">${type === 'error' ? '⚠️' : '✅'}</div>
            <div class="message">${message}</div>
        `;

                                // Auto-hide
                                toast._hideTimer = setTimeout(() => {
                                    toast.classList.remove('show');
                                    // remove content after transition
                                    setTimeout(() => {
                                        toast.innerHTML = '';
                                        toast._hideTimer = null;
                                        resolve(true);
                                    }, 240);
                                }, Math.max(800, duration)); // minimum visible time

                                // Also allow click to dismiss instantly
                                toast.onclick = () => {
                                    if (toast._hideTimer) {
                                        clearTimeout(toast._hideTimer);
                                        toast._hideTimer = null;
                                    }
                                    toast.classList.remove('show');
                                    setTimeout(() => {
                                        toast.innerHTML = '';
                                        resolve(true);
                                    }, 240);
                                };
                            });
                        }

                        /* Optional convenience wrappers:
                           showOrderToast('Order placed', 3000, 'success');
                           showOrderToast('Failed to place order', 4000, 'error');
                        */
                    </script>
</body>






</html>