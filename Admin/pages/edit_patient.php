<?php
// Start session and include database connection
 // Adjust this to your actual database connection file

// Ensure the patient ID is set in the URL
if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']);

    // Fetch patient data from the database
    $stmt = $Fcall->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $patient = $stmt->get_result()->fetch_assoc();

    // Check if patient data was found
    if (!$patient) {
        echo "Patient not found.";
        exit;
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect form data and validate inputs
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        // Validate and update data
        if (!empty($first_name) && !empty($last_name) && !empty($date_of_birth)) {
            $updateStmt = $Fcall->prepare("UPDATE patients SET first_name = ?, last_name = ?, date_of_birth = ?, gender = ?, phone_number = ?, address = ?, city = ?, country = ? WHERE patient_id = ?");
            $updateStmt->bind_param("ssssssssi", $first_name, $last_name, $date_of_birth, $gender, $phone_number, $address, $city, $country, $patient_id);

            if ($updateStmt->execute()) {
                // Redirect after update
                // header("Location: manage_patients.php");
                // exit;
                echo '<script>
                swal("Success", "Your appointment has been booked successfully.", "success")
                .then((value) => {
                    window.location.href = "?a=patients";
                });
              </script>';
            } else {
                //echo "Error updating patient record.";
                echo '<script>swal("Warning","Error updating patient record.","warning")</script>';
            }

        } else {
            //echo "Please fill out all required fields.";
            echo '<script>swal("Warning","Please fill out all required fields.","warning")</script>';
            }
        }
    } else {
    //echo "No patient ID provided.";
    echo '<script>swal("Warning","No patient ID provided","warning")</script>';
    // exit;
}
?>

<!-- HTML form for managing patient information -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Manage Patients</p>
                        <a href="?a=patients" class="btn btn-primary btn-sm ms-auto">View Patients</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($patient['first_name']); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($patient['last_name']); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_of_birth">DOB:</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="<?php echo htmlspecialchars($patient['date_of_birth']); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <!-- <input type="text" class="form-control" name="gender" value=""> -->
                                    <select name="gender" class="form-control">
                                        <option><?php echo htmlspecialchars($patient['gender']); ?></ooption>
                                        <option>Others</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_number">Phone:</label>
                                    <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($patient['phone_number']); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($patient['address']); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($patient['city']); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country:</label>
                                    <input type="text" class="form-control" name="country" value="<?php echo htmlspecialchars($patient['country']); ?>">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
