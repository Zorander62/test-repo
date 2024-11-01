<div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Inventory Overview</h5>
                </div>
                <div class="card-body">
                    <p>Total Medications: 45<strong><?php //echo $total_medications; ?></strong></p>
                    <p>Low Stock Alerts: 34<strong><?php //echo $low_stock_count; ?></strong></p>
                    <a href="inventory.php" class="btn btn-primary">View Inventory</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Pending Prescriptions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($pending_prescriptions as $prescription): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $prescription['patient_name']; ?></strong>: <?php //echo $prescription['medication_name']; ?>
                                <span class="badge bg-warning float-end">Pending</span>
                            </li>
                        <?php //endforeach; ?>
                    </ul>
                    <a href="prescriptions.php" class="btn btn-primary">Manage Prescriptions</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Transactions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($recent_transactions as $transaction): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $transaction['patient_name']; ?></strong>: $<?php //echo $transaction['total_amount']; ?>
                                <span class="badge bg-success float-end">Completed</span>
                            </li>
                        <?php //endforeach; ?>
                    </ul>
                    <a href="transactions.php" class="btn btn-primary">View Transactions</a>
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
                        <li class="list-group-item">Low stock alert for medication: Aspirin</li>
                        <li class="list-group-item">New prescription received for patient: John Doe</li>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addMedicationModal">Add New Medication</button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#managePrescriptionsModal">Manage Prescriptions</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addMedicationModal" tabindex="-1" role="dialog" aria-labelledby="addMedicationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="add_medication.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMedicationModalLabel">Add New Medication</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="medication_name">Medication Name:</label>
                            <input type="text" class="form-control" name="medication_name" required>
                        </div>
                        <div class="form-group">
                            <label for="dosage">Dosage:</label>
                            <input type="text" class="form-control" name="dosage" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Medication</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>