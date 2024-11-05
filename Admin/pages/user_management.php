<?php

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header('Location: login.php');
//     exit();
// }

// require_once "../model/function.php"; // Use require_once to prevent multiple inclusions

// $Fcall = new mainClass();

// Fetch all users
$users = $Fcall->getAllUsers();// Assuming this function exists

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID from the submitted form
    $userId = $_POST['id'];
    // Call the delete function
    $del = $Fcall->deleteUser($userId); // Assuming deleteUser method exists

    if ($del) {
        echo '<script>
            swal("Success", "Deleted Successfully.", "success")
            .then(() => {
                window.location.href = "?a=user_management"; // Redirect back to user management
            });
        </script>';
    } else {
        echo '<script>swal("Warning", "Unable to remove user.", "warning")</script>';
    }
}

?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Patients</p>
                <a href="?a=new_user" class="btn btn-primary btn-sm ms-auto">Add New User</a>
              </div>
            </div>

            <div class="card-body p-4 ">
        <!-- <a href="?a=add_user" class="btn btn-primary" >Add New User</a> -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): 
                    $no = 1;
                    ?>
                    <tr>
                        <td><?php echo $user['user_id']; ?></td>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo ucfirst($user['role']); ?></td>
                        <td>
                            <a href="?a=edit_user&id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Edit</a>
                            <form method="post" style="display:inline;" onsubmit="return confirmDelete();">
                                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this user?');
}
</script>