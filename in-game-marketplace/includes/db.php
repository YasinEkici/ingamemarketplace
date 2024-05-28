<?php
require_once __DIR__ . '/../config.php';

// Database bağlantısı
function db_connect() {
    global $conn;
    return $conn;
}
?>
