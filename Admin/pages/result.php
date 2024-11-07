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
                        <p class="mb-0">Results</p>
                        
                    </div>
                </div>
                <div class="card-body p-4"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sample ID</th>
                <th>Test Name</th>
                <th>Sample Type</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through all samples and display them
            if ($samples) {
                foreach ($samples as $sample) {
                    $data =  $Fcall->Targeted_info('tests','test_id',$sample['test_id']);
                    $patient =  $Fcall->Targeted_info('patients','patient_id',$sample['patient_id']);
                    
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars( $patient['first_name']." ".$patient['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['test_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($sample['sample_type']) . "</td>";
                   
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No samples found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- echo "<td><a href='?a=view_results&id=" . htmlspecialchars($sample['sample_id']) . "' class='btn btn-primary'>View/Update Results</a></td>"; -->