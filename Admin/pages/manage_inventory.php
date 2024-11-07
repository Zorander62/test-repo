<?php
$medications = $Fcall->getAllMedications(); // Get all medications from the database
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Medication Inventory</h5>
                    <a href="?a=add_medication" class="btn btn-primary btn-sm ms-auto">Add New Medication</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Stock Quantity</th>
                                    <th>Price</th>
                                    <th>Batch Number</th>
                                    <th>Expiration Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $NO = 1;
                                foreach ($medications as $medication): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($NO++); ?></td>
                                        <td><?php echo htmlspecialchars($medication['name']); ?></td>
                                        <td><?php echo htmlspecialchars($medication['description']); ?></td>
                                        <td><?php echo htmlspecialchars($medication['stock_quantity']); ?></td>
                                        <td><?php echo htmlspecialchars($medication['price']); ?></td>
                                        <td><?php echo htmlspecialchars($medication['batch_number']); ?></td>
                                        <td><?php echo htmlspecialchars($medication['expiration_date']); ?></td>
                                        <td>
                                            <!-- Action buttons for updating stock -->
                                            
                                            <a href="?a=update_stock&id=<?php echo $medication['medication_id']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Update Stock
                                            </a>
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
