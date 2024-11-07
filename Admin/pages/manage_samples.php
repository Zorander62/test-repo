<?php
// Fetch all samples
$samples = $Fcall->getAllSamples(); // Method to fetch all samples
$tests = $Fcall->getAllTests();


// Handle sample collection (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $test_id = $_POST['test_id'];
    $sample_type = $_POST['sample_type'];

    // Add the new sample to the database
  $updateSuccess = $Fcall->addSample($patient_id, $test_id, $sample_type);

    if ($updateSuccess) {
        echo '<script>
            swal("Success", "Sample Added successfully.", "success")
            .then(() => {
                window.location.href = "?a=manage_samples"; 
            });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error Adding Sample.", "warning")</script>';
    }
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Manage Samples</h5>
                    
                </div>
                <div class="card-body"></div>



    <!-- Form to collect a new sample -->
    <form method="POST">
    <div class="mb-3">
        <label for="patient_id" class="form-label">Select Patient</label>
        <select class="form-control" id="patient_id" name="patient_id" required>
            <option value="">Select a Patient</option>
            <?php
            // Fetch list of patients
            $patients = $Fcall->getAllPatients(); // Get list of patients from database
            foreach ($patients as $patient):
             

            ?>
            <option value="<?php echo $patient['patient_id']; ?>"><?php echo htmlspecialchars($patient['first_name']." ".$patient['last_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="test_id" class="form-label">Test</label>
        <select class="form-control" id="test_id" name="test_id" required>
            <option value="">Select a Test</option>
            <?php foreach ($tests as $test): ?>
            <option value="<?php echo $test['test_id']; ?>"><?php echo htmlspecialchars($test['test_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="sample_type" class="form-label">Sample Type</label>
        <input type="text" class="form-control" id="sample_type" name="sample_type" required>
    </div>
    <button type="submit" class="btn btn-primary">Collect Sample</button>
</form>

    <!-- Table of existing samples -->
    <h6>Existing Samples</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Test</th>
                <th>Sample Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($samples as $sample): 
                   $data =  $Fcall->Targeted_info('tests','test_id',$sample['test_id']);
                   $patient =  $Fcall->Targeted_info('patients','patient_id',$sample['patient_id']);
                   
                ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['first_name']." ".$patient['last_name']); ?></td>
                <td><?php echo htmlspecialchars($data['test_name']); ?></td>
                <td><?php echo htmlspecialchars($sample['sample_type']); ?></td>
                <td>
                    <a href="view_sample.php?id=<?php echo $sample['sample_id']; ?>">View</a> |
                    <a href="delete_sample.php?id=<?php echo $sample['sample_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
