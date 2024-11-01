<?php


//$appointments = $db->getAllAppointments(); // Assuming this function exists
?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Patients</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">
            <div class="table-responsive p-5">
              
            <table class="table">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?php //echo $appointment['patient_name']; ?></td>
                        <td><?php //echo date('Y-m-d', strtotime($appointment['appointment_date'])); ?></td>
                        <td><?php //echo date('H:i', strtotime($appointment['appointment_date'])); ?></td>
                        <td><?php //echo ucfirst($appointment['status']); ?></td>
                        <td>
                            <a href="edit_appointment.php?id=<?php //echo $appointment['appointment_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="cancel_appointment.php?id=<?php //echo $appointment['appointment_id']; ?>" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
    </div>
            </div>

  </div>
  </div>
  </div>
  </div>
