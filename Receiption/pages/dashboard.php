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
                    <h5>Patient Check-Ins</h5>
                </div>
                <div class="card-body">
                    <form action="check_in.php" method="post">
                        <div class="form-group">
                            <label for="patient_id">Select Patient:</label>
                            <select class="form-control" name="patient_id" required>
                                <option value="">Choose...</option>
                                <?php //foreach ($patients as $patient): ?>
                                    <option value="<?php //echo $patient['patient_id']; ?>"><?php //echo $patient['first_name'] . ' ' . $patient['last_name']; ?></option>
                                <?php //endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Check In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Billing Overview</h5>
                </div>
                <div class="card-body">
                    <p>Outstanding Balances: <strong>$<?php //echo $outstanding_balances; ?></strong></p>
                    <p>Recent Payments: <strong><?php //echo $recent_payments; ?></strong></p>
                    <a href="billing.php" class="btn btn-primary">Manage Billing</a>
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
                        <li class="list-group-item">New message from Dr. Smith</li>
                        <li class="list-group-item">Appointment reminder for Jane Doe at 3 PM</li>
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
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="add_patient.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPatientModalLabel">Add New Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Patient</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>