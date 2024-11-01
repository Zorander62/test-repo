<?php


//$prescriptions = $db->getAllPrescriptions(); // Assuming this function exists
?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Inventory</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
              <button class="btn btn-primary" data-toggle="modal" data-target="#addMedicationModal">Add New Medication</button>
              <table class="table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prescriptions as $prescription): ?>
                    <tr>
                        <td><?php echo $prescription['patient_name']; ?></td>
                        <td><?php echo $prescription['medication_name']; ?></td>
                        <td><?php echo $prescription['dosage']; ?></td>
                        <td><?php echo $prescription['instructions']; ?></td>
                        <td>
                            <a href="edit_prescription.php?id=<?php echo $prescription['prescription_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_prescription.php?id=<?php echo $prescription['prescription_id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="addMedicationModal" tabindex="-1" role="dialog" aria-labelledby="addMedicationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="add_medication.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMedicationModalLabel">Add New Medication</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="medication_name">Medication Name:</label>
                            <input type="text" class="form-control" name="medication_name" required>
                        </div>
                        <div class="form-group">
                            <label for="dosage">Dosage:</label>
                            <input type="text" class="form-control" name="dosage" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Medication</button>
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
