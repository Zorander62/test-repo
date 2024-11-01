<div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Pending Tests</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($pending_tests as $test): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $test['patient_name']; ?></strong>: <?php //echo $test['test_type']; ?>
                                <span class="badge bg-warning float-end"><?php //echo $test['status']; ?></span>
                            </li>
                        <?php //endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Results</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php //foreach ($recent_results as $result): ?>
                            <li class="list-group-item">
                                <strong><?php //echo $result['patient_name']; ?></strong>: <?php //echo $result['test_type']; ?> - <?php //echo $result['result']; ?>
                                <span class="badge bg-success float-end">Completed</span>
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
                    <h5>Sample Management</h5>
                </div>
                <div class="card-body">
                    <p>Total Samples Received: <strong><?php // $total_samples; ?></strong></p>
                    <a href="samples.php" class="btn btn-primary">Manage Samples</a>
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
                        <li class="list-group-item">New test request from Dr. Smith</li>
                        <li class="list-group-item">Sample received for patient: Jane Doe</li>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addTestModal">Add New Test</button>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#manageSamplesModal">Manage Samples</button>
                </div>
            </div>
        </div>
    </div>