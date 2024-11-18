<?php
  require_once "../model/function.php";
  $Call = new mainClass();
  $doctors = $Fcall->getDoctors();
  // Get the patient ID from URL
  $patient_id = isset($_GET['id']) ? $_GET['id'] : '';
  

  // Fetch the patient's basic information
  $conn = mysqli_connect($Call->host, $Call->user, $Call->password, $Call->DB);
  $query = "SELECT * FROM patients WHERE patient_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $patient_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $patient = $result->fetch_assoc();

  // Fetch medical history, appointments, prescriptions, billing, and test results
  // Example queries:
  $VitalRecordsQuery = "SELECT * FROM vitals WHERE patient_id = ?";
  $OrdermedicalRecordsQuery = "SELECT * FROM medical_records WHERE patient_id = ?";
  $medicalHistoryQuery = "SELECT * FROM medical_history WHERE patient_id = ?";
  $appointmentsQuery = "SELECT * FROM appointments WHERE patient_id = ?";
  $prescriptionsQuery = "SELECT * FROM prescriptions WHERE patient_id = ?";
  $labResultsQuery = "SELECT * FROM samples WHERE patient_id = ?";
  $billingQuery = "SELECT * FROM billing WHERE patient_id = ?";

  // Preparing and executing queries
  $stmtVitalRecords = $conn->prepare($VitalRecordsQuery);
  $stmtVitalRecords->bind_param('i', $patient_id);
  $stmtVitalRecords->execute();
  $VitalResult = $stmtVitalRecords->get_result();

  $stmtMedicalRecords = $conn->prepare($OrdermedicalRecordsQuery);
  $stmtMedicalRecords->bind_param('i', $patient_id);
  $stmtMedicalRecords->execute();
  $medicalRecordsResult = $stmtMedicalRecords->get_result();

  $stmtMedicalHistory = $conn->prepare($medicalHistoryQuery);
  $stmtMedicalHistory->bind_param('i', $patient_id);
  $stmtMedicalHistory->execute();
  $medicalHistoryResult = $stmtMedicalHistory->get_result();

  $stmtAppointments = $conn->prepare($appointmentsQuery);
  $stmtAppointments->bind_param('i', $patient_id);
  $stmtAppointments->execute();
  $appointmentsResult = $stmtAppointments->get_result();

  $stmtPrescriptions = $conn->prepare($prescriptionsQuery);
  $stmtPrescriptions->bind_param('i', $patient_id);
  $stmtPrescriptions->execute();
  $prescriptionsResult = $stmtPrescriptions->get_result();

  $stmtLabResults = $conn->prepare($labResultsQuery);
  $stmtLabResults->bind_param('i', $patient_id);
  $stmtLabResults->execute();
  $labResultsResult = $stmtLabResults->get_result();

  $stmtBilling = $conn->prepare($billingQuery);
  $stmtBilling->bind_param('i', $patient_id);
  $stmtBilling->execute();
  $billingResult = $stmtBilling->get_result();



  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_record'])) {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $reason = $_POST['reason'];
    $comments = $_POST['comments'];
    

    // SQL Insert Query
    $query = "INSERT INTO medical_records (patient_id, doctor_id, reason, description	, date) 
              VALUES (?, ?, ?, ?,  NOW())";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $reason, $comments);

    if ($stmt->execute()) {
        //echo "Record saved successfully!";
        echo '<script>
        swal("Success", "Record saved successfully!", "success")
        .then((value) => {
            window.location.href = "?a=view_patient&id='.$patient_id.'";
        });
    </script>';
    } else {
      echo '<script>swal("Warning","Error unable to save.","warning")</script>';

        //echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}


// Validate POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_vitals'])) {
    $patient_id = $_POST['patient_id'];
    $blood_pressure = $_POST['blood_pressure'];
    $heart_rate = $_POST['heart_rate'];
    $temperature = $_POST['temperature'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $oxygen_saturation = $_POST['oxygen_saturation'];
    $pulse_oximetry = $_POST['pulse_oximetry'];

    // Insert into vitals table
   if( $Fcall->addVitals( $patient_id,$blood_pressure,$heart_rate,$temperature,$weight,$height,$respiratory_rate,$oxygen_saturation, $pulse_oximetry)){

        echo '<script>
        swal("Success", "Vatals Added successfully!", "success")
        .then((value) => {
            window.location.href = "?a=view_patient&id='.$patient_id.'";
        });
    </script>';

    }else{
        echo '<script>swal("Warning","Error unable to add vitals.","warning")</script>';
    }

    // Redirect back to the view patient page
    
}

?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Search Patient - <?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?> <a href="?a=edit_user&id=<?php echo $patient['user_id']; ?>" class="btn btn-warning">Edit</a></h5>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Patient Basic Information Section -->

                    <div class="row">

                        <div class="col-6">
                          <div class="section mb-4">
                          
                              <h6 class="text-primary font-weight-bold">Basic Information</h6>
                              <table class="table table-striped table-bordered">
                              <tr>
                                <td><strong>Name:</strong></td>
                                <td><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo $patient['email']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Phone:</strong></td>
                                <td><?php echo $patient['phone_number']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Date of Birth:</strong></td>
                                <td><?php echo $patient['date_of_birth']; ?></td>
                              </tr>
                              </table>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="section mb-4">
                              <h6 class="text-primary font-weight-bold">Other Information</h6>
                              <table class="table table-striped table-bordered">
                              <tr>
                                <td><strong>Gender:</strong></td>
                                <td><?php echo $patient['gender']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Blood Type:</strong></td>
                                <td><?php echo $patient['blood_type']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Address:</strong></td>
                                <td><?php echo $patient['address']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>City:</strong></td>
                                <td><?php echo $patient['city']; ?></td>
                              </tr>
                              </table>
                          </div>
                        </div>
                    </div>
                    
<hr>
                    <!-- Medical History Section -->
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Medical History</h6>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Blood Pressure</th>
                                <th>Heart Rate</th>
                                <th>Temperature</th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Respiratory Rate</th>
                                <th>Oxygen Saturation</th>
                                <th>Pulse Oximetry</th>
                            </tr>
                        </thead>
                            </thead>
                            <tbody>
                            <?php
                            // Fetch vitals for the patient
                           // $vitals = $Fcall->getVitalsByPatientId($patient_id);
                            if (!empty($VitalResult)) {
                                foreach ($VitalResult as $vital) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($vital['created_at']) . "</td>";
                                    echo "<td>" . htmlspecialchars($vital['blood_pressure']) . "</td>";
                                    echo "<td>" . htmlspecialchars($vital['heart_rate']) . "</td>";
                                    echo "<td>" . htmlspecialchars($vital['temperature']) . "°C</td>";
                                    echo "<td>" . htmlspecialchars($vital['weight']) . " kg</td>";
                                    echo "<td>" . htmlspecialchars($vital['height']) . " cm</td>";
                                    echo "<td>" . htmlspecialchars($vital['respiratory_rate']) . "</td>";
                                    echo "<td>" . htmlspecialchars($vital['oxygen_saturation']) . "%</td>";
                                    echo "<td>" . htmlspecialchars($vital['pulse_oximetry']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No vitals recorded for this patient.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#addVitalsModal">
                            Add Vitals
                        </button>
                    </div>

                    <hr>
                    <hr>
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Medical Records  </h6>
                        <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#consultationModal">
                            Add Record
                        </button>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                   
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $medicalRecordsResult->fetch_assoc()): ?>
                                    <tr>
                                       
                                        <td><?php echo $row['doctor_id']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <hr>
                    <!-- Appointments Section -->
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Appointments</h6>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                   
                                    <th>Date</th>
                                    <th>Doctor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $appointmentsResult->fetch_assoc()): ?>
                                    <tr>
                                        
                                        <td><?php echo $row['appointment_date']; ?></td>
                                        <td><?php echo $row['doctor_name']; ?></td>
                                        <td><a href="?a=appointment_details&id=<?php echo $row['appointment_id']?>" class="btn btn-info btn-sm">View</a></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php if (in_array($role, ['admin', 'receptionist', 'doctor'])): ?>
                            <a href="?a=new_appointment&id=<?php echo $patient_id?>" class="btn btn-primary btn-sm ms-auto">New Appointment</a>
                            <?php endif; ?>
                            <!-- <a href="#" class="btn btn-success btn-sm">Add New Appointment</a> -->
                        </div>
                        <hr><hr>
                    <!-- Prescriptions Section -->
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Prescriptions</h6>
                        
                            <!-- <a href="#" class="btn btn-success btn-sm">Add New Appointment</a> -->
                        <!-- </div> -->
                    
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                               
                                <th>Doctor</th>
                                <th>Name</th>
                                <th>Date Prescribed</th>
                                <th>Status</th>
                                <th>Actions</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $prescriptionsResult->fetch_assoc()):
                                     $data =  $Fcall->Targeted_info('medications','medication_id',$row['medication_id']);
                                     $pat = $Fcall->Targeted_info('patients', 'patient_id', $row['patient_id']);
                                     $doctor = $Fcall->Targeted_info('doctors', 'doctor_id', $row['doctor_id']);
                                    ?>
                                    <tr>
                                  

                                        <td>
                                            <?php 
                                                // Check if doctor data exists, otherwise display empty
                                                echo isset($doctor['name']) ? htmlspecialchars($doctor['name']) : "";
                                            ?>
                                        </td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td>
                                            <!-- Action buttons with icons and styling -->
                                            <a href="?a=view_prescription&id=<?php echo $row['prescription_id']; ?>" class="btn btn-sm btn-info">
                                                <i class="ni ni-eye"></i> View
                                            </a>

                                            <?php if (in_array($role, ['admin',  'doctor', 'pharmacy'])): ?>
                                            <a href="?a=update_prescription&id=<?php echo $row['prescription_id']; ?>" class="btn btn-sm btn-warning">
                                                <i class="ni ni-settings"></i> Update
                                            </a>
                                            <?php endif; ?>
                                         </td>
                                        
                                       
                                        
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php if (in_array($role, ['admin',  'doctor', 'pharmacy'])): ?>
                            <a href="?a=prescription&patient_id=<?php echo $patient_id?>" class="btn btn-primary btn-sm ms-auto">Manage Prescription</a>
                            <a href="?a=new_prescription&patient_id=<?php echo $patient_id; ?>" class="btn btn-primary btn-sm float-right ml-auto">Add New Prescription</a>
                        <?php endif; ?>
                    </div>
                    <hr><hr>
                    <!-- Lab Results Section -->
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Lab Results</h6>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $labResultsResult->fetch_assoc()): 
                                    $data =  $Fcall->Targeted_info('tests','test_id',$row['test_id']);
                                    ?>
                                    <tr>
                                        <td><?php echo $row['sample_id']; ?></td>
                                        <td><?php echo $row['date_collected']; ?></td>
                                        <td><?php echo $data['test_name']; ?></td>
                                        <td><?php echo $row['sample_type']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <?php if (in_array($role, ['admin',  'laboratory'])): ?>
                            <a href="?a=manage_samples&id=<?php echo $patient_id?>" class="btn btn-primary btn-sm ms-auto">Add Result</a>
                        <?php endif; ?>
                    </div>
                    <hr><hr>
                    <!-- Billing Information Section -->
                    <div class="section mb-4">
                        <h6 class="text-primary font-weight-bold">Billing</h6>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Invoice Date</th>
                                    <th>Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $billingResult->fetch_assoc()): ?>
                                    <tr>
                                       
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td><?php echo $row['total_amount']; ?></td>
                                        <td><?php echo $row['paid_amount']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="?a=view_bill&id=<?php echo $row['billing_id']; ?>">View</a> |
                                            <a class="btn btn-primary" href="?a=manage_payment&bill_id=<?php echo $row['billing_id']; ?>">Manage Payment</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Add New Record Button -->
                        <?php if (in_array($role, ['admin', 'receptionist', 'doctor'])): ?>
                            <a href="?a=new_billing&id=<?php echo $patient_id?>" class="btn btn-primary btn-sm ms-auto">Add Bill</a>
                            <!-- <a href="#" class="btn btn-success btn-lg">Add New Record</a> -->
                            <?php endif; ?>
                            <!-- <a href="#" class="btn btn-success btn-sm">Add New Appointment</a> -->
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php
  $stmt->close();
  $conn->close();
