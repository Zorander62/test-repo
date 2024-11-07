<?php
// Fetch doctor ID from query parameter
// $doctor_id = $_GET['doctor_id'];
$data =  $Fcall->Targeted_info('doctors','email',$_SESSION['username']);
$doctor_id = $data['doctor_id'];// Fetch report data using functions in `function.php`
$total_prescriptions = $Fcall->getPrescriptionCountByDoctor($doctor_id);
$medications = $Fcall->getMedicationsByDoctor($doctor_id);
$patients = $Fcall->getPatientsByDoctor($doctor_id);
$prescription_details = $Fcall->getPrescriptionDetailsByDoctor($doctor_id);

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <h4>Doctor's Report</h4>
                    <p class="mb-0">Summary of doctor’s activity and prescriptions</p>
                </div>

                <div class="card-body p-4">
                    <!-- Summary Stats -->
                    <h5>Overview</h5>
                    <ul>
                        <li><strong>Total Prescriptions:</strong> <?php echo $total_prescriptions; ?></li>
                        <li><strong>Unique Medications Prescribed:</strong> <?php echo count($medications); ?></li>
                        <li><strong>Total Patients:</strong> <?php echo count($patients); ?></li>
                    </ul>

                    <!-- List of Medications -->
                    <h5>Medications Prescribed</h5>
                    <ul>
                        <?php foreach ($medications as $medication): 
                            $data =  $Fcall->Targeted_info('medications','medication_id',$medication['medication_id']);
                            ?>
                            
                            <li><?php echo htmlspecialchars($data['name']); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- List of Patients -->
                    <h5>Patients Seen</h5>
                    <ul>
                        <?php foreach ($patients as $patient): ?>
                            <li><?php echo htmlspecialchars($patient['first_name']); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Prescription Details Table -->
                    <h5>Prescription Details</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Medication</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Instructions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prescription_details as $prescription): 
                                $data =  $Fcall->Targeted_info('patients','patient_id',$prescription['patient_id']);
                                ?>
                                <tr>
                                    <td><?php echo $prescription['created_at']; ?></td>
                                    <td><?php echo htmlspecialchars($data['first_name']." ".$data['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['medication_name']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['dosage']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['frequency']); ?></td>
                                    <td><?php echo htmlspecialchars($prescription['instructions']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Back to Dashboard or Home -->
                    <a href="?a=doctor" class="btn btn-primary mt-3">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
