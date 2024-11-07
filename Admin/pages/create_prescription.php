<?php
// Handle form submission and validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $medications = $_POST['medications']; // Array of medication ids and quantities

    // Call function to save the prescription and prescription items
    $Fcall->createPrescription($patient_id, $doctor_id, $medications);
}
?>

<div class="container">
    <h2>Create Prescription</h2>
    <form action="create_prescription.php" method="POST">
        <label for="patient_id">Patient:</label>
        <select name="patient_id" required>
            <!-- Populate with patient data -->
        </select><br>
        
        <label for="doctor_id">Doctor:</label>
        <select name="doctor_id" required>
            <!-- Populate with doctor data -->
        </select><br>

        <label for="medications">Medications:</label>
        <select name="medications[]" multiple required>
            <!-- Populate with available medications -->
        </select><br>

        <button type="submit">Create Prescription</button>
    </form>
</div>
