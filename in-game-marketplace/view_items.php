<?php
require_once 'includes/functions.php';
// Kullanıcı oturumu yoksa login sayfasına yönlendirir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = db_connect();

$search_attribute = "";
$search_value = "";
$search_results = [];
if (isset($_POST['search_attribute']) && isset($_POST['search_value'])) {
    $search_attribute = sanitize_data($_POST['search_attribute']);
    $search_value = sanitize_data($_POST['search_value']);
    $query = "SELECT items.*, users.username AS seller FROM items JOIN users ON items.user_id = users.id WHERE items.user_id != $user_id AND $search_attribute LIKE '%$search_value%'";
    $search_results = mysqli_query($conn, $query);// Arama sonuçlarını alır
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>View Items</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Available Items</h2>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="firearm-tab" data-toggle="tab" href="#firearm" role="tab" aria-controls="firearm" aria-selected="true">Firearm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="armour-tab" data-toggle="tab" href="#armour" role="tab" aria-controls="armour" aria-selected="false">Armour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="knife-tab" data-toggle="tab" href="#knife" role="tab" aria-controls="knife" aria-selected="false">Knife</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="potion-tab" data-toggle="tab" href="#potion" role="tab" aria-controls="potion" aria-selected="false">Potion</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="firearm" role="tabpanel" aria-labelledby="firearm-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Seller</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT items.*, users.username AS seller FROM items JOIN users ON items.user_id = users.id WHERE items.user_id != $user_id AND category = 'Firearm'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_description']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['seller']; ?></td>
                                        <td>
                                            <?php if ($row['purchased']) { ?>
                                                <span class="badge badge-success">Purchased</span>
                                            <?php } else { ?>
                                                <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Purchase</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="armour" role="tabpanel" aria-labelledby="armour-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Seller</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT items.*, users.username AS seller FROM items JOIN users ON items.user_id = users.id WHERE items.user_id != $user_id AND category = 'Armour'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_description']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['seller']; ?></td>
                                        <td>
                                            <?php if ($row['purchased']) { ?>
                                                <span class="badge badge-success">Purchased</span>
                                            <?php } else { ?>
                                                <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Purchase</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="knife" role="tabpanel" aria-labelledby="knife-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Seller</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT items.*, users.username AS seller FROM items JOIN users ON items.user_id = users.id WHERE items.user_id != $user_id AND category = 'Knife'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_description']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['seller']; ?></td>
                                        <td>
                                            <?php if ($row['purchased']) { ?>
                                                <span class="badge badge-success">Purchased</span>
                                            <?php } else { ?>
                                                <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Purchase</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="potion" role="tabpanel" aria-labelledby="potion-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Seller</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT items.*, users.username AS seller FROM items JOIN users ON items.user_id = users.id WHERE items.user_id != $user_id AND category = 'Potion'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['item_description']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['seller']; ?></td>
                                        <td>
                                            <?php if ($row['purchased']) { ?>
                                                <span class="badge badge-success">Purchased</span>
                                            <?php } else { ?>
                                                <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Purchase</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5 search-section">
            <div class="card-body">
                <h3>Search Items</h3>
                <form method="post" action="view_items.php" class="form-inline mb-3">
                    <div class="form-group mr-2">
                        <select name="search_attribute" class="form-control">
                            <option value="item_name">Item Name</option>
                            <option value="price">Price</option>
                        </select>
                    </div>
                    <input type="text" name="search_value" class="form-control mr-2" placeholder="Enter value...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <?php if (!empty($search_attribute) && !empty($search_value)) { ?>
                    <h4>Search Results</h4>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Seller</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($search_results)) { ?>
                                <tr>
                                    <td><?php echo $row['item_name']; ?></td>
                                    <td><?php echo $row['item_description']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['seller']; ?></td>
                                    <td>
                                        <?php if ($row['purchased']) { ?>
                                            <span class="badge badge-success">Purchased</span>
                                        <?php } else { ?>
                                            <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Purchase</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>

        <a href="dashboard.php" class="btn btn-primary mt-3">Dashboard</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
