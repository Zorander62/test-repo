<?php
// Call the function to get medications with low stock
$low_stock_medications = $Fcall->checkLowStock(); 
?>

<!-- Start of Low Stock Alerts Section -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                    <h5>Low Stock</h5>
                    
                </div>

                <div class="card-body p-4">


    <?php if (!empty($low_stock_medications)): ?>
        <?php foreach ($low_stock_medications as $medication): ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <span class="me-2">
                    <i class="bi bi-exclamation-triangle-fill"></i> <!-- Icon for warning -->
                </span>
                <div>
                    <strong>Warning!</strong> Stock of 
                    <span class="text-primary"><?php echo htmlspecialchars($medication['name']); ?></span> 
                    is low.
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            <i class="bi bi-info-circle-fill"></i>
            All medications are sufficiently stocked.
        </div>
    <?php endif; ?>
</div>
<!-- End of Low Stock Alerts Section -->
