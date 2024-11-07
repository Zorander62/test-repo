<?php
// Fetch all sales records
$sales = $Fcall->getAllSales(); // Get all sales from the database
?>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Sales History</h5>
                   
                </div>
                <div class="card-body"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
                <td><?php echo htmlspecialchars($sale['patient_name']); ?></td>
                <td><?php echo htmlspecialchars($sale['sale_date']); ?></td>
                <td><?php echo htmlspecialchars($sale['total_amount']); ?></td>
                <td>
                    <a href="view_sale.php?id=<?php echo $sale['sale_id']; ?>" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
