<?php
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$item_id = $_GET['id']; // Düzenlenecek öğenin ID'sini alır
$conn = db_connect();
// Form gönderildiğinde verileri güncelle
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = sanitize_data($_POST['item_name']);
    $item_description = sanitize_data($_POST['item_description']);
    $price = sanitize_data($_POST['price']);
    $category = sanitize_data($_POST['category']);
    // Öğeyi veritabanında güncelle
    $query = "UPDATE items SET item_name='$item_name', item_description='$item_description', price='$price', category='$category' WHERE id='$item_id'";
    if (mysqli_query($conn, $query)) {
        header('Location: list_items.php');// Başarılı güncelleme sonrası öğe listesine yönlendirir
    } else {
        $error_message = 'Failed to update item';
    }
}
// Güncellenmek üzere seçilen öğenin mevcut verilerini alır
$query = "SELECT * FROM items WHERE id='$item_id'";
$result = mysqli_query($conn, $query);
$item = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Item</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Edit Item</h2>
                <?php if(isset($error_message)) echo "<p class='text-danger'>$error_message</p>"; ?>
                <form method="post" action="edit_item.php?id=<?php echo $item_id; ?>">
                    <div class="form-group">
                        <label for="item_name">Item Name:</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $item['item_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="item_description">Item Description:</label>
                        <textarea class="form-control" id="item_description" name="item_description"><?php echo $item['item_description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $item['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="Firearm" <?php if($item['category'] == 'Firearm') echo 'selected'; ?>>Firearm</option>
                            <option value="Armour" <?php if($item['category'] == 'Armour') echo 'selected'; ?>>Armour</option>
                            <option value="Knife" <?php if($item['category'] == 'Knife') echo 'selected'; ?>>Knife</option>
                            <option value="Potion" <?php if($item['category'] == 'Potion') echo 'selected'; ?>>Potion</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Item</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
