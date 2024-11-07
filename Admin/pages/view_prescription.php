<?php
// Fetch prescription details by ID
if (isset($_GET['id'])) {
    $prescription_id = $_GET['id'];
    $prescription = $Fcall->getPrescriptionById($prescription_id);
    $prescription_items = $Fcall->getPrescriptionItems($prescription_id);
    $prescriptions = $Fcall->getAllPrescriptionsById($prescription_id);

    $data = $Fcall->Targeted_info('patients', 'patient_id', $prescription['patient_id']);
    $doctor = $Fcall->Targeted_info('doctors', 'doctor_id', $prescription['doctor_id']);
    $prescip = $Fcall->Targeted_info('prescriptions', 'prescription_id', $prescription_id);
    $med = $Fcall->Targeted_info('medications', 'medication_id', $prescip['medication_id']);
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Prescription Details</h5>
                   
                </div>
                <div class="card-body"></div>


    <div class="row mb-4">
        <div class="col-md-4">
            <label><strong>Patient:</strong></label>
            <p><?php echo isset($data['first_name']) && isset($data['last_name']) ? htmlspecialchars($data['first_name']." ".$data['last_name']) : "N/A"; ?></p>
        </div>
        <div class="col-md-4">
            <label><strong>Doctor:</strong></label>
            <p><?php echo isset($doctor['name']) ? htmlspecialchars($doctor['name']) : "N/A"; ?></p>
        </div>
        <div class="col-md-4">
            <label><strong>Date Prescribed:</strong></label>
            <p><?php echo isset($prescription['created_at']) ? htmlspecialchars($prescription['created_at']) : "N/A"; ?></p>
        </div>
    </div>

    <h3 class="section-title">Medications</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
        <th>Medication</th>
        <th>Dosage</th>
        <th>Frequency</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
    </tr>
        </thead>
        <tbody>
           <?php foreach ($prescriptions as $prescription22): ?>
        <tr>
            <td><?php echo htmlspecialchars($med['name']); ?></td>
            <td><?php echo htmlspecialchars($prescription22['dosage']); ?></td>
            <td><?php echo htmlspecialchars($prescription22['frequency']); ?></td>
            <td><?php echo htmlspecialchars($prescription22['start_date']); ?></td>
            <td><?php echo htmlspecialchars($prescription22['end_date']); ?></td>
            <td><?php echo htmlspecialchars($prescription22['status']); ?></td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>

    <div class="actions">
        <a href="?a=prescriptions_pharmacy" class="btn btn-sm btn-primary">
            <i class="ni ni-bold-left"></i> Back to Prescriptions
        </a>
        <!-- <a href="update_prescription.php?id=<?php //echo $prescription['prescription_id']; ?>" class="btn btn-sm btn-warning">
            <i class="ni ni-settings"></i> Update Prescription
        </a>
        <a href="delete_prescription.php?id=<?php //echo $prescription['prescription_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
            <i class="ni ni-trash"></i> Delete Prescription
        </a> -->
    </div>
</div>

        </div></div>
        </div>
        