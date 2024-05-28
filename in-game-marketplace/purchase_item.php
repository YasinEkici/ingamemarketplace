<?php
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    $conn = db_connect();
    // Item hali hazırda alınmış mı kontrol eder
    $check_query = "SELECT * FROM purchases WHERE user_id = $user_id AND item_id = $item_id";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) == 0) {
        $query = "INSERT INTO purchases (user_id, item_id) VALUES ($user_id, $item_id)";
        if (mysqli_query($conn, $query)) {
            header('Location: view_items.php');
        } else {
            echo 'Failed to purchase item';
        }
    } else {
        echo 'Item already purchased';
    }
} else {
    header('Location: view_items.php');
}
?>
