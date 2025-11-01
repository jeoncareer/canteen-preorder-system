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
            <a id="contact_admin_button" href="<?= ROOT ?>admin/student_reports" class="nav-link <?php if ($page === 'student_reports') {
                                                                                                        echo 'active';
                                                                                                    } ?>">
                <span class="nav-icon">📞</span>
                <span>Student Reports</span>

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


<script>
    const contactAdminBtn = document.getElementById('contact_admin_button');
    let url = ROOT + 'AdminMessagesController/fetchNoOfConversationUnreadByAdmin';
    let notificationBadge = document.createElement('div');
    notificationBadge.classList.add('notification-badge');
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