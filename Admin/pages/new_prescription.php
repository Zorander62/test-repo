<?php
// Assuming $Fcall is the controller object with methods to retrieve data and save prescriptions

// Fetch medications for the dropdown
$medications = $Fcall->getMedications();
$data =  $Fcall->Targeted_info('doctors','email',$_SESSION['username']);
$docid = $data['doctor_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $medication_id = $_POST['medication_id'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $instructions = $_POST['instructions'];

    // Add the prescription and calculate the duration
    $Fcall->addPrescription([
        'patient_id' => $patient_id,
        'doctor_id' => $doctor_id,
        'medication_id' => $medication_id,
        'dosage' => $dosage,
        'frequency' => $frequency,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'instructions' => $instructions
    ]);

    echo '<script>alert("Success","Prescription added successfully!","success"); window.location.href="?a=prescription&patient_id=' . $patient_id . '";</script>';
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">New Prescription</p>
                        <a href="?a=manage_prescription" class="btn btn-primary btn-sm ms-auto">View Prescription</a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" >
                        <input type="hidden" name="patient_id" value="<?php echo $_GET['patient_id']; ?>">
                        <input type="hidden" name="doctor_id" value="<?php echo $docid; ?>">

                        <div class="form-group">
                            <label for="medication">Medication</label>
                            <select class="form-control" name="medication_id" required>
                                <option value="">Select Medication</option>
                                <?php foreach ($medications as $medication): ?>
                                    <option value="<?php echo $medication['medication_id']; ?>">
                                        <?php echo htmlspecialchars($medication['name']); ?> - $<?php echo $medication['price']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosage">Dosage</label>
                            <input type="text" class="form-control" name="dosage" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <input type="text" class="form-control" name="frequency" required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>

                        <div class="form-group">
                            <label for="instructions">Instructions</label>
                            <textarea class="form-control" name="instructions"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Prescription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>