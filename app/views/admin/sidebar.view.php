<link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
<div class="sidebar">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="<?= ROOT ?>admin/" class="nav-link <?php if ($page === 'dashboard') {
                                                            echo 'active';
                                                        } ?>">
                <span class="nav-icon">📊</span>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= ROOT ?>admin/canteens" class="nav-link <?php if ($page === 'canteens') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">🍽️</span>
                <span>Canteens</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/students" class="nav-link <?php if ($page === 'students') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">👨‍🎓</span>
                <span>Students</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/orders" class="nav-link <?php if ($page === 'orders') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">📋</span>
                <span>All Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/reports" class="nav-link <?php if ($page === 'reports') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">📈</span>
                <span>Reports</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/student_reports" class="nav-link <?php if ($page === 'student_reports') {
                                                                            echo 'active';
                                                                        } ?>">
                <span class="nav-icon">📞</span>
                <span>Student Reports</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/courses" class="nav-link <?php if ($page === 'courses') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">📚</span>
                <span>Courses</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/settings" class="nav-link <?php if ($page === 'settings') {
                                                                    echo 'active';
                                                                } ?>">
                <span class="nav-icon">⚙️</span>
                <span>Settings</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>admin/logout" class="nav-link">
                <span class="nav-icon">🚪</span>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>