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
                <p class="mb-0">Create Appointment</p>
                <button class="btn btn-primary btn-sm ms-auto">View Appointments</button>
              </div>
            </div>

            <div class="card-body p-4 ">

            <form action="" method="post">
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="datetime-local" name="appointment_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="special_request">Special Request:</label>
                <textarea name="special_request" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Appointment</button>
        </form>

</div>

  </div>
  </div>
  </div>
  </div>



