<?php

$patients = $Fcall->getPatients();
$doctors = $Fcall->getDoctors();
$services = $Fcall->getServices();
// Fetch all lab tests
$tests = $Fcall->getAllTests(); // Method to fetch all tests from the database

// Handle test creation (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure that the form inputs are set
    if (isset($_POST['test_name']) && isset($_POST['description'])) {
        $test_name = $_POST['test_name'];
        $description = $_POST['description'];

        // Validate inputs (could be expanded)
        if (empty($test_name) || empty($description)) {
            // echo "Test name and description are required.";
            echo '<script>swal("Warning", "Test name and description are required", "warning")</script>';
        } else {
            // // Add the new test to the database
            // if ($Fcall->addTest($test_name, $description)) {
            //     echo "Test added successfully.";
            // } else {
            //     echo "Failed to add the test.";
            // }

            if ($Fcall->addTest($test_name, $description)) {
                echo '<script>
                    swal("Success", "Test added successfully.", "success")
                    .then(() => {
                        window.location.href = "?a=manage_test"; 
                    });
                </script>';
            } else {
                echo '<script>swal("Warning", "Failed to add the test.", "warning")</script>';
            }


        }
    } else {
        //echo "Test name and description are required.";
        echo '<script>swal("Warning", "Test name and description are required", "warning")</script>';
    }
}

?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0">Manage Lab Tests</h5>
                   
                </div>
                <div class="card-body"></div>

<!-- <div class="container">
    <h2>Manage Lab Tests</h2> -->

    <!-- Form to add a new test -->
    <form method="POST">

   

                <!-- Select Service -->
            

        <div class="mb-3">
            <label for="test_name" class="form-label">Test Name</label>
            <input type="text" class="form-control" id="test_name" name="test_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Test</button>
    </form>

    <!-- Table of existing tests -->
    <h3>Existing Tests</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tests as $test): ?>
            <tr>
                <td><?php echo htmlspecialchars($test['test_name']); ?></td>
                <td><?php echo htmlspecialchars($test['description']); ?></td>
                <td>
                    <a href="edit_test.php?id=<?php echo $test['test_id']; ?>">Edit</a> |
                    <a href="delete_test.php?id=<?php echo $test['test_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
