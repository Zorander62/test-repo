<?php
// Check if admin is logged in
$patient_id = $_GET['id'] ?? null;
// Fetch patients and services
$patients = $Fcall->getPatients();
$services = $Fcall->getServices();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'];
    $total_amount = $_POST['total_amount'];
    $paid_amount = $_POST['paid_amount'];
    $status = ($total_amount == $paid_amount) ? 'paid' : 'pending';

    // Insert the bill into the database
    $bill_id = $Fcall->createBill($patient_id, $total_amount, $paid_amount, $status);

    if ($bill_id) {
        // Insert each service with bill ID
        if (isset($_POST['service_ids'])) {
            foreach ($_POST['service_ids'] as $service_id) {
                $service_name = $_POST['service_name'][$service_id];
                $price = $_POST['price'][$service_id];
                
                $Fcall->addServiceToBill($bill_id, $service_id, $service_name, $price);
            }
        }

        echo '<script>
            swal("Success", "Billing Created successfully.", "success")
            .then((value) => {
                window.location.href = "?a=billing"; 
            });
        </script>';
    } else {
        echo '<script>swal("Warning", "Error creating billing.", "warning")</script>';
    }
}
?>



<!-- HTML form for managing patient information -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Bill</p>
                        <a class="btn btn-primary btn-sm ms-auto" onclick="history.back()">Back</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="post">
                    <div class="form-group">
                            <label for="patient_id">Select Patient:</label>
                            <?php if (!empty($patient_id)): ?>
                                <!-- Prefilled input for patient_id -->
                                <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patient_id); ?>">
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($Fcall->getPatientNameById($patient_id)); ?>" readonly>
                            <?php else: ?>
                                <!-- Dropdown for selecting a patient -->
                                <select name="patient_id" class="form-control" required>
                                    <option value="">Select a Patient</option>
                                    <?php foreach ($patients as $patient): ?>
                                        <option value="<?php echo $patient['patient_id']; ?>">
                                            <?php echo htmlspecialchars($patient['first_name'] . " " . $patient['last_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="service_ids">Select Services:</label>
                            <div class="service-options">
                                <?php foreach ($services as $service): ?>
                                    <div class="form-check">
                                        <input type="checkbox" 
                                               name="service_ids[]" 
                                               class="form-check-input" 
                                               value="<?php echo $service['ServiceID']; ?>"
                                               data-service-name="<?php echo htmlspecialchars($service['ServiceName']); ?>"
                                               data-price="<?php echo $service['Price']; ?>">
                                        <label class="form-check-label">
                                            <?php echo htmlspecialchars($service['ServiceName']) . " - " . $service['Price']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="total_amount">Total Amount:</label>
                            <input type="number" class="form-control" name="total_amount" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="paid_amount">Amount Paid:</label>
                            <input type="number" class="form-control" name="paid_amount" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create Bill</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to populate hidden inputs for selected service details
    document.querySelectorAll('input[name="service_ids[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Clear previous hidden inputs for unselected checkboxes
            document.querySelectorAll('.service-hidden-fields').forEach(el => el.remove());
            
            // Loop through checked services to create hidden fields
            document.querySelectorAll('input[name="service_ids[]"]:checked').forEach(function(selected) {
                const serviceID = selected.value;
                const serviceName = selected.getAttribute('data-service-name');
                const servicePrice = selected.getAttribute('data-price');

                // Hidden inputs for each selected service
                const nameInput = document.createElement('input');
                nameInput.type = 'hidden';
                nameInput.name = `service_name[${serviceID}]`;
                nameInput.value = serviceName;
                nameInput.classList.add('service-hidden-fields');

                const priceInput = document.createElement('input');
                priceInput.type = 'hidden';
                priceInput.name = `price[${serviceID}]`;
                priceInput.value = servicePrice;
                priceInput.classList.add('service-hidden-fields');

                // Append hidden inputs to the form
                checkbox.closest('form').appendChild(nameInput);
                checkbox.closest('form').appendChild(priceInput);
            });
        });
    });
</script>