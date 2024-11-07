


<?php

// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $appointment_id = $_POST['appointment_id'];
//     $Fcall->cancelAppointment($appointment_id); // Assuming you have a method to cancel appointments
//     echo '<script>alert("Appointment canceled successfully!");</script>';
// }

// Fetch appointments for the user
//$appointments = $Fcall->getAppointmentsByUserId($_SESSION['user_id']); // Assuming you have this method

?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Reports</p>
                <button class="btn btn-primary btn-sm ms-auto">Reports</button>
              </div>
            </div>

            <div class="card-body p-4 ">

            <form method="POST">
            <div class="mb-3">
                <label for="clinic_name" class="form-label">Clinic Name</label>
                <input type="text" id="clinic_name" name="clinic_name" class="form-control" value="ABC Clinic">
            </div>
            <div class="mb-3">
                <label for="clinic_address" class="form-label">Clinic Address</label>
                <input type="text" id="clinic_address" name="clinic_address" class="form-control" value="123 Main St, City">
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" class="form-control" value="555-1234">
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>

            </div>



  </div>
  </div>
  </div>
  </div>



