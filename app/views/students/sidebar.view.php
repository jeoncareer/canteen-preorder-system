<link rel="stylesheet" href="<?=ROOT?>assets/css/sidebar.css">
 <div class="sidebar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?=ROOT?>students/" class="nav-link active" onclick="showPage('menu')">
                            <span class="nav-icon">🍽️</span>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=ROOT?>students/my_orders" class="nav-link" onclick="showPage('orders')">
                            <span class="nav-icon">📋</span>
                            <span>My Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showPage('wallet')">
                            <span class="nav-icon">💳</span>
                            <span>Wallet</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showPage('history')">
                            <span class="nav-icon">📊</span>
                            <span>Order History</span>
                        </a>
                    </li>
                </ul>
            </div>