?>


<form method="post">
<!-- Modal Structure -->
<div class="modal fade" id="consultationModal" tabindex="-1" aria-labelledby="consultationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="consultationModalLabel">Add Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php

                    $doc =  $Fcall->Targeted_info('doctors','doctor_id',$_SESSION['user_id']);

                ?>
                <!-- Consultation Form -->
                <form id="consultationForm" method="post" action="save_consultation.php">
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient</label>
                        <input type="text" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>" class="form-control" required>
           
                     
                    </div>
                    <div class="mb-3">
                          <label for="doctor_id" class="form-label">Doctor</label>
                          <?php if ($_SESSION['role'] == 'doctor'): ?>
                              <!-- Auto-assign the doctor ID for doctors -->
                              <input type="hidden" id="doctor_id" name="doctor_id" value="<?php echo $_SESSION['user_id']; ?>">
                              <input type="text" class="form-control" value="<?php echo $doc['name']; ?>" readonly>
                          <?php else: ?>
                              <!-- Dropdown for other roles -->
                              <select id="doctor_id" name="doctor_id" class="form-control" required>
                                  <option value="">Select Doctor</option>
                                  <?php foreach ($doctors as $doctor): ?>
                                      <option value="<?php echo $doctor['doctor_id']; ?>">
                                          <?php echo $doctor['name']; ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          <?php endif; ?>
                     </div>

                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for the Reacord</label>
                        <input type="text" id="reason" name="reason" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Doctor's Comments</label>
                        <textarea id="comments" name="comments" class="form-control" rows="3" required></textarea>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_record" class="btn btn-primary">Save Record</button>
            </div>
        </div>
    </div>
