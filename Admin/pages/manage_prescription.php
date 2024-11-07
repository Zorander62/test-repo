<?php
// Fetch all patients from the database
$patients = $Fcall->getAllPatients();

if (!$patients) {
    echo "<p>No patients found.</p>";
    exit;
}
?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Patient Prescription</p>
               
              </div>
            </div>

            <div class="card-body p-4 ">
        
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($patients as $patient): ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo htmlspecialchars($patient['first_name']." ".$patient['last_name']); ?></td>
                  <td><?php echo htmlspecialchars($patient['phone_number']); ?></td>
                  <td><?php echo htmlspecialchars($patient['gender']); ?></td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="?a=prescription&patient_id=<?php echo $patient['patient_id']; ?>">Manage Prescriptions</a>
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
