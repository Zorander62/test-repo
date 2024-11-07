<?php

if (isset($_POST['delete'])) {
    $prescription_id = $_POST['prescription_id'];
    if ($Fcall->deletePrescription($prescription_id)) {
        echo "Prescription deleted successfully.";
    } else {
        echo "Error deleting prescription.";
    }
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete'])) {
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
// Assuming the `Prescriptions` table and related model or function is already set up
$prescriptions = $Fcall->getAllPrescriptionsCom(); // Get all prescriptions from the database
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Despense List</h5>
                   
                </div>
                <div class="card-body">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor</th>
                                <th>Date Prescribed</th>
                                <th>Status</th>
                                <th>Actions</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($prescriptions as $prescription):
                                    // Fetch patient and doctor info
                                    $data = $Fcall->Targeted_info('patients', 'patient_id', $prescription['patient_id']);
                                    $doctor = $Fcall->Targeted_info('doctors', 'doctor_id', $prescription['doctor_id']);
                                ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                // Check if patient data exists, otherwise display empty
                                                echo isset($data['first_name']) && isset($data['last_name']) ? htmlspecialchars($data['first_name']." ".$data['last_name']) : "";
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                // Check if doctor data exists, otherwise display empty
                                                echo isset($doctor['name']) ? htmlspecialchars($doctor['name']) : "";
                                            ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($prescription['created_at']); ?></td>
                                        <td><?php echo htmlspecialchars($prescription['status']); ?></td>
                                        <td>
                                            <!-- Action buttons with icons and styling -->
                                            <a href="?a=dispense_medication&id=<?php echo $prescription['prescription_id']; ?>" class="btn btn-sm btn-info">
                                                <i class="ni ni-eye"></i>   Dispense Medication
                                            </a>
                                           
                                    </tr>
                                <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
