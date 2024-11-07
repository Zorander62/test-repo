<?php

// Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $appointment_date = $_POST['appointment_date'];
//     $special_request = $_POST['special_request'];

//     // Insert appointment into the database
//     $patient_id = $_SESSION['patient_id']; // Assuming you have the patient ID stored in the session
//     $db->insertAppointment($patient_id, $appointment_date, $special_request);
//     echo '<script>alert("Appointment created successfully!");</script>';
// }
$bills = $Fcall->getAllBills();
?>

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Billing Management</p>
                <a href="?a=new_billing" class="btn btn-primary btn-sm ms-auto">New Billing</a>
              </div>
            </div>

            <div class="card-body p-4 ">

          
          
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
                $user =  $Fcall->Targeted_info('patients','patient_id ',$bill['patient_id']);
              ?>
                    <tr>
                        <td><?php echo $bill['billing_id']; ?></td>
                        <td><?php echo @htmlspecialchars($user['first_name']." ".$user['last_name']); ?></td>
                        <td><?php echo $bill['total_amount']; ?></td>
                        <td><?php echo $bill['paid_amount']; ?></td>
                        <td><?php echo $bill['status']; ?></td>
                        <td>
                            <a class="btn btn-success" href="?a=view_bill&id=<?php echo $bill['billing_id']; ?>">View</a> |
                            <a class="btn btn-primary" href="?a=manage_payment&bill_id=<?php echo $bill['billing_id']; ?>">Manage Payment</a>
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



