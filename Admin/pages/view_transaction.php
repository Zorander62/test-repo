<?php
// Fetch the sale details based on the sale_id
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];
    $sale = $Fcall->getSaleById($sale_id); // Fetch the sale details by ID
    $sale_items = $Fcall->getSaleItems($sale_id); // Fetch the medications/items related to the sale
}
?>



<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">View Sale Details</h5>
                   
                </div>
                <div class="card-body"></div>

    <div class="row">
        <div class="col-md-6">
            <h4>Sale Information</h4>
            <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($sale['patient_name']); ?></p>
            <p><strong>Sale Date:</strong> <?php echo htmlspecialchars($sale['sale_date']); ?></p>
            <p><strong>Total Amount:</strong> <?php echo htmlspecialchars($sale['total_amount']); ?></p>
        </div>
    </div>

    <h4>Medications Dispensed</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Medication Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sale_items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['medication_name']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td><?php echo htmlspecialchars($item['price']); ?></td>
                <td><?php echo htmlspecialchars($item['total']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="sales_history.php" class="btn btn-primary">Back to Sales History</a>
</div>
