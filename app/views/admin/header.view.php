<link rel="stylesheet" href="<?= ROOT ?>assets/css/header.css">
<!-- Header -->
<div class="header">
    <div class="header-left">
        <h1>👨‍💼 Admin Dashboard</h1>
        <!-- <p>Campus Canteen Management System</p> -->
    </div>
    <div class="header-right">
        <div class="user-profile">
            <div class="user-avatar"><?= strtoupper($college->email[0]) ?></div>
            <div>
                <div style="font-weight: 600;"><?= $college->email ?></div>
                <!-- <div style="font-size: 14px; opacity: 0.8;">Administrator</div> -->
            </div>
        </div>
    </div>
</div>