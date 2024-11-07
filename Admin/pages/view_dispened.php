<?php
// Fetch all dispensed medication records
$dispensed_medications = $Fcall->getAllDispensedMedications(); // Adjust if necessary, fetch all dispensed medications

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Dispensed Medications History</h5>
                   
                </div>
                <div class="card-body"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Medication Name</th>
                <th>Quantity Dispensed</th>
                <th>Total Amount</th>
                <th>Dispensed Date</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dispensed_medications as $medication): 
                // Fetch patient name based on patient_id
                $pres = $Fcall->Targeted_info('prescriptions', 'prescription_id', $medication['prescription_id']);
                $patient = $Fcall->Targeted_info('patients', 'patient_id', $pres['patient_id']);
                
                // Fetch medication name based on medication_id
                $med = $Fcall->Targeted_info('medications', 'medication_id', $pres['medication_id']);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['first_name']); ?></td>
                <td><?php echo htmlspecialchars($med['name']); ?></td>
                <td><?php echo htmlspecialchars($medication['quantity']); ?></td>
                <td><?php echo htmlspecialchars($medication['total_amount']); ?></td>
                <td><?php echo htmlspecialchars($medication['dispensed_at']); ?></td>
                <!-- <td>
                    <a href="view_dispensed.php?id=<?php //echo $medication['dispensed_id']; ?>" class="btn btn-info btn-sm">View</a>
                </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
