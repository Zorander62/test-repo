
<?php
// Fetch billing information
//$billing_info = $db->getBillingInfoByUserId($_SESSION['user_id']); // Assuming you have this method

?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Billing Information</p>
                <!-- <button class="btn btn-primary btn-sm ms-auto">Billing</button> -->
              </div>
            </div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-5">
              
                <table class="table align-items-center mb-0"><

      
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
                        <td>Test Name<?php // $result['service']; ?></td>
                        <td>1000<?php //echo $result['amount']; ?></td>
                        <td>Pending<?php //echo $result['status']; ?></td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
            </div>



  </div>
  </div>
  </div>
  </div>



