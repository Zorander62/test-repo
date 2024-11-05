<?php
$appointments = $Fcall->displayAppointments();

if (isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $delete = $Fcall->deleteAppointment($appointment_id);

        if ($delete) {
            echo '<script>
            swal("Success", "Your appointment was deleted successfully.", "success")
            .then(() => {
                window.location.href = "?a=appointments";
            });
            </script>';
        } else {
            echo '<script>swal("Warning", "Unable to delete appointment.", "warning")</script>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete'])) {
        $complete = $Fcall->markAppointmentCompleted($appointment_id);

        if ($complete) {
            echo '<script>
            swal("Success", "Appointment marked as complete.", "success")
            .then(() => {
                window.location.href = "?a=appointments";
            });
            </script>';
        } else {
            echo '<script>swal("Warning", "Unable to mark appointment as complete.", "warning")</script>';
        }
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
                        <a class="btn btn-primary btn-sm ms-auto">New Appointment</a>
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
                                                <a class="btn btn-primary" href="?a=edit_appointment&id=<?php echo $appointment['appointment_id']; ?>">Edit</a> |
                                                <form action="?a=appointments&id=<?php echo $appointment['appointment_id']; ?>" method="post" style="display:inline;">
                                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                                </form> |
                                                <form action="?a=appointments&id=<?php echo $appointment['appointment_id']; ?>" method="post" style="display:inline;">
                                                    <button type="submit" name="complete" class="btn btn-success">Mark as Completed</button>
                                                </form>
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

