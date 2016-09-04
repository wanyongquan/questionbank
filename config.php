<?php
//version 1.0

define('dbserver', 'localhost:3306'); // MySQL host 
define('dbusername', 'root'); // db user name
define('dbpassword', 'root');// db user password

define('database', 'questionbank');
$db = mysqli_connect(dbserver, dbusername, dbpassword, database);

// question bank configuration file
unset($CFG);
global $CFG;
$CFG = new stdClass();
$CFG->dbhost    ='localhost';
$CFG->dbname    = 'questionbank';
$CFG->dbuser    ='root';
$CFG->dbpass    ='root';
$CFG->wwwroot   ='http://localhost/questionbank';
$CFG->admin     ='admin';

require_once(dirname(__FILE__) . '/lib/setup.php');