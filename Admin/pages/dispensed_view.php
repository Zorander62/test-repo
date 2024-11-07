<?php
// Fetch the dispensed medication details based on the dispensed_id
if (isset($_GET['id'])) {
    $dispensed_id = $_GET['id'];
    $dispensed_medication = $Fcall->Targeted_info('dispensed_medications', 'dispensed_id', $dispensed_id); // Fetch dispensed medication details by ID

    // Fetch prescription and medication details
    $pres = $Fcall->Targeted_info('prescriptions', 'prescription_id', $dispensed_medication['prescription_id']);
    $patient = $Fcall->Targeted_info('patients', 'patient_id', $pres['patient_id']);
    $med = $Fcall->Targeted_info('medications', 'medication_id', $pres['medication_id']);
}
?>
<div class="container">
    <h2>View Dispensed Medication Details</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Transaction Information</h4>
            <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($patient['patient_name']); ?></p>
            <p><strong>Medication Name:</strong> <?php echo htmlspecialchars($med['medication_name']); ?></p>
            <p><strong>Quantity Dispensed:</strong> <?php echo htmlspecialchars($dispensed_medication['quantity']); ?></p>
            <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($dispensed_medication['total_amount']); ?></p>
            <p><strong>Dispensed Date:</strong> <?php echo htmlspecialchars($dispensed_medication['dispensed_at']); ?></p>
        </div>
    </div>

    <a href="dispensed_history.php" class="btn btn-primary">Back to Dispensed Medications History</a>
</div>
