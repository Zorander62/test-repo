<?php


//$patient_id = $_GET['id']; // Get patient ID from URL
//$billing_info = $db->getBillingInfoByPatientId($patient_id); // Assuming this function exists
?>



<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Prescriptions</p>
                
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
              <div class="table-responsive p-5">
              
              <table class="table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($billing_info as $bill): ?>
                    <tr>
                        <td><?php //echo $bill['service']; ?></td>
                        <td>$<?php //echo $bill['amount']; ?></td>
                        <td><?php //echo ucfirst($bill['status']); ?></td>
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


t
