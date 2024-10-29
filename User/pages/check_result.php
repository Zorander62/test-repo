

<?php



// Fetch results for the user
//$results = $Fcall->getResultsByUserId($_SESSION['user_id']); // Assuming you have this method

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
              
                <table class="table align-items-center mb-0"></tr></div>

      
            <thead>
                <tr>
                    <th>Test</th>
                    <th>Date</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($results as $result): ?>
                    <tr>
                        <td>Test Name<?php // $result['test_name']; ?></td>
                        <td>2024-09-31<?php //echo $result['test_date']; ?></td>
                        <td>Negative<?php //echo $result['result']; ?></td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
            </div>



  </div>
  </div>
  </div>
  </div>

  </div>


