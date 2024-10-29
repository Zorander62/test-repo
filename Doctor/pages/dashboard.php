<div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Today's Appointments</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($todays_appointments as $appointment): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $appointment['patient_name']; ?></strong> at <?php //echo $appointment['time']; ?>
                                <span class="badge bg-success float-end"><?php //echo $appointment['status']; ?></span>
                            </li>
                        <?php //endforeach; ?>
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
                        <?php //foreach ($recent_medical_records as $record): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $record['patient_name']; ?></strong>: <?php //echo $record['description']; ?>
                                <span class="badge bg-info float-end"><?php //echo $record['date']; ?></span>
                            </li>
                        <?php //endforeach; ?>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addPatientModal">Add New Patient</button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#scheduleAppointmentModal">Schedule Appointment</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#writePrescriptionModal">Write Prescription</button>
                </div>
            </div>
        </div>
    </div>
</div>
      