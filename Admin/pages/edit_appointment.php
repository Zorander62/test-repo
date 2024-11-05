<?php
// Start session and include database connection
 // Adjust this to your actual database connection file
 $appointment_id = $_GET['id'];
 $appointment = $Fcall->getAppointmentDetails($appointment_id);
 if (!$appointment) {
     echo "Appointment not found.";
     exit;
 }


 $doctors = $Fcall->getDoctors();
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
                                    <input type="text" class="form-control"  name="first_name" value="<?php echo htmlspecialchars($appointment['first_name'] . " " . $appointment['last_name']); ?>" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <labe for="last_name">Date | Time:</label>
                                    <input type="text" class="form-control"  name="appointment_date" value="<?php echo htmlspecialchars($appointment['appointment_date']); ?>" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="doctor_id">Assign Doctor:</label>
                                <select name="doctor_id" class="form-control" required>
                                        <option value="">Select a doctor</option>
                                        <?php foreach ($doctors as $doctor): ?>
                                            <option value="<?php echo $doctor['id']; ?>">
                                                <?php echo htmlspecialchars($doctor['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">Status:</label>
                                    <select name="status" class="form-control">
                                        <option><?php echo htmlspecialchars($appointment['status']); ?></option>
                                        <option value="Canceled">Cancel</option>
                                        <option value="Completed">Complete</option>

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="date_of_birth">Request:</label>
                                    <input type="text" class="form-control"  name="special_request" value="<?php echo htmlspecialchars($appointment['special_request']); ?>" >
                                </div>
                            </div>

                          

                            <!-- <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
