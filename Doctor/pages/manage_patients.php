<?php


// Fetch patients from the database
//$patients = $db->getAllPatients(); // Assuming this function exists
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

          
          
              <div class="table-responsive p-5">
              
              <button class="btn btn-primary" data-toggle="modal" data-target="#addPatientModal">Add New Patient</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php //echo $patient['first_name'] . ' ' . $patient['last_name']; ?></td>
                        <td><?php //echo $patient['email']; ?></td>
                        <td><?php //echo $patient['phone']; ?></td>
                        <td>
                            <a href="edit_patient.php?id=<?php //echo $patient['patient_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_patient.php?id=<?php //echo $patient['patient_id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal" id="addPatientModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="add_patient.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Patient</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" required>
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
                        <button type="submit" class="btn btn-primary">Add Patient</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>  

            </div>




</div>

  </div>
  </div>
  </div>
  </div>


t