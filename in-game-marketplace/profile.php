<?php
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = db_connect();
$query = "SELECT * FROM users WHERE id='$user_id'"; // Kullanıcı bilgilerini getirir
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);// Kullanıcı bilgilerini diziye alır
// Form gönderildiğinde kullanıcı bilgilerini günceller
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_data($_POST['username']);
    $email = sanitize_data($_POST['email']);
    $birth_date = sanitize_data($_POST['birth_date']);
    
    if (update_user($user_id, $username, $email, $birth_date)) {
        $success_message = 'Information updated successfully';
        $user = mysqli_fetch_assoc(mysqli_query($conn, $query)); // Kullanıcı bilgilerini yeniler
    } else {
        $error_message = 'Failed to update information';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Profile Information</h2>
                <?php if(isset($success_message)) echo "<p class='text-success'>$success_message</p>"; ?>
                <?php if(isset($error_message)) echo "<p class='text-danger'>$error_message</p>"; ?>
                <form method="post" action="profile.php">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birth Date:</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $user['birth_date']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Information</button>
                </form>
            </div>
        </div>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>
</body>
</html>
