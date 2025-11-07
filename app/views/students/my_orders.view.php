<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - My Orders</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/my-orders.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/add-item.css">
    <script>
        let ROOT = "<?= ROOT ?>";
    </script>
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

            <!-- <div class="search-bar">
                <input type="text" placeholder="Search for orders...">
            </div> -->

            <div class="orders-section">
                <div class="section-title">Current Orders</div>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $row): ?>
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">Order #<?= $row->id ?></div>
                                    <div class="order-time">Today, 11:30 AM</div>
                                </div>
                                <div class="order-status status-ready"><?= $row->status ?> </div>
                            </div>

                            <div class="order-items">
                                <?php foreach ($row->items as $item): ?>
                                    <div class="order-item">
                                        <div class="item-details">
                                            <div class="item-name"><?= $item->item->name ?></div>
                                            <div class="item-specs">Qty: <?= $item->quantity ?> </div>
                                        </div>
                                        <div class="item-price">₹<?= $item->item->price * $item->quantity ?></div>
                                    </div>
                                <?php endforeach; ?>

                            </div>

                            <div class="order-footer">
                                <div class="order-info">
                                    <!-- <div>Pickup: Counter 2 - Main Canteen</div> -->
                                    <div>Status: Ready for collection</div>
                                </div>
                                <div class="order-total">Total: ₹<?= $row->total ?></div>
                                <div class="order-actions">
                                    <?php if ($row->status === 'ready'): ?>
                                        <button data-order-id="<?= $row->id ?>" class="btn btn-primary pickup">✓ Pick Up</button>
                                    <?php endif; ?>
                                    <button data-modal-target="#order-details-modal" class="btn btn-secondary">View Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-orders">
                        <div class="no-orders-icon">🛒</div>
                        <div>You have no current orders</div>
                        <div style="font-size: 14px; margin-top: 10px;">Browse the menu and place your first order!</div>
                    </div>
                <?php endif; ?>


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
            <div class="modal-title">📦 Order Details</div>
            <button data-close-button="close-button" class="close-button">&times;</button>
        </div>
        <div class="modal-body">
            <div class="order-info">
                <p><strong>Order ID:</strong> #127</p>
                <p><strong>Date & Time:</strong> Today, 11:30 AM</p>
                <p><strong>Status:</strong> Ready for collection</p>
            </div>

            <hr>

            <div class="order-items">
                <h4>Items</h4>
                <ul>
                    <li>🍗 Chicken Biriyani — Qty: 1 — ₹70</li>
                    <li>🍴 Meals — Qty: 1 — ₹10</li>
                </ul>
            </div>

            <hr>

            <div class="order-total">
                <p><strong>Total:</strong> ₹80.00</p>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
            </div>
        </div>
    </div>

    <div id="overlay"></div>

    <script src="<?= ROOT ?>assets/js/add-item.js"></script>

    <script>
        const orderSelection = document.querySelector('.orders-section');
        orderSelection.addEventListener('click', e => {

            if (e.target.classList.contains('pickup')) {
                let pickupElement = e.target;

                let orderId = pickupElement.dataset.orderId;
                let orderCard = pickupElement.parentElement.parentElement.parentElement;
                console.log(orderCard);

                console.log(orderId);
                const url = ROOT + 'api/changeStatus';
                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            new_status: 'completed'
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Status updated successfully");
                            orderCard.querySelector('.order-status').textContent = "Completed";
                            pickupElement.hidden = true;
                        }
                    });
            }

        })
    </script>
</body>

</html>