<?php

// Get the search parameters from the form submission
// $name = isset($_GET['name']) ? $_GET['name'] : '';
// $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
// $dob = isset($_GET['dob']) ? $_GET['dob'] : '';

// // Call the function to fetch patients
// $patients = $Fcall->fetchPatientRecords($name, $phone, $dob);
$patients = $Fcall->fetchAllPatients();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0"> Search for Patient</p>
                        <!-- <a href="?a=appointments" class="btn btn-primary btn-sm ms-auto">View Appointment</a> -->
                    </div>
                </div>

                <div class="card-body p-4">


                <table id="patients-table" class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Blood Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?php echo $patient['first_name']." ".$patient['last_name']; ?></td>
                    <td><?php echo $patient['phone_number']; ?></td>
                    <td><?php echo $patient['date_of_birth']; ?></td>
                    <td><?php echo $patient['gender']; ?></td>
                    <td><?php echo $patient['blood_type']; ?></td>
                    <td>
                        <a href="?a=medical_record_details&id=<?php echo $patient['patient_id']; ?>" class="btn btn-info text-white">View</a>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#patients-table').DataTable({
            paging: true,         // Enable pagination
            searching: true,      // Enable search functionality
            ordering: true,       // Enable sorting functionality
            order: [[0, 'asc']],  // Default sorting by name (first column)
            lengthMenu: [5, 10, 25, 50],  // Display records per page
        });
    });
</script>