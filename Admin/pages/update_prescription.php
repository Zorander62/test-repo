<?php
// Fetch prescription details by ID and handle the update
if (isset($_GET['id'])) {
    $prescription_id = $_GET['id'];
    $prescription = $Fcall->getPrescriptionById($prescription_id);
    $prescription_items = $Fcall->getPrescriptionItems($prescription_id);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'prescription_id' => $_POST['prescription_id'],
        'patient_id' => $_POST['patient_id'],
        'doctor_id' => $_POST['doctor_id'],
        'medication_id' => $_POST['medication_id'],
        'dosage' => $_POST['dosage'],
        'frequency' => $_POST['frequency'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'instructions' => $_POST['instructions'],
        'status' => $_POST['status']
    ];

    if ($Fcall->updatePrescription($data)) {
        echo '<script>
        swal("Success", "Prescription updated successfully.", "success")
        .then((value) => {
            window.location.href = "?a=prescriptions_pharmacy";
        });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error updating prescription.", "warning")</script>';
    }




}



$data = $Fcall->Targeted_info('patients', 'patient_id', $prescription['patient_id']);
    $doctor = $Fcall->Targeted_info('doctors', 'doctor_id', $prescription['doctor_id']);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Update Prescription</h5>
                        <a class="btn btn-primary btn-sm ms-auto" onclick="history.back()">Back</a>
                </div>
                <div class="card-body"></div>
     <p><strong>Patient:</strong> <?php echo htmlspecialchars($data['first_name']." ".$data['last_name']); ?></p>
    <p><strong>Doctor:</strong> <?php echo htmlspecialchars($doctor['name']); ?></p>
    <p><strong>Date Prescribed:</strong> <?php echo htmlspecialchars($prescription['created_at']); ?></p>
    
    <form action="" method="POST">
        <input type="hidden" name="prescription_id" value="<?php echo htmlspecialchars($prescription['prescription_id']); ?>">

        <div class="mb-3">
            <!-- <label for="patient_id" class="form-label">Patient ID</label> -->
            <input type="hidden" name="patient_id" class="form-control" id="patient_id" value="<?php echo htmlspecialchars($prescription['patient_id']); ?>" required>
        </div>

        <div class="mb-3">
            <!-- <label for="doctor_id" class="form-label">Doctor ID</label> -->
            <input type="hidden" name="doctor_id" class="form-control" id="doctor_id" value="<?php echo htmlspecialchars($prescription['doctor_id']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="medication_id" class="form-label">Medication ID</label>
            <input type="text" name="medication_id" class="form-control" id="medication_id" value="<?php echo htmlspecialchars($prescription['medication_id']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" name="dosage" class="form-control" id="dosage" value="<?php echo htmlspecialchars($prescription['dosage']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="frequency" class="form-label">Frequency</label>
            <input type="text" name="frequency" class="form-control" id="frequency" value="<?php echo htmlspecialchars($prescription['frequency']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo htmlspecialchars($prescription['start_date']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo htmlspecialchars($prescription['end_date']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea name="instructions" class="form-control" id="instructions" rows="3" required><?php echo htmlspecialchars($prescription['instructions']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status" required>
                <option value="active" <?php echo ($prescription['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?php echo ($prescription['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                <option value="completed" <?php echo ($prescription['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Prescription</button>
    </form>
</div>