

      <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Upcoming Appointments</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($upcoming_appointments as $appointment): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $appointment['date']; ?></strong> with Dr. <?php //echo $appointment['doctor_name']; ?>
                                <span class="badge bg-primary float-end">View</span>
                            </li>
                        <?php //endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Medical History</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($recent_medical_history as $record): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $record['date']; ?></strong>: <?php //echo $record['description']; ?>
                            </li>
                        <?php //endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Billing Information</h5>
                </div>
                <div class="card-body">
                    <p>Total Balance: <strong>$<?php //echo $billing_info['total_balance']; ?></strong></p>
                    <p>Last Payment: <strong>$<?php //echo $billing_info['last_payment']; ?></strong></p>
                    <a href="billing.php" class="btn btn-primary">View Billing Details</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Test Results</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($test_results as $result): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $result['test_name']; ?></strong>: <?php //echo $result['result']; ?>
                                <span class="badge bg-success float-end">View</span>
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
                    <h5>Health Resources</h5>
                </div>
                <div class="card-body">
                    <p>Explore our health resources:</p>
                    <ul>
                        <li><a href="#">Nutrition Tips</a></li>
                        <li><a href="#">Exercise Guidelines</a></li>
                        <li><a href="#">Mental Health Resources</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Profile Information</h5>
                </div>
                <div class="card-body">
                    <p>Name: <?php //echo $patient['first_name'] . ' ' . $patient['last_name']; ?></p>
                    <p>Email: <?php //echo $patient['email']; ?></p>
                    <p>Phone: <?php //echo $patient['phone']; ?></p>
                    <a href="edit_profile.php" class="btn btn-secondary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

      </div>