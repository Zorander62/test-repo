<?php
// Start session and include database connection
$appointment_id = $_GET['id'];
$appointment = $Fcall->getAppointmentDetails($appointment_id);

if (!$appointment) {
    echo '<script>swal("Warning", "Appointment not found.", "warning")</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data and validate inputs
    $appointment_date = $_POST['appointment_date'];
    $time = $_POST['time'];
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = $_POST['doctor_name']; // Retrieve doctor_name based on selection
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name']; // Retrieve service_name based on selection
    $status = $_POST['status'];
    $special_request = $_POST['special_request'];

    // Validate and update data
    if (!empty($appointment_date) && !empty($time) && !empty($doctor_id) && !empty($service_id)) {
        $updateStmt = $Fcall->prepare("
            UPDATE appointments 
            SET appointment_date = ?, time = ?, doctor_id = ?, doctor_name = ?, service_id = ?, service = ?, status = ?, special_request = ? 
            WHERE appointment_id = ?
        ");
        
        $updateStmt->bind_param(
            "ssssssssi",
            $appointment_date,
            $time,
            $doctor_id,
            $doctor_name,
            $service_id,
            $service_name,
            $status,
            $special_request,
            $appointment_id
        );

        if ($updateStmt->execute()) {
            echo '<script>
            swal("Success", "Appointment updated successfully.", "success")
            .then((value) => {
                window.location.href = "?a=appointments";
            });
            </script>';
        } else {
            echo '<script>swal("Warning", "Error updating appointment.", "warning")</script>';
        }
    } else {
        echo '<script>swal("Warning", "Please fill out all required fields.", "warning")</script>';
    }
}

$doctors = $Fcall->getDoctors();
$services = $Fcall->getServices();
?>



<!-- HTML form for managing patient information -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Appointment Details</p>
                        <a href="?a=appointments" class="btn btn-primary btn-sm ms-auto">View Appointment</a>
                    </div>
                </div>

                <div class="card-body p-4">
                <form method="post">
    <div class="row">

    <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input readonly type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($appointment['first_name']); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Last Name:</label>
                                    <input  readonly type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($appointment['last_name']); ?>" required>
                                </div>
                            </div>
        

        <div class="col-md-6">
            <div class="form-group">
                <label for="doctor_id">Assign Doctor:</label>
                <select name="doctor_id" class="form-control" required>
                    <option value="<?php echo htmlspecialchars($appointment['doctor_id']); ?>"><?php echo htmlspecialchars($appointment['doctor_name']); ?></option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['doctor_id']; ?>" data-doctor-name="<?php echo htmlspecialchars($doctor['name']); ?>">
                            <?php echo htmlspecialchars($doctor['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="doctor_name" id="doctor_name" value="<?php echo htmlspecialchars($appointment['doctor_name']); ?>">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="appointment_date">Date:</label>
                <input type="date" class="form-control" name="appointment_date" value="<?php echo htmlspecialchars($appointment['appointment_date']); ?>" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" name="time" value="<?php echo htmlspecialchars($appointment['time']); ?>" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="service_id">Service:</label>
                <select name="service_id" class="form-control" required>
                    <option value="<?php echo htmlspecialchars($appointment['service_id']); ?>"><?php echo htmlspecialchars($appointment['service']); ?></option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?php echo $service['ServiceID']; ?>" data-service-name="<?php echo htmlspecialchars($service['ServiceName']); ?>">
                            <?php echo htmlspecialchars($service['ServiceName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="service_name" id="service_name" value="<?php echo htmlspecialchars($appointment['service']); ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control">
                    <option value="<?php echo htmlspecialchars($appointment['status']); ?>"><?php echo htmlspecialchars($appointment['status']); ?></option>
                    <option value="canceled">Cancel</option>
                    <option value="completed">Complete</option>
                    <option value="scheduled">Schedule</option>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="special_request">Special Request (Optional):</label>
                <textarea class="form-control" name="special_request"><?php echo htmlspecialchars($appointment['special_request']); ?></textarea>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block float-right">Update</button>
        </div>
    </div>
</form>



                </div>
            </div>
        </div>
    </div>
</div>


                            <script>
// JavaScript to update hidden fields for doctor_name and service_name based on selection
document.querySelector('select[name="doctor_id"]').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('doctor_name').value = selectedOption.getAttribute('data-doctor-name');
});

document.querySelector('select[name="service_id"]').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('service_name').value = selectedOption.getAttribute('data-service-name');
});
</script>