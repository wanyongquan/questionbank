<?php
//version 1.0

define('dbserver', 'localhost:3306'); // MySQL host 
define('dbusername', 'root'); // db user name
define('dbpassword', 'root');// db user password

define('database', 'questionbank');
$db = mysqli_connect(dbserver, dbusername, dbpassword, database);