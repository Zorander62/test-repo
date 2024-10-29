


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
                <p class="mb-0">Cancel Appointments</p>
                <button class="btn btn-primary btn-sm ms-auto">Appointments</button>
              </div>
            </div>

            <div class="card-body p-4 ">

            <form action="" method="post">
            <div class="form-group">
                <label for="appointment_id">Select Appointment to Cancel:</label>
                <select name="appointment_id" class="form-control" required>
                    <?php //foreach ($appointments as $appointment): ?>
                        <option value="<?php //echo $appointment['appointment_id']; ?>">
                            <?php //echo $appointment['appointment_date']; ?>
                        </option>
                    <?php //endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Cancel Appointment</button>
        </form>

            </div>



  </div>
  </div>
  </div>
  </div>



