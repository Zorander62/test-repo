<?php
$appointments = $Fcall->displayAppointments();
$role = $_SESSION['role']; // Assuming role is stored in session upon login

if (isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $role === 'admin') {
        // Only admin can delete appointments
        $delete = $Fcall->deleteAppointment($appointment_id);
        echo $delete ? '<script>swal("Success", "Your appointment was deleted successfully.", "success")</script>' :
                       '<script>swal("Warning", "Unable to delete appointment.", "warning")</script>';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete']) && in_array($role, ['admin', 'doctor'])) {
        // Only admin and doctor can mark appointments as completed
        $complete = $Fcall->markAppointmentCompleted($appointment_id);
        echo $complete ? '<script>swal("Success", "Appointment marked as complete.", "success")</script>' :
                         '<script>swal("Warning", "Unable to mark appointment as complete.", "warning")</script>';
    }
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Appointments</p>
                        <?php if (in_array($role, ['admin', 'receptionist'])): ?>
                            <a href="?a=new_appointment" class="btn btn-primary btn-sm ms-auto">New Appointment</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive p-5">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($appointments)): ?>
                                    <?php foreach ($appointments as $appointment): 
                                        $dateTime = new DateTime($appointment['appointment_date']);
                                        $time = $dateTime->format('H:i');
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($appointment['first_name']) . ' ' . htmlspecialchars($appointment['last_name']); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                                            <td><?php echo htmlspecialchars($time); ?></td>
                                            <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                                            <td>
                                                <a class="btn btn-success" href="?a=appointment_details&id=<?php echo $appointment['appointment_id']; ?>">View</a> |
                                                <?php if (in_array($role, ['admin', 'receptionist'])): ?>
                                                    <a class="btn btn-primary" href="?a=edit_appointment&id=<?php echo $appointment['appointment_id']; ?>">Edit</a> |
                                                <?php endif; ?>
                                                
                                                <?php if ($role === 'admin'): ?>
                                                    <!-- Only Admin can Delete -->
                                                    <form action="?a=appointments&id=<?php echo $appointment['appointment_id']; ?>" method="post" style="display:inline;">
                                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                                    </form> |
                                                <?php endif; ?>

                                                <?php if (in_array($role, ['admin', 'doctor'])): ?>
                                                    <!-- Admin and Doctor can Mark Complete -->
                                                    <form action="?a=appointments&id=<?php echo $appointment['appointment_id']; ?>" method="post" style="display:inline;">
                                                        <button type="submit" name="complete" class="btn btn-primary">Mark as Completed</button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No appointments found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
