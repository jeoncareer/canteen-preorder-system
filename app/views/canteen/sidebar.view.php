<link rel="stylesheet" href="<?=ROOT?>assets/css/sidebar.css">
 <div class="sidebar">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?=ROOT?>students/" class="nav-link <?php if($page === 'menu'){echo 'active';}?>">
                            <span class="nav-icon">🍽️</span>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=ROOT?>students/my_orders" class="nav-link <?php if($page === 'my_orders'){echo 'active';}?>">
                            <span class="nav-icon">📋</span>
                            <span>My Orders</span>
                        </a>
                    </li>
                 
                    <li class="nav-item">
                        <a href="<?=ROOT?>students/history" class="nav-link <?php if($page === 'order_history'){echo 'active';}?>">
                            <span class="nav-icon">📊</span>
                            <span>Order History</span>
                        </a>
                    </li>
                </ul>
            </div>