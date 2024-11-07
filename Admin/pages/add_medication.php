<?php
// Assuming you have a function to handle the addition of new medication in the Fcall class

// Handle the form submission for adding new medication
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $stock_quantity = $_POST['stock_quantity'];
    $price = $_POST['price'];
    $batch_number = $_POST['batch_number'];
    $expiration_date = $_POST['expiration_date'];

    // Call the function to add new medication to the database
    $addSuccess = $Fcall->addNewMedication($name, $description, $stock_quantity, $price, $batch_number, $expiration_date);



    if ($addSuccess) {
    
        echo '<script>
        swal("Success", "Medication added successfully!", "success")
        .then((value) => {
            window.location.href = "?a=manage_inventory";
        });
    </script>';
    } else {
        //echo "Error updating patient record.";
        echo '<script>swal("Warning","Failed to add medication. Please try again.","warning")</script>';
    }
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Add New Medication</h5>
                    <a href="?a=manage_inventory" class="btn btn-primary btn-sm ms-auto">View Medication</a>
                </div>
                <div class="card-body">

                    <form action="?a=add_medication" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Medication Name</label>
                            <input type="text" name="name" id="name" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Stock Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" value="1" min="1" required />
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="0" min="0" step="0.01" required />
                        </div>

                        <div class="mb-3">
                            <label for="batch_number" class="form-label">Batch Number</label>
                            <input type="text" name="batch_number" id="batch_number" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date</label>
                            <input type="date" name="expiration_date" id="expiration_date" class="form-control" required />
                        </div>

                        <button type="submit" class="btn btn-success">Add Medication</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
