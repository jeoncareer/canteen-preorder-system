<link rel="stylesheet" href="<?= ROOT ?>assets/css/sidebar.css">
<div class="sidebar">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="<?= ROOT ?>students/" class="nav-link <?php if ($page === 'menu') {
                                                                echo 'active';
                                                            } ?>">
                <span class="nav-icon">🍽️</span>
                <span>Menu</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= ROOT ?>students/my_orders" class="nav-link <?php if ($page === 'my_orders') {
                                                                        echo 'active';
                                                                    } ?>">
                <span class="nav-icon">📋</span>
                <span>My Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= ROOT ?>students/history" class="nav-link <?php if ($page === 'order_history') {
                                                                        echo 'active';
                                                                    } ?>">
                <span class="nav-icon">📊</span>
                <span>Order History</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a href="<?= ROOT ?>students/profile" class="nav-link <?php if ($page === 'profile') {
                                                                        echo 'active';
                                                                    } ?>">
                <span class="nav-icon">👤</span>
                <span>My Profile</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="<?= ROOT ?>students/contact" id="contact_admin_button" class="nav-link <?php if ($page === 'contact') {
                                                                                                echo 'active';
                                                                                            } ?>">
                <span class="nav-icon">📞</span>
                <span>Contact Admin</span>

            </a>
        </li>
    </ul>
</div>

<script>
    const contactAdminBtn = document.getElementById('contact_admin_button');
    let url = ROOT + 'MessagesController/fetchNoOfConversationUnreadByStudents';
    let notificationBadge = contactAdminBtn.querySelector('.notification-badge');
    fetch(url)
        .then(res => res.json())
        .then(data => {
            let count = data.count;
            if (count != 0) {
                notificationBadge.textContent = count;
                contactAdminBtn.appendChild(notificationBadge);
            }
        })

    contactAdminBtn.addEventListener('click', e => {
        console.log("you click contact btn");
    })
</script>