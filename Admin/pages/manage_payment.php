<?php
// Fetch bill details based on bill_id
$bill_id = $_GET['bill_id'] ?? null;
$bill = $Fcall->getBillDetails($bill_id); // Fetches bill details for the given bill_id

// Check if bill data exists and handle missing data
if ($bill) {
    $patient_id = htmlspecialchars($bill['patient_id']); // Adjust this as per your requirement
    $user = $Fcall->Targeted_info('patients', 'patient_id', $patient_id);
    $services = isset($bill['services']) && is_array($bill['services']) ? $bill['services'] : [];
    $total_amount = htmlspecialchars($bill['total_amount']);
    $paid_amount = isset($bill['paid_amount']) ? htmlspecialchars($bill['paid_amount']) : '0.00';
    $status = isset($bill['status']) ? htmlspecialchars($bill['status']) : 'pending';
} else {
    // Handle case where the bill is not found
    echo "Bill not found!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paid_amount'])) {
    $paid_amount = (float)$_POST['paid_amount'];
    $total_amount = (float)$_POST['total_amount'];
    
    // Determine status based on comparison
    $status = ($paid_amount >= $total_amount) ? 'paid' : 'pending';

    // Update the payment in the database
    $updateSuccess = $Fcall->updatePayment($bill_id, $paid_amount);

    if ($updateSuccess) {
        echo '<script>
            swal("Success", "Payment Updated successfully.", "success")
            .then(() => {
                window.location.href = "?a=billing"; 
            });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error updating payment.", "warning")</script>';
    }
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="mb-0">Manage Payment for Bill ID: <?php echo htmlspecialchars($bill_id); ?></p>
                    <a class="btn btn-primary btn-sm ms-auto" onclick="history.back()">Back</a>
                </div>

                <div class="card-body p-4">
                    <form method="post">
                        <div class="form-group">
                            <label for="patient_name">Patient Name:</label>
                            <input type="text" class="form-control" name="patient_name" value="<?php echo htmlspecialchars($user['first_name']." ".$user['last_name']); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Services:</label>
                            <ul>
                                <?php if (!empty($services)): ?>
                                    <?php foreach ($services as $service): ?>
                                        <li><?php echo htmlspecialchars($service['ServiceName']) . " - " . htmlspecialchars(number_format($service['price'], 2)); ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>No services found for this bill.</li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="total_amount">Total Amount:</label>
                            <input type="number" class="form-control" name="total_amount" value="<?php echo htmlspecialchars($total_amount); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="paid_amount">Amount Paid:</label>
                            <input type="number" class="form-control" name="paid_amount" value="<?php echo htmlspecialchars($paid_amount); ?>" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <input type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($status); ?>" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
