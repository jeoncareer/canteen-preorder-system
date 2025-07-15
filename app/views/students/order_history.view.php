<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Order History</title>
   <link rel="stylesheet" href="<?=ROOT?>assets/css/student-general.css">
   <link rel="stylesheet" href="<?=ROOT?>assets/css/order-history.css">
    <style>





        
    </style>
</head>
<body>
  <?php require 'header.view.php'?>

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

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-001</div>
                            <div class="order-date">July 7, 2025 - 11:30 AM</div>
                        </div>
                        <div class="order-status status-completed">COMPLETED</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Chicken Biryani</div>
                                <div class="item-specs">Qty: 1 | Spice Level: Medium</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹180</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Mango Lassi</div>
                                <div class="item-specs">Qty: 1 | Size: Large</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹60</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Delivered: Counter 2 - Main Canteen</div>
                            <div>Payment: Wallet</div>
                        </div>
                        <div class="order-total">Total: ₹240</div>
                        <div class="order-actions">
                            <button class="btn btn-outline">Reorder</button>
                            <button class="btn btn-secondary">View Receipt</button>
                        </div>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-002</div>
                            <div class="order-date">July 6, 2025 - 2:15 PM</div>
                        </div>
                        <div class="order-status status-completed">COMPLETED</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Veg Burger</div>
                                <div class="item-specs">Qty: 1 | Add-ons: Extra Cheese</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹80</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">French Fries</div>
                                <div class="item-specs">Qty: 1 | Size: Medium</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹60</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Cold Coffee</div>
                                <div class="item-specs">Qty: 1 | Size: Large</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹70</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Delivered: Counter 1 - Main Canteen</div>
                            <div>Payment: Wallet</div>
                        </div>
                        <div class="order-total">Total: ₹210</div>
                        <div class="order-actions">
                            <button class="btn btn-outline">Reorder</button>
                            <button class="btn btn-secondary">View Receipt</button>
                        </div>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-003</div>
                            <div class="order-date">July 5, 2025 - 1:45 PM</div>
                        </div>
                        <div class="order-status status-cancelled">CANCELLED</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Mutton Curry</div>
                                <div class="item-specs">Qty: 1 | Spice Level: High</div>
                            </div>
                            <div class="item-price">₹200</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Jeera Rice</div>
                                <div class="item-specs">Qty: 1 | Size: Medium</div>
                            </div>
                            <div class="item-price">₹80</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Reason: Item out of stock</div>
                            <div>Refund: Processed to Wallet</div>
                        </div>
                        <div class="order-total">Total: ₹280</div>
                        <div class="order-actions">
                            <button class="btn btn-secondary">View Details</button>
                        </div>
                    </div>
                </div>

                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #ORD-2025-004</div>
                            <div class="order-date">July 4, 2025 - 12:30 PM</div>
                        </div>
                        <div class="order-status status-completed">COMPLETED</div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Masala Dosa</div>
                                <div class="item-specs">Qty: 2 | Add-ons: Extra Sambar</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹120</div>
                        </div>
                        <div class="order-item">
                            <div class="item-details">
                                <div class="item-name">Filter Coffee</div>
                                <div class="item-specs">Qty: 2 | Size: Medium</div>
                                <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                            </div>
                            <div class="item-price">₹60</div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-info">
                            <div>Delivered: Counter 3 - South Indian Counter</div>
                            <div>Payment: Wallet</div>
                        </div>
                        <div class="order-total">Total: ₹180</div>
                        <div class="order-actions">
                            <button class="btn btn-outline">Reorder</button>
                            <button class="btn btn-secondary">View Receipt</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="order-sidebar">
            <div class="balance-info">
                <div class="balance-amount">₹245.50</div>
                <div class="balance-label">Wallet Balance</div>
            </div>

            <div class="stats-card">
                <div class="stats-number">47</div>
                <div class="stats-label">Total Orders</div>
            </div>

            <div class="stats-card">
                <div class="stats-number">₹8,420</div>
                <div class="stats-label">Total Spent</div>
            </div>

            <div class="favorite-items">
                <h3>🍴 Most Ordered</h3>
                <div class="favorite-item">
                    <div>
                        <div class="favorite-name">Chicken Biryani</div>
                        <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="favorite-count">12x</div>
                </div>
                <div class="favorite-item">
                    <div>
                        <div class="favorite-name">Masala Dosa</div>
                        <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="favorite-count">8x</div>
                </div>
                <div class="favorite-item">
                    <div>
                        <div class="favorite-name">Veg Burger</div>
                        <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="favorite-count">6x</div>
                </div>
                <div class="favorite-item">
                    <div>
                        <div class="favorite-name">Filter Coffee</div>
                        <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                    </div>
                    <div class="favorite-count">15x</div>
                </div>
            </div>
        </div> -->
    </div>
</body>
</html>