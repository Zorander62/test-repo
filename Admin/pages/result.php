<?php
// Assuming $Fcall is your function class
$samples = $Fcall->getAllSamples(); // Get all samples from the database
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0">Results</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sample ID</th>
                                <th>Test Name</th>
                                <th>Sample Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through all samples and display them
                            if (!empty($samples) && is_array($samples)) {
                                foreach ($samples as $sample) {
                                    // Fetch related data
                                    $data = $Fcall->Targeted_info('tests', 'test_id', $sample['test_id']);
                                    $patient = $Fcall->Targeted_info('patients', 'patient_id', $sample['patient_id']);

                                    // Check for valid data before accessing keys
                                    $testName = isset($data['test_name']) ? htmlspecialchars($data['test_name']) : 'Unknown Test';
                                    $patientName = isset($patient['first_name'], $patient['last_name']) 
                                        ? htmlspecialchars($patient['first_name'] . ' ' . $patient['last_name']) 
                                        : 'Unknown Patient';
                                    $sampleType = isset($sample['sample_type']) ? htmlspecialchars($sample['sample_type']) : 'Unknown';

                                    // Output the row
                                    echo "<tr>";
                                    echo "<td>$patientName</td>";
                                    echo "<td>$testName</td>";
                                    echo "<td>$sampleType</td>";
                                    echo "</tr>";
                                }
                            } else {
                                // No samples found
                                echo "<tr><td colspan='3' class='text-center'>No samples found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
