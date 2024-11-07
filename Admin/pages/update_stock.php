<?php
// Assuming this is part of update_stock.php
if (isset($_GET['id'])) {
    $medication_id = $_GET['id'];
    $medication = $Fcall->getMedicationStock($medication_id); // Fetch medication details
}

// Handle the form submission and update the medication stock
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medication_id = $_POST['medication_id'];
    $quantity = $_POST['quantity'];
    $batch_number = $_POST['batch_number'];
    $expiration_date = $_POST['expiration_date'];

    // Call the function to update the medication details in the database
    $updateSuccess = $Fcall->updateMedicationStock($medication_id, $quantity, $batch_number, $expiration_date);

    if ($updateSuccess) {
    
            echo '<script>
            swal("Success", "Stock updated successfully!.", "success")
            .then((value) => {
                window.location.href = "?a=manage_inventory";
            });
        </script>';
        } else {
            //echo "Error updating patient record.";
            echo '<script>swal("Warning","Failed to update stock. Please try again.","warning")</script>';
        }
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Update Medication Stock</h5>
                </div>
                <div class="card-body"></div>


                    <form action="?a=update_stock" method="POST">
                        <input type="hidden" name="medication_id" value="<?php echo $medication['medication_id']; ?>" />
                        
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Update Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo htmlspecialchars($medication['stock_quantity']); ?>" min="1" required />
                        </div>

                        <div class="mb-3">
                            <label for="batch_number" class="form-label">Batch Number</label>
                            <input type="text" name="batch_number" id="batch_number" class="form-control" value="<?php echo htmlspecialchars($medication['batch_number']); ?>" required />
                        </div>

                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date</label>
                            <input type="date" name="expiration_date" id="expiration_date" class="form-control" value="<?php echo htmlspecialchars($medication['expiration_date']); ?>" required />
                        </div>

                        <button type="submit" class="btn btn-success">Update Stock</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
