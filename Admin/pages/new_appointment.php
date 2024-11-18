<?php
// Check if admin is logged in (assuming you have an authentication check function)
$patient_id = isset($_GET['id']) ? $_GET['id'] : '';
$data = $Fcall->Targeted_info('patients', 'patient_id', $patient_id);
$patient_name=  $data['first_name'] . " " . $data['last_name'];

// Fetch patients, doctors, and services
$patients = $Fcall->getPatients();
$doctors = $Fcall->getDoctors();
$services = $Fcall->getServices();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $appointment_date = $_POST['appointment_date'];
    $time = $_POST['time'];
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = $_POST['doctor_name'];
    $service_id = $_POST['service_id'];
    $service_name = $_POST['service_name'];
    $status = $_POST['status'];
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
            window.location.href = "?a=appointments"; // Redirect to appointments list page
        });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error creating appointment.", "warning")</script>';
    }
}
?>



<!-- HTML form for managing patient information -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Appointment</p>
                        <a class="btn btn-primary btn-sm ms-auto" onclick="history.back()">Back</a>
                        <a href="?a=appointments" class="btn btn-primary btn-sm ms-auto">View Appointment</a>
                    </div>
                </div>

                <div class="card-body p-4">
                <form method="post">
            <div class="row">
                <!-- Select Patient -->
                <div class="col-md-6">
                <div class="form-group">
                        <label for="patient_id">Patient:</label>
                        <?php if (!empty($patient_id)): ?>
                            <!-- Auto-assign the patient ID if it's set -->
                            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($patient_name); ?>" readonly>
                        <?php else: ?>
                            <!-- Dropdown for selecting a patient -->
                            <select name="patient_id" class="form-control" required>
                                <option value="">Select Patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo $patient['patient_id']; ?>">
                                        <?php echo htmlspecialchars(string: $patient['first_name'] . " " . $patient['last_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Appointment Date -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="appointment_date">Date:</label>
                        <input type="date" class="form-control" name="appointment_date" required>
                    </div>
                </div>

                <!-- Appointment Time -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                </div>

                <!-- Select Doctor -->
                <div class="col-md-6">
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
                </div>

                <!-- Select Service -->
                <div class="col-md-6">
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
                </div>

                <!-- Appointment Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>

                <!-- Special Request -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="special_request">Special Request (Optional):</label>
                        <textarea class="form-control" name="special_request"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block float-right">Create Appointment</button>
                </div>
            </div>
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