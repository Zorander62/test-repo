<?php
$patient_id = $_GET['patient_id'] ?? null;
$prescriptions = $Fcall->getPrescriptionsByPatient($patient_id);

// if (!$prescriptions) {
//     echo "<p>No prescriptions found for this patient.</p>";
//     exit;
// }
?>


                <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
              <p class="mb-0 mr-5">Manage Prescriptions</p>
              <a href="?a=new_prescription&patient_id=<?php echo $patient_id; ?>" class="btn btn-primary btn-sm float-right ml-auto">Add New Prescription</a>
              </div>
            </div>

           
            <div class="card-body p-4 ">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Prescription ID</th>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($prescriptions as $prescription): ?>
                <tr>
                  <td><?php echo $prescription['prescription_id']; ?></td>
                  <td><?php echo htmlspecialchars($prescription['medication_id']); ?></td>
                  <td><?php echo htmlspecialchars($prescription['dosage']); ?></td>
                  <td><?php echo htmlspecialchars($prescription['frequency']); ?></td>
                  <td><?php echo $prescription['start_date']; ?></td>
                  <td><?php echo $prescription['end_date']; ?></td>
                  <td>
                    <a class="btn btn-warning" href="?a=edit_prescription&id=<?php echo $prescription['prescription_id']; ?>">Edit</a>
                    <!-- <a class="btn btn-danger" href="?a=delete_prescription&id=<?php //echo $prescription['prescription_id']; ?>" onclick="return confirm('Are you sure?');">Delete</a> -->
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
