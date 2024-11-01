<?php


//$patient_id = $_GET['id']; // Get patient ID from URL
//$medical_records = $db->getMedicalRecordsByPatientId($patient_id); // Assuming this function exists
?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Medical Records for Patient ID: <?php //echo $patient_id; ?></p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
              <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Doctor</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($medical_records as $record): ?>
                    <tr>
                        <td><?php //echo date('Y-m-d', strtotime($record['created_at'])); ?></td>
                        <td><?php //echo $record['description']; ?></td>
                        <td><?php //echo $record['doctor_name']; ?></td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
    </div>

 




</div>

  </div>
  </div>
  </div>
  </div>


t
