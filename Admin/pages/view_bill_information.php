<?php

$user =  $Fcall->Targeted_info('users','user_id',$_SESSION['user_id']);
$doctors =  $Fcall->Targeted_info('doctors','email',$user['email']);
// Fetch doctor ID from the session
$doctor_id = $doctors['doctor_id']; // Assuming the doctor's ID is stored in the session
// Fetch the billings based on the doctor's services
// Assuming the function `getBillsByDoctor` fetches all billings related to services handled by a doctor
$bills = $Fcall->getBillsByDoctor($doctor_id); // Modify this function accordingly
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Billing Management</p>
          </div>
        </div>

        <div class="card-body p-4">
          <div class="table-responsive p-5">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Bill ID</th>
                  <th>Patient</th>
                  <th>Total Amount</th>
                  <th>Paid Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($bills as $bill): 
                  $user = $Fcall->Targeted_info('patients', 'patient_id', $bill['patient_id']);
                ?>
                  <tr>
                    <td><?php echo $bill['billing_id']; ?></td>
                    <td><?php echo htmlspecialchars($user['first_name']." ".$user['last_name']); ?></td>
                    <td><?php echo $bill['total_amount']; ?></td>
                    <td><?php echo $bill['paid_amount']; ?></td>
                    <td><?php echo $bill['status']; ?></td>
                    <td>
                      <a class="btn btn-success" href="?a=view_bill&id=<?php echo $bill['billing_id']; ?>">View</a>
                      <!-- Remove or restrict "Manage Payment" link for doctors -->
                      <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'billing_staff'): ?>
                        | <a class="btn btn-primary" href="?a=manage_payment&bill_id=<?php echo $bill['billing_id']; ?>">Manage Payment</a>
                      <?php endif; ?>
                    </td>
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
