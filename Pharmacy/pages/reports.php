<?php


//$reports = $db->getReports(); // Assuming this function exists
?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Inventory</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
              <table class="table">
            <thead>
                <tr>
                    <th>Report Type</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['type']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($report['date'])); ?></td>
                        <td><?php echo $report['details']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

   

</div>

  </div>
  </div>
  </div>
  </div>


t
