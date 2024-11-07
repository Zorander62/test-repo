<?php
// Get data
$todays_appointments = $Fcall->getTodaysAppointments();
$recent_medical_records = $Fcall->getRecentMedicalRecords();
?>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>Today's Appointments</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($todays_appointments as $appointment): ?>
                        <li class="list-group-item">
                            <i class="ni ni-single-02 text-primary me-2"></i>
                            <strong><?php 
                                 $data =  $Fcall->Targeted_info('patients','patient_id',$appointment['patient_id']);
                            echo htmlspecialchars($data['first_name']." ".$data['last_name']); ?></strong> 
                            at <?php echo htmlspecialchars($appointment['time']); ?>
                            <span class="badge bg-<?php echo $appointment['status'] == 'Confirmed' ? 'success' : 'warning'; ?> float-end">
                                <?php echo htmlspecialchars($appointment['status']); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>Recent Medical Records</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($recent_medical_records as $record): ?>
                        <li class="list-group-item">
                            <i class="ni ni-folder-17 text-info me-2"></i>
                            <strong><?php echo htmlspecialchars($record['patient_name']); ?></strong>: 
                            <?php echo htmlspecialchars($record['description']); ?>
                            <span class="badge bg-info float-end"><?php echo htmlspecialchars($record['date']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Notifications</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">New message from patient: John Doe</li>
                        <li class="list-group-item">Appointment reminder for Jane Smith at 3 PM</li>
                        <li class="list-group-item">Patient Mark Johnson has updated their medical history</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <!-- <a class="btn btn-primary" href="?a=appointments">Add New Patient</a> -->
                    <button class="btn btn-secondary" href="?a=appointments">Schedule Appointment</button>
                    <button class="btn btn-success" href="?a=manage_prescription">Write Prescription</button>
                </div>
            </div>
        </div>
    </div>
</div>
      