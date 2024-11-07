<?php
session_start();
require_once 'model/function.php'; // Include your database connection and functions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    $db = new mainClass();
    $user = $db->authenticateUser($username, $password); // Assuming this function exists

    if ($user) {
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Assuming 'role' is a field in your user table
        header('Location: admin/index.php');
        exit();
        
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4c6ef5, #1e3c72); /* Beautiful gradient background */
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            margin-top: 100px;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .login-container h2 {
            color: #1e3c72;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .btn-custom {
            background-color: #4c6ef5;
            color: white;
            border: none;
            padding: 10px 20px;
            width: 100%;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #3b5ef5;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="text-center">Admin Login</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="form-group mb-4">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="form-group mb-4">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-custom">Login</button>

            <div class="mt-3 text-center">
                <a href="#" class="text-decoration-none text-muted">Forgot your password?</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
