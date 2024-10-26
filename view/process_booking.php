<?php
require_once "model/function.php"; 
$db = new mainClass(); // Include your functions file for database operations

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $appointment_date = $_POST['appointment_date'] . ' ' . $_POST['appointment_time']; // Combine date and time
    $special_request = $_POST['special_request'];

    // Check if the user already exists
    $stmt = $db->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // User exists, retrieve their patient_id
        $user_id = $user['user_id'];
        $stmt = $db->prepare("SELECT patient_id FROM patients WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $patient = $stmt->fetch();

        if ($patient) {
            // Patient exists, insert the appointment
            $db->insertAppointment($patient['patient_id'], $appointment_date);
            echo '<script>
            swal("Success", "Your appointment has been booked successfully.", "success")
            .then((value) => {
                window.location.href = "?a=booking";
            });
          </script>';
            // header("Location: success.php"); // Redirect to a success page
            // exit();
        } else {
            // Handle the case where the patient does not exist
            //echo "No patient record found for this user.";
            echo '<script>swal("Warning","No patient record found for this user.","warning")</script>';
             //echo '<script>swal("Warning","Registration number is already in use","warning")</script>';
            exit();
        }
    } else {
        // User does not exist, redirect to signup page with necessary data
        header("Location: ?a=signup&first_name=" . urlencode($first_name) . "&last_name=" . urlencode($last_name) . "&email=" . urlencode($email) . "&mobile=" . urlencode($mobile) . "&birth_date=" . urlencode($birth_date) . "&appointment_date=" . urlencode($appointment_date) . "&special_request=" . urlencode($special_request));
        exit();
    }
}


?>