<link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
<div class="sidebar">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="<?= ROOT ?>canteen/" class="nav-link <?php if ($page === 'dashboard') {
                                                                echo 'active';
                                                            } ?>">
                <span class="nav-icon">🍽️</span>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= ROOT ?>canteen/menu_management" class="nav-link <?php if ($page === 'my_orders') {
                                                                                echo 'active';
                                                                            } ?>">
                <span class="nav-icon">📋</span>
                <span>Menu Management</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>canteen/orders" class="nav-link <?php if ($page === 'orders') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">📊</span>
                <span>Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>canteen/settings" class="nav-link <?php if ($page === 'settings') {
                                                                        echo 'active';
                                                                    } ?>">
                <span class="nav-icon">⚙️</span>
                <span>Canteen Settings</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>canteen/logout" class="nav-link <?php if ($page === 'order_history') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">📊</span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>