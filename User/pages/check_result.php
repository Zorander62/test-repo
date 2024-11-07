

<?php



// Fetch results for the user
//$results = $Fcall->getResultsByUserId($_SESSION['user_id']); // Assuming you have this method
$data = $Fcall->Targeted_info('patients', 'email', $_SESSION['email']);
$patient_id = $data['patient_id'];
$bills = $Fcall->getTestResults( $patient_id);
?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Check Result</p>
                <button class="btn btn-primary btn-sm ms-auto">Check Result</button>
              </div>
            </div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-5">
              <?php if (@$results->num_rows > 0): ?>
            <div class="results-list">
                <?php while ($result = $results->fetch_assoc()): ?>
                    <div class="result-item">
                        <p><strong>Test Type:</strong> <?php echo $result['test_type']; ?></p>
                        <p><strong>Date:</strong> <?php echo date("F j, Y", strtotime($result['date'])); ?></p>
                        <p><strong>Status:</strong> <?php echo $result['status']; ?></p>
                        <?php if ($result['status'] == 'Completed'): ?>
                            <a href="download_report.php?id=<?php echo $result['id']; ?>" class="btn btn-success">Download Report</a>
                        <?php endif; ?>
                    </div>
                    <hr>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No test results available.</p>
        <?php endif; ?>
            </div>



  </div>
  </div>
  </div>
  </div>

  </div>


