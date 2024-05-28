<?php
session_start();

// Database bilgileri
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'dbusr21360859029');
define('DB_PASSWORD', 'nbWTxKckHJiG');
define('DB_NAME', 'dbstorage21360859029');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Bağlantı kontrolü
if($conn === false){
    die('Error: Cannot connect');
}
?>
