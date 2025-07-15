<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME', 'canteen_system');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('ROOT', 'http://localhost/canteen-preorder-system/public/');
} else {
    define('DBNAME', 'canteen_sysem');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', 'yourpassword');
    define('ROOT', 'https://www.yourwebsite.com');
}

if (isset($_SESSION['STUDENT'])) {
    define('STUDENT_ID', $_SESSION['STUDENT']->id);
}


define('APP_NAME', "My Website");
//true mean show erros
//false means do not show any errors
define('DEBUG', true);
function m() {}
