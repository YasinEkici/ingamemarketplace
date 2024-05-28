<?php
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_data($_POST['username']);
    $password = sanitize_data($_POST['password']);
    $email = sanitize_data($_POST['email']);
    $birth_date = sanitize_data($_POST['birth_date']);
    
    // Yaş kontrolü (18 yaşından küçükler kayıt olamaz)
    $age = date_diff(date_create($birth_date), date_create('today'))->y;
    if ($age < 18) {
        $error_message = 'You must be at least 18 years old to register.';
    } else {
        if (register_user($username, $password, $email, $birth_date)) {
            header('Location: login.php');
        } else {
            $error_message = 'Registration failed';
        }
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
    <title>Register</title>
</head>
<body>
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Register</h2>
                        <?php if(isset($error_message)) echo "<p class='text-danger text-center'>$error_message</p>"; ?>
                        <form method="post" action="register.php">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Birth Date:</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
