<?php

// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $appointment_date = $_POST['appointment_date'];
//     $special_request = $_POST['special_request'];

//     // Insert appointment into the database
//     $patient_id = $_SESSION['patient_id']; // Assuming you have the patient ID stored in the session
//     $db->insertAppointment($patient_id, $appointment_date, $special_request);
//     echo '<script>alert("Appointment created successfully!");</script>';
// }

?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Billing Management</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
                <table class="table align-items-center mb-0"><

      
            <thead>
                <tr>
                <th>Patient</th>
            <th>Service</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
            </div>




</div>

  </div>
  </div>
  </div>
  </div>



