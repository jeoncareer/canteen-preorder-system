<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Order History</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/order-history.css">
    <style>






    </style>
</head>

<body>
    <?php require 'header.view.php' ?>

    <div class="container">
        <?php
        $page = 'order_history';
        require 'sidebar.view.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h2>Order History</h2>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Search your order history...">
            </div>

            <div class="filter-tabs">
                <div class="filter-tab active">All Orders</div>
                <div class="filter-tab">Completed</div>
                <div class="filter-tab">Cancelled</div>
                <div class="filter-tab">This Month</div>
                <div class="filter-tab">Last 3 Months</div>
            </div>

            <div class="history-section">
                <div class="section-title">Recent Orders</div>


                <?php foreach ($orders as $order_id => $values): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">Order #<?= $order_id ?></div>
                                <div class="order-date"><?= $values[0]->time ?></div>
                            </div>
                            <div class="order-status status-<?= $values[0]->status ?>"><?= $values[0]->status ?></div>
                        </div>

                        <div class="order-items">
                            <?php foreach ($values as $value): ?>
                                <div class="order-item">
                                    <div class="item-details">
                                        <div class="item-name"><?= $value->name ?></div>
                                        <div class="item-specs">Qty: <?= $value->quantity ?> </div>
                                        <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                                    </div>
                                    <div class="item-price">₹<?= $value->price ?></div>
                                </div>
                            <?php endforeach; ?>


                        </div>

                        <div class="order-footer">
                            <div class="order-info">

                                <div>Payment: Wallet</div>
                            </div>
                            <div class="order-total">Total: ₹<?= $values[0]->total ?></div>
                            <div class="order-actions">
                                <button class="btn btn-outline">Reorder</button>
                                <button class="btn btn-secondary">View Receipt</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>

        </div>


    </div>
</body>

</html>