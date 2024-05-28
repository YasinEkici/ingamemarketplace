<?php
require_once __DIR__ . '/db.php';

// Data sanitize eden fonksiyon
function sanitize_data($data) {
    $conn = db_connect();
    return mysqli_real_escape_string($conn, htmlspecialchars($data));
}

// Kullanıcı kayıt fonksiyonu
function register_user($username, $password, $email, $birth_date) {
    $conn = db_connect();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password, email, birth_date) VALUES ('$username', '$hashed_password', '$email', '$birth_date')";
    return mysqli_query($conn, $query);
}

// Giriş yaptıran fonksiyon
function login_user($username, $password) {
    $conn = db_connect();
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        return false; 
    }
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

// Kullanıcı bilgilerini update eden fonksiyon
function update_user($user_id, $username, $email, $birth_date) {
    $conn = db_connect();
    $query = "UPDATE users SET username='$username', email='$email', birth_date='$birth_date' WHERE id='$user_id'";
    return mysqli_query($conn, $query);
}
?>
