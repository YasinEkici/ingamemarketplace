<?php
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Geçerli bir öğe ID'si alındığından emin olur
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
} else {
    header('Location: view_items.php');
    exit();
}
// Form gönderildiğinde ödeme bilgilerini kontrol eder
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $card_number = sanitize_data($_POST['card_number']);
    $expiry_date = sanitize_data($_POST['expiry_date']);
    $cvv = sanitize_data($_POST['cvv']);
    
    $current_date = date('Y-m-d');
    $cvv_valid = preg_match('/^\d{3}$/', $cvv);
    $card_number_valid = preg_match('/^\d{16}$/', $card_number);
    $expiry_date_valid = ($expiry_date > $current_date);

    if ($cvv_valid && $card_number_valid && $expiry_date_valid) {
        // Ödeme işlemleri burada yapılır 
        
        $conn = db_connect();
        $query = "INSERT INTO purchases (user_id, item_id) VALUES ($user_id, $item_id)";
        $update_query = "UPDATE items SET purchased = TRUE WHERE id = $item_id";
        
        if (mysqli_query($conn, $query) && mysqli_query($conn, $update_query)) {
            $success_message = 'Item successfully purchased!';
        } else {
            $error_message = 'Failed to complete the purchase';
        }
    } else {
        $error_message = 'Invalid payment details';
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
    <title>Payment</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Payment</h2>
                <?php if(isset($success_message)) echo "<p class='text-success'>$success_message</p>"; ?>
                <?php if(isset($error_message)) echo "<p class='text-danger'>$error_message</p>"; ?>
                <form method="post" action="payment.php?id=<?php echo $item_id; ?>">
                    <div class="form-group">
                        <label for="card_number">Card Number:</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" pattern="\d{16}" title="Please enter a valid 16-digit card number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date:</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" pattern="\d{3}" title="Please enter a valid 3-digit CVV" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Complete Purchase</button>
                </form>
            </div>
        </div>
        <a href="view_items.php" class="btn btn-secondary mt-3">Back to Items</a>
    </div>
</body>
</html>
