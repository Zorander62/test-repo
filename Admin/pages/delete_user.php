<?php

require_once '../model/function.php'; // Include your database connection and functions

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$db = new mainClass();
$user_id = $_GET['id'];
$db->deleteUser($user_id); // Assuming this function exists

header('Location: user_management.php'); // Redirect back to user management
exit();
?>