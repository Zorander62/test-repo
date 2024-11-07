
<?php
// Fetch billing information
//$billing_info = $db->getBillingInfoByUserId($_SESSION['user_id']); // Assuming you have this method
$data = $Fcall->Targeted_info('patients', 'email', $_SESSION['email']);
$patient_id = $data['patient_id'];
$bills = $Fcall->getUnpaidBills( $patient_id);
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
              
              <?php if ($bills->num_rows > 0): ?>
            <div class="bill-list">
                <?php while ($bill = $bills->fetch_assoc()): 
                  $due = $bill['total_amount'] - $bill['paid_amount']; 
                  ?>
                    <div class="bill-item">
                        <p><strong>Bill ID:</strong> <?php echo $bill['billing_id']; ?></p>
                        <p><strong>Amount:</strong> $<?php echo number_format($bill['total_amount'], 2); ?></p>
                        <p><strong>Paid Amount :</strong> $<?php echo number_format($bill['total_amount'], 2); ?></p>
                        <p><strong>Amount Due:</strong> $<?php echo number_format($due, 2); ?></p>
                        <p><strong>Due Date:</strong> <?php echo date("F j, Y", strtotime($bill['created_at'])); ?></p>
                        <p><strong>Status:</strong> <?php echo $bill['status']; ?></p>
                        <!-- <a href="payment_gateway.php?bill_id=<?php // $bill['id']; ?>" class="btn btn-primary">Pay Now</a> -->
                    </div>
                    <hr>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No unpaid bills found.</p>
        <?php endif; ?>
            </div>



  </div>
  </div>
  </div>
  </div>



