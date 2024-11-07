


<?php
$Fcall = new mainClass();

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Define the function to get sales data


// Fetch data if both start_date and end_date are provided
if ($startDate && $endDate) {
    $salesData = getSalesData($startDate, $endDate);
} else {
    $salesData = [];
}

?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Reports</p>
                <button class="btn btn-primary btn-sm ms-auto">Reports</button>
              </div>
            </div>

            <div class="card-body p-4 ">


            <form action="reports.php" method="GET">

            <div class="row">

            <div class="col-md-5">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $startDate; ?>" required>
            </div>  </div>

            <div class="col-md-5">
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $endDate; ?>" required>
            </div>
            </div>
            <div class="col-md-2">

            <button type="submit" class="btn btn-primary mt-4">Generate Report</button>
            </div>
            </div>

        </form>

        <hr>

        <!-- Display the sales data if available -->
        <?php if ($salesData): ?>
            <h3>Sales Report from <?php echo htmlspecialchars($startDate); ?> to <?php echo htmlspecialchars($endDate); ?></h3>

            <!-- Table to display sales data -->
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Amount</th>
                        <th>Sale Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salesData as $sale): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($sale['patient_name']); ?></td>
                            <td><?php echo number_format($sale['amount'], 2); ?></td>
                            <td><?php echo htmlspecialchars($sale['sale_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>No sales data available for the selected date range.</p>
        <?php endif; ?>




            
            </div>
         </div>



  </div>
  </div>
  </div>
  </div>



