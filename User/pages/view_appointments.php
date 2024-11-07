


<?php

// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $appointment_id = $_POST['appointment_id'];
//     $Fcall->cancelAppointment($appointment_id); // Assuming you have a method to cancel appointments
//     echo '<script>alert("Appointment canceled successfully!");</script>';
// }

// Fetch appointments for the user
//$appointments = $Fcall->getAppointmentsByUserId($_SESSION['user_id']); // Assuming you have this method
$data = $Fcall->Targeted_info('patients', 'email', $_SESSION['email']);
$patient_id = $data['patient_id'];
$appointments = $Fcall->getAppointmentsByPatientId($patient_id);

// cancel_appointment.php (continued)

if (isset($_GET['appointment_id'])) {
  $appointment_id = $_GET['appointment_id'];

  // Prepare the delete query
  $stmt = $Fcall->prepare("DELETE FROM appointments WHERE appointment_id = ? AND patient_id = ?");
  $stmt->bind_param("ii", $appointment_id, $patient_id);

  if ($stmt->execute()) {
      // Successfully deleted, show success message
      echo '<script>
          swal("Success", "Appointment successfully canceled!", "success")
          .then((value) => {
              window.location.href = "?a=cancel_apointment"; // Redirect to cancel appointment page
          });
      </script>';
  } else {
      // Error occurred, show warning message
      echo '<script>swal("Warning", "Error canceling appointment.", "warning")</script>';
  }
}





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

            <?php if ($appointments->num_rows > 0): ?>
            <table class="table table-bordered appointment-table">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Date </th>
                        <th> Time</th>
                        <th>Service</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php while ($appointment = $appointments->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($appointment['doctor_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['service']); ?></td>
                          
                            <td><?php echo htmlspecialchars($appointment['status']); ?></td>

                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                You have no appointments scheduled.
            </div>
        <?php endif; ?>

            </div>



  </div>
  </div>
  </div>
  </div>



