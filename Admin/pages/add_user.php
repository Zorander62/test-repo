<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
  $role = $_POST['role'];
  $email = $_POST['username']; // Set email same as username
  $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : null;

  $Fcall = new mainClass();

  // Insert into users table
  $user_id = $Fcall->addUser($user_name, $username, $password, $role, $email); // Assuming addUser returns the new user ID

  // If the user is a doctor, insert into the doctors table
  if ($role === 'doctor' && $user_name) {
      $Fcall->addDoctor($user_id, $user_name, $email); // Assuming addDoctor function exists in mainClass
  }


  if ($user_id) {
    echo '<script>
    swal("Success", "User Added.", "success")
    .then(() => {
        window.location.href = "?a=user_management";
        });
        </script>';
    } else {
        echo '<script>swal("Warning", "Unable to add new user.", "warning")</script>';
    }


}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Add New User</p>
                        <a href="?a=user_management" class="btn btn-primary btn-sm ms-auto">View Users</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="post">

                    <div class="form-group">
                            <label for="doctor_name"> Name:</label>
                            <input type="text" class="form-control" name="user_name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username (Email):</label>
                            <input type="email" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role" id="roleSelect" required>
                                <option value="">--Select Role--</option>
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
<!-- 
<script>
// Show or hide doctor's name input based on role selection
document.getElementById('roleSelect').addEventListener('change', function() {
    var doctorNameField = document.getElementById('doctorNameField');
    if (this.value === 'doctor') {
        doctorNameField.style.display = 'block';
    } else {
        doctorNameField.style.display = 'none';
    }
});
</script> -->