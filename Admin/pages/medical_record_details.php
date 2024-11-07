<?php


// Get patient ID from URL parameter
$patient_id = $_GET['id'];

// Fetch the patient and their full record
$record = $Fcall->fetchPatientFullRecord($patient_id);
$patient = $record['patient'];
$vitals = $record['vitals'];

?>

<<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Medical Record Details</p>
                <a href="?a=medical_record" class="btn btn-primary btn-sm ms-auto">Back</a>
              </div>
            </div>

            <div class="card-body p-4 ">
        <div class="card shadow-lg mb-4">
        <div class="card-body d-flex align-items-center justify-content-between">
            <h4>Medical Record for <?php echo $patient['first_name']." ".$patient['last_name']; ?></h4>
            <!-- <button class="btn btn-primary">Edit Record</button>
            <button class="btn btn-secondary">Print Record</button> -->
        </div>
    </div>

    <!-- Patient Overview -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h6 class="card-title text-primary">Patient Overview</h6><br>
            <div class="row">
                <div class="col-md-3"><strong>Patient ID:</strong> #<?php echo $patient['patient_id']; ?></div>
                <div class="col-md-4"><strong>Name:</strong> <?php echo$patient['first_name']." ".$patient['last_name']; ?></div>
                <div class="col-md-3"><strong>Age:</strong> <?php echo $patient['age']; ?></div>
                <div class="col-md-2"><strong>Gender:</strong> <?php echo $patient['gender']; ?></div>
                <div class="col-md-3"><strong>Contact:</strong> <?php echo $patient['phone_number']; ?></div>
                <div class="col-md-4"><strong>Email:</strong> <?php echo $patient['email']; ?></div>
                <div class="col-md-3"><strong>Blood Type:</strong> <?php echo $patient['blood_type']; ?></div>
            </div>
        </div>
    </div>

    <!-- Vitals Section -->
    <h5>Vitals</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Blood Pressure</th>
                <th>Heart Rate</th>
                <th>Temperature</th>
                <th>Respiratory Rate</th>
                <th>Oxygen Saturation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vitals as $vital): ?>
                <tr>
                    <td><?php echo $vital['date']; ?></td>
                    <td><?php echo $vital['blood_pressure']; ?></td>
                    <td><?php echo $vital['heart_rate']; ?></td>
                    <td><?php echo $vital['temperature']; ?></td>
                    <td><?php echo $vital['respiratory_rate']; ?></td>
                    <td><?php echo $vital['oxygen_saturation']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>