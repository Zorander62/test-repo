<?php
// Include necessary files and initialize the database connection
// (Assuming $Fcall is already initialized and has access to necessary methods)

// Fetch prescription details by ID
if (isset($_GET['id'])) {
    $prescription_id = $_GET['id'];
    $prescription = $Fcall->getPrescriptionById($prescription_id);
}

$pres = $Fcall->Targeted_info('prescriptions', 'prescription_id ', $prescription_id);
    $med = $Fcall->Targeted_info('medications', 'medication_id', $pres['medication_id']);

// Handle dispense action
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $total_amount = $_POST['total_amount'];
    $run = $Fcall->dispenseMedication($prescription_id, $quantity, $total_amount);

    if ($run) {
        echo '<script>
        swal("Success", "Medication dispensed successfully.", "success")
        .then((value) => {
            window.location.href = "?a=despense";
        });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error Dispensing prescription.", "warning")</script>';
    }
    // echo "<div class='alert alert-success'>Medication dispensed successfully.</div>";
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header pb-0">
                   
                    <p class="mb-0">Dispense Medication</p>
                </div>

                <div class="card-body p-4"></div>

<!-- <div class="container mt-5">
    <h2 class="mb-4">Dispense Medication</h2> -->
    <form action="?a=dispense_medication&id=<?php echo htmlspecialchars($prescription_id); ?>" method="POST">
        <!-- Display Medication Details from Prescription -->
        <div class="mb-3">
            <label for="medication_name" class="form-label">Medication:</label>
            <input type="text" class="form-control" id="medication_name" name="medication_name" 
                   value="<?php echo htmlspecialchars($med['name']); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="medication_name" class="form-label">Medication ID:</label>
            <input type="text" class="form-control" id="medication_id" name="medication_id" 
                   value="<?php echo htmlspecialchars($prescription['medication_id']); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="Enter quantity" required>
        </div>

        <!-- Display Total Amount (calculated based on quantity) -->
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount:</label>
            <input type="number" class="form-control" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($med['price']); ?>" required readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Complete Sale</button>
    </form>
</div>

<script>
// JavaScript to calculate total amount based on quantity and unit price
document.getElementById('quantity').addEventListener('input', function () {
    const quantity = parseInt(this.value) || 0;
    const pricePerUnit = <?php echo json_encode($prescription['price']); ?>;
    document.getElementById('total_amount').value = (pricePerUnit * quantity).toFixed(2);
});
</script>
