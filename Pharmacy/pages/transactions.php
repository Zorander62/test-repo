<?php


//$transactions = $db->getAllTransactions(); // Assuming this function exists
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
                    <th>Patient Name</th>
                    <th>Medication</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo $transaction['patient_name']; ?></td>
                        <td><?php echo $transaction['medication_name']; ?></td>
                        <td>$<?php echo $transaction['total_amount']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($transaction['transaction_date'])); ?></td>
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
