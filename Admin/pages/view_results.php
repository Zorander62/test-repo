<?php
// Get the test results based on the sample or test_id
$sample_id = $_GET['id'];
$sample = $Fcall->Targeted_info('samples', 'sample_id', $sample_id); // Get the sample details
$results = $Fcall->getResultsForSample($sample_id); // Fetch results for the sample

// Handle result submission (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $_POST['result'];
    
    // Update the test result in the database
    $Fcall->updateResult($sample_id, $result);
}
?>

<div class="container">
    <h2>Test Results</h2>
    <h4>Sample: <?php echo htmlspecialchars($sample['sample_type']); ?></h4>

    <!-- Form to submit a new result -->
    <!-- <form method="POST">
        <div class="mb-3">
            <label for="result" class="form-label">Test Result</label>
            <textarea class="form-control" id="result" name="result" required><?php echo htmlspecialchars($results['result']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Result</button>
    </form> -->

    <!-- Table of results -->
    <h3>Test Results</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Result</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($sample['test_name']); ?></td>
                <td><?php echo htmlspecialchars($results['result']); ?></td>
                <td><?php echo htmlspecialchars($results['created_at']); ?></td>
            </tr>
        </tbody>
    </table>
</div>
