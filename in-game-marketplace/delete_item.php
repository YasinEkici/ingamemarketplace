<?php
session_start();
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$item_id = $_GET['id']; // Silinecek öğenin ID'sini alır
$conn = db_connect();

$query = "DELETE FROM items WHERE id='$item_id'"; // Öğeyi veritabanından siler
if (mysqli_query($conn, $query)) {
    header('Location: list_items.php'); // Başarılı silme işleminden sonra öğe listesine yönlendirir
} else {
    echo 'Failed to delete item';
}
?>