</div>
</form>


<form method="POST">

<!-- Add Vitals Modal -->
<div class="modal fade" id="addVitalsModal" tabindex="-1" aria-labelledby="addVitalsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
                <div class="modal-header">
                    <h5 class="modal-title" id="addVitalsModalLabel">Add Patient Vitals</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Field for Patient ID -->
                    <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patient_id); ?>">

                    <!-- Vitals Input Fields -->
                    <div class="mb-3">
                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" required>
                    </div>
                    <div class="mb-3">
                        <label for="heart_rate" class="form-label">Heart Rate</label>
                        <input type="number" class="form-control" id="heart_rate" name="heart_rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" id="temperature" name="temperature" required>
                    </div>
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" name="weight" required>
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="height" name="height" required>
                    </div>
                    <div class="mb-3">
                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                        <input type="number" class="form-control" id="respiratory_rate" name="respiratory_rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="oxygen_saturation" class="form-label">Oxygen Saturation (%)</label>
                        <input type="number" class="form-control" id="oxygen_saturation" name="oxygen_saturation" required>
                    </div>
                    <div class="mb-3">
                        <label for="pulse_oximetry" class="form-label">Pulse Oximetry</label>
                        <input type="number" class="form-control" id="pulse_oximetry" name="pulse_oximetry" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_vitals">Add Vitals</button>
                </div>
           
        </div>
    </div>
</div>
</form>