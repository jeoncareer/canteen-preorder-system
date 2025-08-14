<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - My Orders</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/my-orders.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/add-item.css">

    <style>










    </style>
</head>

<body>
    <?php require 'header.view.php' ?>

    <div class="container">
        <?php
        $page = 'my_order';
        require 'sidebar.view.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h2>My Orders</h2>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Search for orders...">
            </div>

            <div class="orders-section">
                <div class="section-title">Current Orders</div>
                <?php foreach ($orders as $order_id => $items): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">Order #<?= $order_id ?></div>
                                <div class="order-time">Today, 11:30 AM</div>
                            </div>
                            <div class="order-status status-ready"><?= $order[$order_id]['status'] ?> </div>
                        </div>

                        <div class="order-items">
                            <?php foreach ($items as $item): ?>
                                <div class="order-item">
                                    <div class="item-details">
                                        <div class="item-name"><?= $item->name ?></div>
                                        <div class="item-specs">Qty: <?= $item->quantity ?> </div>
                                    </div>
                                    <div class="item-price">₹<?= $item->price * $item->quantity ?></div>
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <div class="order-footer">
                            <div class="order-info">
                                <!-- <div>Pickup: Counter 2 - Main Canteen</div> -->
                                <div>Status: Ready for collection</div>
                            </div>
                            <div class="order-total">Total: ₹<?= $order[$order_id]['total'] ?></div>
                            <div class="order-actions">
                                <?php if ($order[$order_id]['status'] === 'ready'): ?>
                                    <button class="btn btn-primary">✓ Pick Up</button>
                                <?php endif; ?>
                                <button data-modal-target="order-details-modal" class="btn btn-secondary">View Details</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


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

    <!-- View Order Details Modal -->
    <div class="modal" id="order-details-modal">
        <div class="modal-header">
            <div class="modal-title">📋 Order Details</div>
            <button data-close-button="close-button" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Order Info -->
            <div class="order-info">
                <p><strong>Order ID:</strong> <span id="order-id"></span></p>
                <p><strong>Date & Time:</strong> <span id="order-datetime"></span></p>
                <p><strong>Status:</strong> <span id="order-status"></span></p>
            </div>

            <hr>

            <!-- Items List -->
            <div class="order-items">
                <h4>Items</h4>
                <ul id="order-items-list">
                    <!-- Dynamically added items here -->
                </ul>
            </div>

            <hr>

            <!-- Total -->
            <div class="order-total">
                <p><strong>Total:</strong> ₹<span id="order-total"></span></p>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
            </div>
        </div>
    </div>
    <div id="overlay"></div>

    <script src="<?= ROOT ?>assets/js/add-item.js"></script>
</body>

</html>