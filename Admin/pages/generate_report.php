<?php
// Assuming $Fcall is your main class instance
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect filter data (e.g., date range and test type)
    $startDate = $_POST['start_date'] ?? null;
    $endDate = $_POST['end_date'] ?? null;
    $testType = $_POST['test_type'] ?? null;

    // Get the report data
    $reportData = $Fcall->getReportData($startDate, $endDate, $testType);
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Test Results Report</p>
                        
                    </div>
                </div>
                <div class="card-body p-4"></div>


    <!-- Filter form to get the report data -->
    <form method="POST">
        <div class="row">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="col-md-4">
                <label for="test_type" class="form-label">Test Type</label>
                <input type="text" class="form-control" id="test_type" name="test_type" placeholder="Optional">
            </div>
            <div class="col-md-2">
            <button type="submit" class="btn btn-primary mt-4 w-100">Generate Report</button>
        </div>
        </div>
       
    </form>

    <!-- Display the report data -->
    <?php if (isset($reportData)): ?>
        <?php if ($reportData): ?>
            <h3>Report Data</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th>Sample Type</th>
                        <th>Result</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportData as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['test_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['sample_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['result']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No data found for the selected filters.</div>
        <?php endif; ?>
    <?php endif; ?>
</di>
