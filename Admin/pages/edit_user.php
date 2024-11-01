<?php

require_once '../model/function.php'; // Include your database connection and functions

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: login.php');
//     exit();
// }

$db = new mainClass();
$user_id = $_GET['id'];
$user = $db->getUserById($user_id); // Assuming this function exists

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $db->updateUser($user_id, $username, $role); // Assuming this function exists
    header('Location: user_management.php'); // Redirect back to user management
    exit();
}
?>


    <div class="container">
        <h2>Edit User</h2>
        <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" required>
                    <option value="doctor" <?php echo $user['role'] == 'doctor' ? 'selected' : ''; ?>>Doctor</option>
                    <option value="pharmacy" <?php echo $user['role'] == 'pharmacy' ? 'selected' : ''; ?>>Pharmacy</option>
                    <option value="receptionist" <?php echo $user['role'] == 'receptionist' ? 'selected' : ''; ?>>Receptionist</option>
                    <option value="laboratory" <?php echo $user['role'] == 'laboratory' ? 'selected' : ''; ?>>Laboratory</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
