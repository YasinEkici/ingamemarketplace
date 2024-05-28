<?php
require_once 'includes/functions.php';

// Kullanıcı oturumu kontrol eder
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = db_connect();

// Form gönderildiğinde verileri alır ve veritabanına ekler
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = sanitize_data($_POST['item_name']);
    $item_description = sanitize_data($_POST['item_description']);
    $price = sanitize_data($_POST['price']);
    $category = sanitize_data($_POST['category']);

    $query = "INSERT INTO items (user_id, item_name, item_description, price, category) VALUES ($user_id, '$item_name', '$item_description', '$price', '$category')";
    mysqli_query($conn, $query);

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Add Item</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Add Item</h2>
                <form method="post" action="add_item.php">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" required>
                    </div>
                    <div class="form-group">
                        <label for="item_description">Description</label>
                        <textarea class="form-control" id="item_description" name="item_description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="Firearm">Firearm</option>
                            <option value="Armour">Armour</option>
                            <option value="Knife">Knife</option>
                            <option value="Potion">Potion</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </form>
                <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
