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
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Assuming 'role' is a field in your user table

        // Redirect based on role
        switch ($user['role']) {
            case 'doctor':
                header('Location: doctor/index.php');
                break;
            case 'pharmacy':
                header('Location: pharmacy/index.php');
                break;
            case 'receptionist':
                header('Location: receptionist/index.php');
                break;
            case 'admin':
                header('Location: admin/index.php');
                break;
            case 'laboratory':
                header('Location: laboratory/index.php');
                break;
            default:
                header('Location: index.php'); // Fallback
                break;
        }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <h4>Welcome to Admin Portal</h4>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>