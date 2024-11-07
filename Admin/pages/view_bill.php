<?php
// Retrieve billing and patient data
$billId = $_GET['id'] ?? null;
if (!$billId) {
    echo "Invalid bill ID."; 
    exit;
}

$bills = $Fcall->getAllBillslist($billId);
$service = $Fcall->Targeted_info('billing', 'billing_id', $billId);
$user = $Fcall->Targeted_info('patients', 'patient_id', $service['patient_id']);
$due = $service['total_amount'] - $service['paid_amount'];
?>



<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
              <p class="mb-0">Billing Details for Patient</p>
              <?php 
              if($_SESSION['role'] == 'admin'){

                    echo '<a href="?a=billing" class="btn btn-primary btn-sm ms-auto float-right">View Billing</a>';

              }elseif($_SESSION['role'] == 'doctor'){

                     echo '<a href="?a=view_bill_information" class="btn btn-primary btn-sm ms-auto float-right">Back</a>';

              }else{

              }
              
              ?>
              
              </div>
            </div>
              
              
                <div class="card-body">
                    <!-- Patient and Total Amount Summary -->
                    <div class="mb-4">
                        <h5>Patient Name: <?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?></h5>
                        <h5>Total Amount: ₦<?php echo number_format($service['total_amount'], 2); ?></h6>
                        <h6>Total Amount Paid: ₦<?php echo number_format($service['paid_amount'], 2); ?></h6>
                        <h6>Total Amount Due: ₦<?php echo number_format($due, 2); ?></h6>
                    </div>
                    <!-- Services Table -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Price (₦)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($bills as $bill): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($bill['service_name']); ?></td>
                                    <td>₦<?php echo number_format($bill['price'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
