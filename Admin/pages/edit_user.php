<?php


$user_id = $_GET['id'];
$user = $Fcall->getUserById($user_id); // Assuming this function exists

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];

    $Fcall->updateUser($user_id, $full_name, $role); // Assuming this function exists

    if ($user_id) {
        echo '<script>
        swal("Success", "Update Successful.", "success")
        .then(() => {
            window.location.href = "?a=user_management";
            });
            </script>';
    } else {
        echo '<script>swal("Warning", "Unable to update user.", "warning")</script>';
    }
    
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit User </p>
                        <a href="?a=user_management" class="btn btn-primary btn-sm ms-auto">View user</a>
                    </div>
                </div>

                <div class="card-body p-4">
        <form  method="post">
 
            <div class="form-group">
                <label for="doctor_name"> Name:</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo $user['fullname']; ?>">
                <input hidden type="text" class="form-control" name="user_name" value="<?php echo $user['user_id']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username (Email):</label>
                <input readonly type="email" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Change Role:</label>
                <select class="form-control" name="role" required>
                 <option><?php echo $user['role']; ?></option>
                <option value="doctor" <?php echo $user['role'] == 'doctor' ? 'selected' : ''; ?>>Doctor</option>
                <option value="pharmacy" <?php echo $user['role'] == 'pharmacy' ? 'selected' : ''; ?>>Pharmacy</option>
                <option value="receptionist" <?php echo $user['role'] == 'receptionist' ? 'selected' : ''; ?>>Receptionist</option>
                <option value="laboratory" <?php echo $user['role'] == 'laboratory' ? 'selected' : ''; ?>>Laboratory</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
