<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">In-Game Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link-dashboard" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-dashboard" href="profile.php">Profile Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-dashboard " href="logout.php">Logout</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <p class="lead">Manage your in-game items and explore the marketplace.</p>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Add Item</h5>
                            <p class="card-text">Add new items to the marketplace.</p>
                            <a href="add_item.php" class="btn btn-success">Add Item</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Your Items</h5>
                            <p class="card-text">View and manage your listed items.</p>
                            <a href="list_items.php" class="btn btn-info">List Your Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Marketplace</h5>
                            <p class="card-text">Explore items listed by other users.</p>
                            <a href="view_items.php" class="btn btn-primary">View Other Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <div class="text-center">
        <a href="https://github.com/YasinEkici/ingamemarketplace.git" class="btn btn-dark" target="_blank">GitHub Repository</a>
    </div>
</div>
    <footer class="footer bg-light text-center py-3">
        <div class="container">
     
