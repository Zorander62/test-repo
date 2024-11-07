<?php
$doctors = $Fcall->getDoctors();
$services = $Fcall->getServices();

$data = $Fcall->Targeted_info('patients', 'email', $_SESSION['email']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $patient_id = $data['patient_id'];
  $appointment_date = $_POST['appointment_date'];
  $time = $_POST['time'];
  $doctor_id = $_POST['doctor_id'];
  $doctor_name = $_POST['doctor_name'];
  $service_id = $_POST['service_id'];
  $service_name = $_POST['service_name'];
  $status = "scheduled";
  $special_request = $_POST['special_request'];

  // Insert into the appointments table
  $stmt = $Fcall->prepare("
      INSERT INTO appointments 
      (patient_id, appointment_date, time, doctor_id, doctor_name, service_id, service, status, special_request) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  ");
  $stmt->bind_param(
      "sssssssss",
      $patient_id,
      $appointment_date,
      $time,
      $doctor_id,
      $doctor_name,
      $service_id,
      $service_name,
      $status,
      $special_request
  );

  if ($stmt->execute()) {
      echo '<script>
      swal("Success", "Appointment created successfully.", "success")
      .then((value) => {
          window.location.href = "?a=appointment"; // Redirect to appointments list page
      });
      </script>';
  } else {
      echo '<script>swal("Warning", "Error creating appointment.", "warning")</script>';
  }
}






// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $doctor_id = $_POST['doctor_id'];
//   $appointment_time = $_POST['appointment_time'];
//   $reason = $_POST['reason'];
//   $user_id = $_SESSION['user_id']; // Assuming user is logged in

//   // Insert into appointments table
//   $stmt = $db->prepare("INSERT INTO appointments (user_id, doctor_id, appointment_time, reason) VALUES (?, ?, ?, ?)");
//   $stmt->bind_param("iiss", $user_id, $doctor_id, $appointment_time, $reason);
//   if ($stmt->execute()) {
//       echo "Appointment successfully booked!";
//   } else {
//       echo "Error booking appointment.";
//   }
// }

?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Create Appointment</p>
                <a href="?a=view_appointments" class="btn btn-primary btn-sm ms-auto">View Appointments</a>
              </div>
            </div>

            <div class="card-body p-4 ">

            <!-- <form action="" method="post">
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="datetime-local" name="appointment_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="special_request">Special Request:</label>
                <textarea name="special_request" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Appointment</button>
        </form> -->

        <form action="?a=appointment" method="POST">


       
                    <div class="form-group">
                        <label for="doctor_id">Assign Doctor:</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="">Select Doctor</option>
                            <?php foreach ($doctors as $doctor): ?>
                                <option value="<?php echo $doctor['doctor_id']; ?>" data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>">
                                    <?php echo htmlspecialchars($doctor['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="doctor_name" id="doctor_name">
                        
                    </div>
        

                <!-- Select Service -->
               
                    <div class="form-group">
                        <label for="service_id">Service:</label>
                        <select name="service_id" class="form-control" required>
                            <option value="">Select Service</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?php echo $service['ServiceID']; ?>" data-service-name="<?php echo htmlspecialchars($service['ServiceName']); ?>">
                                    <?php echo htmlspecialchars($service['ServiceName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="service_name" id="service_name">
                    </div>
                


       <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
            <label for="appointment_time">Select Date:</label>
            <input type="date" name="appointment_date" required class="form-control">
            </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                <label for="time">Select Time:</label>
                                <input type="time" name="time" required class="form-control">
                                </div>
                              </div>

       </div>
            
            <div class="form-group"></div>
            <label for="reason">Reason for Appointment:</label>
            <textarea name="special_request" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Book Appointment</button>
            <!-- <button class="btn btn form-control" type="submit">Book Appointment</button> -->
        </form>

</div>

  </div>
  </div>
  </div>
  </div>



  <script>
    // JavaScript to populate hidden fields for doctor_name and service_name based on dropdown selection
    document.querySelector('select[name="doctor_id"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('doctor_name').value = selectedOption.getAttribute('data-doctor-name');
    });

    document.querySelector('select[name="service_id"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('service_name').value = selectedOption.getAttribute('data-service-name');
    });
    </script>