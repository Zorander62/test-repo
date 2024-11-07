<?php

// Handle form submission for adding a new patient
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Insert patient into the database
    $Fcall->addPatient($name, $email, $phone); // Assuming this function exists
    echo '<script>alert("Patient added successfully!");</script>';
}

// Fetch all patients
$patients = $Fcall->getAllPatients(); // Assuming this function exists



if (isset($_GET['id'])) {
  $patient_id = intval($_GET['id']);

  // Prepare deletion query
  $stmt = $Fcall->prepare("DELETE FROM patients WHERE patient_id = ?");
  $stmt->bind_param("i", $patient_id);

  // Execute deletion and confirm success
  if ($stmt->execute()) {

    echo '<script>
    swal("Success", "Patient record deleted successfully.", "success")
    .then((value) => {
        window.location.href = "?a=patients";
    });
  </script>';
} else {
    //echo "Error updating patient record.";
    echo '<script>swal("Warning","Error deleting patient record","warning")</script>';
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
                        <!-- <button class="btn btn-primary btn-sm ms-auto" data-toggle="modal" data-target="#addPatientModal">New Patient</button>
                    </div> -->
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive p-5">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patients as $patient): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($patient['first_name'])." ".htmlspecialchars($patient['last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($patient['email']); ?></td>
                                        <td><?php echo htmlspecialchars($patient['phone_number']); ?></td>
                                        <td>
                                            <a href="?a=edit_patient&id=<?php echo $patient['patient_id']; ?>" class="btn btn-warning">Edit</a>
                                            <a href="?a=patients&id=<?php echo $patient['patient_id']; ?>" 
                                            class="btn btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelleFcally="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="patients.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientModalLabel">Add New Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_patient" class="btn btn-primary">Add Patient</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>




