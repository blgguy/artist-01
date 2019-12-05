<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Host Name
$dbhost = 'sql303.epizy.com';

// Database Name
$dbname = 'epiz_24873959_artist';

// Database Username
$dbuser = 'epiz_24873959';

// Database Password
$dbpass = 'r4PtfAyHpIrW';

// Defining base url
define("BASE_URL", "http://blg.rf.gd/");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $ex ) {
    echo "Connection error :" . $ex->getMessage();
}
?>