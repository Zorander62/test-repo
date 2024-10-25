<?php session_start();
// Start the session if it's not already started
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// Check if user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     // Redirect to login page
//     header("Location: ../login.php");
//     exit;
// }

require_once "model/function.php"; 
$Fcall = new mainClass();
// Check if user is logged in
//$isLoggedIn = isset($_SESSION['user_id']);

// Get user's name and role from the session
// $userName = $isLoggedIn ? $_SESSION['name'] : '';
// $userRole = $isLoggedIn ? $_SESSION['role'] : '';

// Logout functionality
// if (isset($_GET['logout'])) {
//     session_destroy();
//     header('Location: ../login.php');
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="en">
    
        <?php require_once "view/includes/header.php"; ?>
    <body>
        <!-- Top Header Start -->
       
        <?php require_once "control/controller.php"; ?>

        
        <?php require_once "view/includes/footer.php"; ?>

    </body>
</html>
