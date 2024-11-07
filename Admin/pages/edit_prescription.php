<?php
// Assuming you already have a function to get a single prescription by ID
$prescription_id = $_GET['id']; // Fetch prescription ID from the query parameter

// Fetch current prescription data
$prescription = $Fcall->getPrescriptionById($prescription_id);

// Check if the prescription exists
if (!$prescription) {
    echo '<p>Prescription not found.</p>';
    exit;
}

// Fetch list of medications from the database
$medications = $Fcall->getMedications(); // Function to get medications list

// Process form submission for updating the prescription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medication = $_POST['medication'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $instructions = $_POST['instructions'];

    // Call function to update the prescription
    $Fcall->updatePrescription([
        'prescription_id' => $prescription_id,
        'medication' => $medication,
        'dosage' => $dosage,
        'frequency' => $frequency,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'instructions' => $instructions
    ]);

    echo '<script>alert("Prescription updated successfully!"); window.location.href="?a=prescription&patient_id=' . $prescription['patient_id'] . '";</script>';
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Prescription</p>
                        <a href="?a=manage_prescriptions&patient_id=<?php echo $prescription['patient_id']; ?>" class="btn btn-primary btn-sm ms-auto">Back to Prescriptions</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="medication">Medication</label>
                            <select class="form-control" name="medication" required>
                                <?php foreach ($medications as $med): ?>
                                    <option value="<?php echo $med['medication_id']; ?>" <?php if ($med['name'] == $prescription['medication_id']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($med['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosage">Dosage</label>
                            <input type="text" class="form-control" name="dosage" value="<?php echo htmlspecialchars($prescription['dosage']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="frequency">Frequency</label>
                            <input type="text" class="form-control" name="frequency" value="<?php echo htmlspecialchars($prescription['frequency']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="<?php echo $prescription['start_date']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="<?php echo $prescription['end_date']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="instructions">Instructions</label>
                            <textarea class="form-control" name="instructions"><?php echo htmlspecialchars($prescription['instructions']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Prescription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
