<?php


// Fetch patients from the database
//$patients = $db->getAllPatients(); // Assuming this function exists
?>
<?php

require_once '../model/function.php'; // Include your database connection and functions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];

    $db = new mainClass();
    $db->addUser($username, $password, $role); // Assuming this function exists

    header('Location: user_management.php'); // Redirect back to user management
    exit();
}
?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Patients</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">

            <form action="add_user.php" method="post">
          
            <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role" required>
                                <option value="doctor">Doctor</option>
                                <option value="pharmacy">Pharmacy</option>
                                <option value="receptionist">Receptionist</option>
                                <option value="laboratory">Laboratory</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                        </form>
   




</div>

  </div>
  </div>
  </div>
  </div>



