


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
    <select name="report_type">
        <option value="patient_demographics">Patient Demographics</option>
        <option value="appointment_statistics">Appointment Statistics</option>
        <option value="revenue_report">Revenue Report</option>
    </select>
    <button type="submit" class="btn btn-primary">Generate Report</button>
</form>
<div id="reportResults">
    <!-- Display generated report here -->
</div>

            </div>



  </div>
  </div>
  </div>
  </div>



