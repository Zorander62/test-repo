


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

            <form>
    <div class="form-group">
        <label for="clinicName">Clinic Name</label>
        <input type="text" class="form-control" id="clinicName" value="Your Clinic Name">
    </div>
    <div class="form-group">
        <label for="clinicAddress">Address</label>
        <input type="text" class="form-control" id="clinicAddress" value="123 Clinic St.">
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

            </div>



  </div>
  </div>
  </div>
  </div>



