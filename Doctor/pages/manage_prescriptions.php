<?php


//$patient_id = $_GET['id']; // Get patient ID from URL
//$prescriptions = $db->getPrescriptionsByPatientId($patient_id); // Assuming this function exists
?>



<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Prescriptions</p>
                
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
              <table class="table">
            <thead>
                <tr>
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prescriptions as $prescription): ?>
                    <tr>
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

 




</div>

  </div>
  </div>
  </div>
  </div>


t
