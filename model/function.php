<?php
class mainClass {
    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $DB = 'clinic_db';

    private $conn;

    public function __construct() {
        // Correctly use $this->DB for the database name
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->DB);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function insertUser($username, $password, $email, $role = 'patient') {
        $getpass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, email, role, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $username, $getpass, $email, $role);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Return the last inserted user_id
        } else {
            // Handle error
            echo "Error inserting user: " . $stmt->error; // Print error for debugging
            return false;
        }
    }
    
    function insertPatient($user_id, $first_name, $last_name, $birth_date, $mobile, $email) {
        $stmt = $this->conn->prepare("INSERT INTO patients (user_id, first_name, last_name, date_of_birth, phone_number, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $first_name, $last_name, $birth_date, $mobile, $email);
        $stmt->execute();
    }
    
    function getPatientByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT patient_id FROM patients WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // Return the patient record or false if not found
    }
    
    function insertAppointment($patient_id, $appointment_date) {
        $stmt = $this->conn->prepare("INSERT INTO appointments (patient_id, appointment_date, status, created_at) VALUES (?, ?, 'scheduled', NOW())");
        $stmt->bind_param("is", $patient_id, $appointment_date);
        $stmt->execute();
    }
    


    function Targeted_information($table, $field, $data) {
        // Prepare the SQL statement with placeholders
        $sql = "SELECT * FROM $table WHERE $field = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            // Handle error
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }
    
        // Bind the parameter
        $stmt->bind_param("s", $data); // Assuming $data is a string. Change "s" to "i" for integers, etc.
    
        // Execute the statement
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        // Fetch the row
        $row = $result->fetch_array(MYSQLI_ASSOC); // Fetch as an associative array
    
        // Close the statement
        $stmt->close();
    
        // Return the row or false if no row was found
        return $row ? $row : false;
    }
    


     // Function to insert an appointment
     public function insertAppointment2($patient_id, $appointment_date, $special_request = null) {
        $stmt = $this->conn->prepare("INSERT INTO appointments (patient_id, appointment_date, special_request, status, created_at) VALUES (?, ?, ?, 'scheduled', NOW())");
        $stmt->bind_param("iss", $patient_id, $appointment_date, $special_request);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Return the last inserted appointment_id
        } else {
            echo "Error inserting appointment: " . $stmt->error;
            return false;
        }
    }

    // Function to cancel an appointment
    public function cancelAppointment($appointment_id) {
        $stmt = $this->conn->prepare("UPDATE appointments SET status = 'canceled' WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);
        
        if ($stmt->execute()) {
            return true; // Appointment canceled successfully
        } else {
            echo "Error canceling appointment: " . $stmt->error;
            return false;
        }
    }

    // Function to get appointments by user ID
    public function getAppointmentsByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT a.appointment_id, a.appointment_date, a.special_request, a.status FROM appointments a JOIN patients p ON a.patient_id = p.patient_id WHERE p.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC); // Return all appointments as an associative array
    }

    // Function to get billing information by user ID
    public function getBillingInfoByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT service, amount, status FROM billing WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC); // Return all billing info as an associative array
    }

    // Function to get results by user ID
    public function getResultsByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT test_name, test_date, result FROM results r JOIN patients p ON r.patient_id = p.patient_id WHERE p.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC); // Return all results as an associative array
    }





    public function authenticateUser($username, $password) {
        // Prepare and bind
        $stmt = $this->conn->prepare("SELECT user_id, username, password, role FROM users WHERE username = ? AND role !='patient'");
        $stmt->bind_param("s", $username);
        
        // Execute the statement
        $stmt->execute();
        
        // Bind result variables
        $stmt->bind_result($user_id, $db_username, $db_password, $role);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($password, $db_password)) {
                // Return user data if authentication is successful
                return [
                    'user_id' => $user_id,
                    'username' => $db_username,
                    'role' => $role
                ];
            }
        }
        
        // Close the statement
        $stmt->close();
        
        // Return false if authentication fails
        return false;
    }



    // public function getAllUsers() {
    //     $result = $this->conn->query("SELECT id, username, role FROM users");
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT user_id, username, role FROM users WHERE role !='patient'");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $users;
    }
    
    public function addUser($username, $password, $role) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();
        $stmt->close();
    }
    
    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT id, username, role FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $role);
        $stmt->fetch();
        return ['id' => $id, 'username' => $username, 'role' => $role];
    }
    
    public function updateUser($id, $username, $role) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $role, $id);
        $stmt->execute();
        $stmt->close();
    }
    
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }















    

    // Process payment function
    public function processPayment($student_id, $amount, $payment_method) {

        // Example logic to handle the payment processing
        $transaction_id = $this->generateTransactionID();
        // Insert payment record into the database
        $sql = "INSERT INTO payments (student_id, amount, payment_method, transaction_id) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "idss", $student_id, $amount, $payment_method, $transaction_id);

        if (mysqli_stmt_execute($stmt)) {

                return true;

            } else {

                return false;

        }


    }























    // Generate a unique transaction ID (example implementation)
    private function generateTransactionID() {

            return strtoupper(bin2hex(random_bytes(4)));

    }



    public function creatStudent($name, $reg_number, $selectProgram, $faculty, $department, $email, $phone, $gender) {

        $sql = "INSERT INTO students (name, reg_number, program, faculty, department, email, phone, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $reg_number, $selectProgram, $faculty, $department, $email, $phone, $gender);
        
            if (mysqli_stmt_execute($stmt)) {

                return mysqli_insert_id($this->conn);

            } else {

                return false;

            }

    }



    public function creatStudent2($name, $reg_number, $selectProgram, $level, $faculty, $department, $email, $phone) {

        $sql = "INSERT INTO students (name, reg_number, program, level, faculty, department, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $reg_number, $selectProgram, $level, $faculty, $department, $email, $phone);
        
        if (mysqli_stmt_execute($stmt)) {

                return mysqli_insert_id($this->conn);

        } else {

                return false;

        }

    }



    public function createAccount($name, $email, $password) {

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
        
            if (mysqli_stmt_execute($stmt)) {

                    return mysqli_insert_id($this->conn);

            } else {

                    return false;

        }

    }



    public function createAccountIn($name, $email, $password, $role) {

        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashedPassword,$role);

            if (mysqli_stmt_execute($stmt)) {

                    return mysqli_insert_id($this->conn);

            } else {

                    return false;

        }

    }



    public function emailExists($email) {

        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;

    }


    public function regNumberExists($reg_number) {

        $sql = "SELECT id FROM students WHERE reg_number = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $reg_number);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;

    }


    public function CheckifroomActive($room_number) {
        $sql = "SELECT id FROM room_allocations WHERE room_number = ? AND status='active'";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $room_number);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt) > 0;
    }



    public function requestPasswordReset($email) {

        $email = mysqli_real_escape_string($this->conn, $email);
        // Check if the email exists
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
            if (mysqli_num_rows($result) == 0) {

                return false; // Email not found

            }
        
        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Store the token in the database
        $sql = "INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $email, $token, $expires);
        
        if (mysqli_stmt_execute($stmt)) {
            
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
            $host = $_SERVER['HTTP_HOST'];
            $scriptDir = dirname($_SERVER['PHP_SELF']);
            $resetLink = $protocol . "://" . $host . $scriptDir . "/reset_password.php?token=" . $token;
            $subject = "Password Reset Request";
            $body = "Hello,<br><br>You have requested to reset your password. Please click the link below to reset your password:<br><br>
                         <a href='$resetLink'>Reset Password</a><br><br>
                         This link will expire in 1 hour.<br><br>
                         If you did not request this password reset, please ignore this email.";

                //return $this->other_email($email, $subject, $body);

        } else {

                return false;

        }

    }



    public function verifyResetToken($token) {

        $token = mysqli_real_escape_string($this->conn, $token);
        $now = date('Y-m-d H:i:s');
        $sql = "SELECT email FROM password_resets WHERE token = ? AND expires > ? LIMIT 1";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $token, $now);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
            if ($row = mysqli_fetch_assoc($result)) {

                return $row['email'];

            }

            return false;

    }



    public function resetPassword($email, $newPassword) {

        $email = mysqli_real_escape_string($this->conn, $email);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
        
        if (mysqli_stmt_execute($stmt)) {

            // Delete the used token
            $sql = "DELETE FROM password_resets WHERE email = ?";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            return true;

        }

        return false;

    }



    public function Users_Delete($data) {

        $data = mysqli_real_escape_string($this->conn, $data);
        $sql  = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $data);
        $result = mysqli_stmt_execute($stmt);
        
        return $result;

    }



    public function insertPayment($studentName,$regNo,$program,$level,$session,$faculty,$department,$amount,$paymentMethod,$tellerNumber,$bankName,$dateOfPayment,$formOfPayment,$status,$performedby,$Transaction_ID) {

        $studentName1 = mysqli_real_escape_string($this->conn, $studentName);
        $regNo1 = mysqli_real_escape_string($this->conn, $regNo);
        $program1 = mysqli_real_escape_string($this->conn, $program);
        $level1 = mysqli_real_escape_string($this->conn, $level);
        $session1 = mysqli_real_escape_string($this->conn, $session);
        $faculty1 = mysqli_real_escape_string($this->conn, $faculty);
        $department1 = mysqli_real_escape_string($this->conn, $department);
        $amount1 = mysqli_real_escape_string($this->conn, $amount);
        $paymentMethod1 = mysqli_real_escape_string($this->conn, $paymentMethod);
        $tellerNumber1 = mysqli_real_escape_string($this->conn, $tellerNumber);
        $bankName1 = mysqli_real_escape_string($this->conn, $bankName);
        $dateOfPayment1 = mysqli_real_escape_string($this->conn, $dateOfPayment);
        $formOfPayment1 = mysqli_real_escape_string($this->conn, $formOfPayment);
        $status1 = mysqli_real_escape_string($this->conn, $status);
        $performedby1 = mysqli_real_escape_string($this->conn, $performedby);
        $Transaction_ID1 = mysqli_real_escape_string($this->conn, $Transaction_ID);
        
        $sql = "INSERT INTO payments (name, reg_number, program, level, session, faculty, department, amount, payment_method, teller_number, bank_name, date_of_payment, form_of_payment, status, performed_by, transaaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $studentName, $regNo, $program, $level, $session, $faculty, $department, $amount, $paymentMethod, $tellerNumber, $bankName, $dateOfPayment, $formOfPayment, $status, $performedby, $Transaction_ID);
        
            if (mysqli_stmt_execute($stmt)) {

                return mysqli_insert_id($this->conn);

            } else {

                return false;

            }

    }



    public function insertPaymenthOSTEL($studentName,$regNo,$email,$room_id,$room_number,$room_type,$from_date,$to_date,$amount,$paymentMethod,$tellerNumber,$bankName,$dateOfPayment,$formOfPayment,$status,$performedby,$Transaction_ID) {

        $studentName1 = mysqli_real_escape_string($this->conn, $studentName);
        $regNo1 = mysqli_real_escape_string($this->conn, $regNo);
        $email1 = mysqli_real_escape_string($this->conn, $email);
        $room_id1 = mysqli_real_escape_string($this->conn, $room_id);
        $room_number1 = mysqli_real_escape_string($this->conn, $room_number);
        $room_type1 = mysqli_real_escape_string($this->conn, $room_type);
        $from_date1 = mysqli_real_escape_string($this->conn, $from_date);
        $to_date1 = mysqli_real_escape_string($this->conn, $to_date);
        $amount1 = mysqli_real_escape_string($this->conn, $amount);
        $paymentMethod1 = mysqli_real_escape_string($this->conn, $paymentMethod);
        $tellerNumber1 = mysqli_real_escape_string($this->conn, $tellerNumber);
        $bankName1 = mysqli_real_escape_string($this->conn, $bankName);
        $dateOfPayment1 = mysqli_real_escape_string($this->conn, $dateOfPayment);
        $formOfPayment1 = mysqli_real_escape_string($this->conn, $formOfPayment);
        $status1 = mysqli_real_escape_string($this->conn, $status);
        $performedby1 = mysqli_real_escape_string($this->conn, $performedby);
        $Transaction_ID1 = mysqli_real_escape_string($this->conn, $Transaction_ID);
        
        $sql = "INSERT INTO hostel_payment (name, reg_number, email, room_id, room_number, room_type, from_date, to_date, amount, payment_method, teller_number, bank_name, date_of_payment, form_of_payment, status, performed_by, transaaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $studentName1,$regNo1,$email1,$room_id1,$room_number1,$room_type1,$from_date1,$to_date1,$amount1,$paymentMethod1,$tellerNumber1,$bankName1,$dateOfPayment1,$formOfPayment1,$status1,$performedby1,$Transaction_ID1);
        
        if (mysqli_stmt_execute($stmt)) {

            return mysqli_insert_id($this->conn);

        } else {

            return false;

        }

    }



    public function insertOnlinePayment($studentName,$regNo,$program,$level,$session,$faculty,$department,$amount,$paymentMethod,$dateOfPayment,$formOfPayment,$status,$performedby,$Transaction_ID) {

        $studentName1 = mysqli_real_escape_string($this->conn, $studentName);
        $regNo1 = mysqli_real_escape_string($this->conn, $regNo);
        $program1 = mysqli_real_escape_string($this->conn, $program);
        $level1 = mysqli_real_escape_string($this->conn, $level);
        $session1 = mysqli_real_escape_string($this->conn, $session);
        $faculty1 = mysqli_real_escape_string($this->conn, $faculty);
        $department1 = mysqli_real_escape_string($this->conn, $department);
        $amount1 = mysqli_real_escape_string($this->conn, $amount);
        $paymentMethod1 = mysqli_real_escape_string($this->conn, $paymentMethod);
        // $tellerNumber1 = mysqli_real_escape_string($this->conn, $tellerNumber);
        // $bankName1 = mysqli_real_escape_string($this->conn, $bankName);
        $dateOfPayment1 = mysqli_real_escape_string($this->conn, $dateOfPayment);
        $formOfPayment1 = mysqli_real_escape_string($this->conn, $formOfPayment);
        $status1 = mysqli_real_escape_string($this->conn, $status);
        $performedby1 = mysqli_real_escape_string($this->conn, $performedby);
        $Transaction_ID1 = mysqli_real_escape_string($this->conn, $Transaction_ID);
        
        $sql = "INSERT INTO payments (name, reg_number, program, level, session, faculty, department, amount, payment_method, date_of_payment, form_of_payment, status, performed_by, transaaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $studentName, $regNo, $program, $level, $session, $faculty, $department, $amount, $paymentMethod, $dateOfPayment, $formOfPayment, $status, $performedby, $Transaction_ID);
        
        if (mysqli_stmt_execute($stmt)) {

            return mysqli_insert_id($this->conn);

        } else {

            return false;

        }

    }



    public function insertOnlinePaymentHostel($studentName, $regNo, $email, $room_id, $room_number, $room_type, $from_date, $to_date, $amount,$paymentMethod,$dateOfPayment,$formOfPayment,$status,$performedby,$Transaction_ID) {

            $studentName1 = mysqli_real_escape_string($this->conn, $studentName);
            $regNo1 = mysqli_real_escape_string($this->conn, $regNo);
            $email1 = mysqli_real_escape_string($this->conn, $email);
            $room_id1 = mysqli_real_escape_string($this->conn, $room_id);
            $room_number1 = mysqli_real_escape_string($this->conn, $room_number);
            $room_type1 = mysqli_real_escape_string($this->conn, $room_type);
            $from_date1 = mysqli_real_escape_string($this->conn, $from_date);
            $to_date1 = mysqli_real_escape_string($this->conn, $to_date);
            $amount1 = mysqli_real_escape_string($this->conn, $amount);
            $paymentMethod1 = mysqli_real_escape_string($this->conn, $paymentMethod);
            // $tellerNumber1 = mysqli_real_escape_string($this->conn, $tellerNumber);
            // $bankName1 = mysqli_real_escape_string($this->conn, $bankName);
            $dateOfPayment1 = mysqli_real_escape_string($this->conn, $dateOfPayment);
            $formOfPayment1 = mysqli_real_escape_string($this->conn, $formOfPayment);
            $status1 = mysqli_real_escape_string($this->conn, $status);
            $performedby1 = mysqli_real_escape_string($this->conn, $performedby);
            $Transaction_ID1 = mysqli_real_escape_string($this->conn, $Transaction_ID);
            
            $sql = "INSERT INTO hostel_payment (name, reg_number, email, room_id, room_number, room_type, from_date, to_date, amount, payment_method, date_of_payment, form_of_payment, status, performed_by, transaaction_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssssssssssss", $studentName1, $regNo1, $email1, $room_id1, $room_number1, $room_type1, $from_date1, $to_date1, $amount1, $paymentMethod1, $dateOfPayment1, $formOfPayment1 ,$status1, $performedby1 ,$Transaction_ID1);
            
            if (mysqli_stmt_execute($stmt)) {

                return mysqli_insert_id($this->conn);

            } else {

                return false;

            }

    }



    function Targeted_info($table, $field, $data) {
        // Prepare the SQL query with placeholders to prevent SQL injection
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $field = ?");
        if ($stmt === false) {
            // If the preparation fails, return the error
            die("Prepare failed: " . $this->conn->error);
        }

        // Bind the data to the placeholder
        $stmt->bind_param("s", $data);

        // Execute the statement
        if ($stmt->execute()) {
            // Fetch the result into an associative array
            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Return the fetched row
            return $row;
        } else {
            // Handle execution error
            return false;
        }

        // Close the statement
        // $stmt->close();
    }



    function check_info($table, $field, $data) {
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $field = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $data);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $stmt->close();
            
            return $row;
        } else {
            $stmt->close();
            return false;
        }
    }



    function getAllPayments() {

        $sql = "SELECT * FROM payments";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }



    function getAllPaymentswHERE($data) {

        $sql = "SELECT * FROM payments WHERE reg_number='$data'";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }



    function getAllPaymentsHostel() {

        $sql = "SELECT * FROM hostel_payment";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }




    function getAllPaymentsHostelWHERE($data) {

        $sql = "SELECT * FROM hostel_payment WHERE reg_number='$data' ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }




    function getAllStudent() {

        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }



    function getAllRooms() {

        $sql = "SELECT * FROM rooms";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {

            // Handle statement preparation error
            return null;

        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            return $result;

        } else {

            return null;

        }


    }



    function ChangePasswordIn($userId, $currentPassword, $newPassword, $confirmPassword) {
        // Validate input
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            echo 'All fields are required.';
            return false;
        }

        if ($newPassword !== $confirmPassword) {
            echo 'New password and confirm password do not match.';
            return false;
        }

        // Check password strength (example: at least 8 characters, 1 uppercase, 1 lowercase, 1 number)
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $newPassword)) {
            echo 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.';
            return false;
        }

        // Check current password
        $sql = "SELECT password FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt->close();
            echo 'User not found.';
            return false;
        }

        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        // Verify current password
        if (!password_verify($currentPassword, $hashedPassword)) {
            echo 'Current password is incorrect.';
            return false;
        }

        // Hash new password
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update new password
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $newHashedPassword, $userId);

        if ($stmt->execute()) {
            $stmt->close();
            echo 'Password updated successfully.';
            return true;
        } else {
            $stmt->close();
            echo 'Error updating password. Please try again.';
            return false;
        }
    }



    function ChangeName($name, $email) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE users SET name = ? WHERE email = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $name, $email);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected. Check if the email exists.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }




    function EditStudent($name,$program,$level,$faculty,$department,$gender,$phone,$reg_number) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE students SET name = ?, program = ?, level = ?, faculty = ?, department = ?, gender = ?, phone = ? WHERE reg_number = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ssssssss', $name, $program, $level, $faculty, $department, $gender, $phone, $reg_number);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected. Check if the email exists.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }



    function EditAccUser($name,$email) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE users SET name = ? WHERE email = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $name, $email);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected. Check if the email exists.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }




    function UpdateStudent($studentName,$phone, $selectProgram, $level, $faculty, $department,$reg_numbere) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE students SET name = ?, phone = ?,  program = ?, level = ?, faculty = ?, department = ? WHERE reg_number = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('sssssss', $studentName,$phone, $selectProgram, $level, $faculty, $department, $reg_numbere);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected. Check if the email exists.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }



    function UpdateRoom($block_floor, $hostel_name, $capacity, $available, $room_type, $fee_amount, $room_number) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE rooms SET block_floor = ?, hostel_name = ?,  capacity = ?, available = ?, room_type = ?, fee_amount = ? WHERE room_number = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('sssssss', $block_floor, $hostel_name, $capacity, $available, $room_type, $fee_amount, $room_number);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }



    function approvePay($status,$payid) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE payments SET status = ? WHERE id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $status,$payid);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }



    function approvePayHt($status,$payid) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE hostel_payment SET status = ? WHERE id = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $status,$payid);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }



    // function other_email($receiver,$subject,$body){

    //     require_once 'PHPMailer-5.2-stable/PHPMailerAutoload.php';
    //     $mail = new PHPMailer(true);                              

    //     //Server settings
    //     $mail->SMTPDebug = 0;
    //     $mail->isSMTP();
    //     $mail->Host = 'server306.web-hosting.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = 'admin@zockvila.com';
    //     $mail->Password = '&&ugIS}fLgoO';
    //     $mail->SMTPSecure = 'ssl';
    //     $mail->Port = 465;
    //     //Recipients
    //     $mail->setFrom('admin@zockvila.com','Zockvila');
    //     $mail->addAddress($receiver);

    //         $mail->isHTML(true);                                  // Set email format to HTML
    //         $mail->Subject = $subject;
    //         $mail->Body    = '
    //         <center><h1>'.$subject.'</h1></center>

    //         <div id="me" style="background-color:#F5F5F5; height:auto;width:auto; padding:18px;">
    //         <p>'.$body.'</p>
    //         </div>';

    //         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    //         if(!$mail->send()) {

    //             echo 'Message could not be sent.';
    //             echo 'Mailer Error: ' . $mail->ErrorInfo;

    //         }else{
                        
    //                     return true;

    //               }

    // }



    public function DeleteFunc($table, $field, $data) {
        // Prepare the SQL statement
        $stmt = $this->conn->prepare("DELETE FROM $table WHERE $field = ?");
        
        // Check if the statement was prepared successfully
        if ($stmt === false) {
            print(mysqli_error($this->conn));
            return false;
        }

        // Bind the parameter
        $stmt->bind_param("s", $data); // Assuming $data is a string. Change "s" to "i" if it's an integer.

        // Execute the statement
        $query = $stmt->execute();

        // Check if the query was successful
        if ($query) {
            $stmt->close(); // Close the statement
            return true;
        } else {
            print(mysqli_error($this->conn)); // Print error if the query fails
            return false;
        }
    }



    public function createRoom($room_number, $block, $hostel_name, $details, $room_type, $fee_amount) {

        $room_number1 = mysqli_real_escape_string($this->conn, $room_number);
        $block1 = mysqli_real_escape_string($this->conn, $block);
        $hostel_name1 = mysqli_real_escape_string($this->conn, $hostel_name);
        $details1 = mysqli_real_escape_string($this->conn, $details);
        $room_type1 = mysqli_real_escape_string($this->conn, $room_type);
        $fee_amount1 = mysqli_real_escape_string($this->conn, $fee_amount);
        
        $sql = "INSERT INTO rooms(room_number, block_floor, hostel_name, capacity, room_type, fee_amount) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $room_number1, $block1, $hostel_name1, $details1, $room_type1, $fee_amount1);
        
        if (mysqli_stmt_execute($stmt)) {

            return mysqli_insert_id($this->conn);

        } else {

            return false;

        }

    }



    public function AllocateRoom($reg_number, $room_id, $room_number, $allocation_date, $status) {

        $reg_number1 = mysqli_real_escape_string($this->conn, $reg_number);
        $room_id1 = mysqli_real_escape_string($this->conn, $room_id);
        $room_number1 = mysqli_real_escape_string($this->conn, $room_number);
        $allocation_date1 = mysqli_real_escape_string($this->conn, $allocation_date);
        $status1 = mysqli_real_escape_string($this->conn, $status);
        
        $sql = "INSERT INTO room_allocations(reg_number, room_id, room_number, allocation_date, status) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $reg_number, $room_id, $room_number, $allocation_date, $status);
        
        if (mysqli_stmt_execute($stmt)) {

            return mysqli_insert_id($this->conn);

        } else {

            return false;

        }

    }



    function UpdateAllocateStatus($status, $room_number) {
        // Prepare SQL query with placeholders
        $sql = "UPDATE rooms SET available = ? WHERE room_number = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle preparation error
            error_log('MySQL prepare error: ' . $this->conn->error);
            return false;
        }

        // Bind parameters
        $stmt->bind_param('ss', $status, $room_number);
        
        // Execute the statement
        $result = $stmt->execute();
        
        // Check execution result
        if ($result) {
            // Optionally, check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;
            } else {
                // No rows affected; might indicate the email does not exist
                error_log('No rows affected.');
            }
        } else {
            // Handle execution error
            error_log('MySQL execute error: ' . $stmt->error);
        }
        
        $stmt->close();
        return false;
    }


    public function getAllRoomChangeRequests() {

            $sql = "SELECT * FROM room_change_requests";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);

        }


    public function getAllRoomApplications() {

            $sql = "SELECT * FROM room_applications";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);

        }


    public function updateRoomChangeRequestStatus($id, $status) {
        $sql = "UPDATE room_change_requests SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);
        }


    public function updateRoomApplicationStatus($id, $status) {

        $sql = "UPDATE room_applications SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        return mysqli_stmt_execute($stmt);

    }


    public function getRoomApplications($student_id) {
            $sql = "SELECT * FROM room_applications WHERE student_id = ?";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $student_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        // Function to get room applications report
        public function getRoomApplicationsReport($status = null, $room_type = null) {
            $sql = "SELECT ra.id, s.name AS student_name, s.reg_number, ra.room_type, ra.status, ra.created_at 
                    FROM room_applications ra
                    JOIN students s ON ra.student_id = s.id
                    WHERE ra.status LIKE ? AND ra.room_type LIKE ?";
            
            $stmt = mysqli_prepare($this->conn, $sql);
            $status = $status ?: '%';
            $room_type = $room_type ?: '%';
            mysqli_stmt_bind_param($stmt, "ss", $status, $room_type);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }


        // Function to get room change requests report
        public function getRoomChangeRequestsReport($status = null, $requested_room_type = null) {
            $sql = "SELECT rcr.id, s.name AS student_name, s.reg_number, rcr.requested_room_type, rcr.status, rcr.reason, rcr.created_at 
                    FROM room_change_requests rcr
                    JOIN students s ON rcr.student_id = s.id
                    WHERE rcr.status LIKE ? AND rcr.requested_room_type LIKE ?";
            
            $stmt = mysqli_prepare($this->conn, $sql);
            $status = $status ?: '%';
            $requested_room_type = $requested_room_type ?: '%';
            mysqli_stmt_bind_param($stmt, "ss", $status, $requested_room_type);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }



    public function getStudentAllocationsReport($room_type = null, $faculty = null, $department = null) {
            $sql = "SELECT r.id AS room_id, r.room_number, s.name AS student_name, r.status , s.reg_number, s.faculty, s.department 
                    FROM room_allocations r
                    JOIN students s ON r.reg_number = s.reg_number
                    JOIN rooms ro ON r.room_id = ro.id
                    WHERE ro.room_type LIKE ? AND s.faculty LIKE ? AND s.department LIKE ?";
            
            $stmt = mysqli_prepare($this->conn, $sql);

            // Default values to match any if not provided
            $room_type = $room_type ?: '%';
            $faculty = $faculty ?: '%';
            $department = $department ?: '%';

            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "sss", $room_type, $faculty, $department);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Fetch all results as an associative array
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }



    public function getPaymentsReport($start_date, $end_date, $payment_method = null) {
    $sql = "SELECT p.id AS payment_id, s.name AS student_name, s.reg_number, p.amount, p.payment_method, p.created_at 
            FROM payments p
            JOIN students s ON p.id = s.id
            WHERE 1=1";
    
    $types = "";
    $params = array();
    
    if ($start_date) {
        $sql .= " AND DATE(p.created_at) >= ?";
        $types .= "s";
        $params[] = $start_date;
    }
    
    if ($end_date) {
        $sql .= " AND DATE(p.created_at) <= ?";
        $types .= "s";
        $params[] = $end_date;
    }
    
    if ($payment_method) {
        $sql .= " AND p.payment_method = ?";
        $types .= "s";
        $params[] = $payment_method;
    }
    
    $stmt = mysqli_prepare($this->conn, $sql);
    
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}





    public function getPaymentsReportH($start_date, $end_date, $payment_method = null) {
    $sql = "SELECT p.id AS payment_id, s.name AS student_name, s.reg_number, p.amount, p.payment_method, p.date 
            FROM hostel_payment p
            JOIN students s ON p.id = s.id
            WHERE 1=1";
    
    $types = "";
    $params = array();
    
    if ($start_date) {
        $sql .= " AND DATE(p.date) >= ?";
        $types .= "s";
        $params[] = $start_date;
    }
    
    if ($end_date) {
        $sql .= " AND DATE(p.date) <= ?";
        $types .= "s";
        $params[] = $end_date;
    }
    
    if ($payment_method) {
        $sql .= " AND p.payment_method = ?";
        $types .= "s";
        $params[] = $payment_method;
    }
    
    $stmt = mysqli_prepare($this->conn, $sql);
    
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


public function getTotalStudents() {
        $sql = "SELECT COUNT(*) AS total_students FROM students";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total_students'];
    }

    // Function to get the number of students who have paid fees
    public function getStudentsPaidFees() {
        $sql = "SELECT COUNT(DISTINCT reg_number) AS students_paid FROM payments WHERE status = 'paid'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['students_paid'];
    }

    // Function to get the number of students with pending fees
    public function getStudentsPendingFees() {
        $total_students = $this->getTotalStudents();
        $students_paid = $this->getStudentsPaidFees();
        return $total_students - $students_paid;
    }

    // Function to get the total overdue payments (assuming there's a due date field)
    public function getTotalOverduePayments() {
        $sql = "SELECT SUM(amount) AS overdue_payments FROM payments WHERE status = 'Pending' AND date_of_payment < NOW()";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['overdue_payments'] ? $row['overdue_payments'] : 0;
    }

    // Function to get the total number of rooms
    public function getTotalRooms() {
        $sql = "SELECT COUNT(*) AS total_rooms FROM rooms";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total_rooms'];
    }

    // Function to get the number of available rooms
    public function getAvailableRooms() {
        $sql = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE available = 'YES'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['available_rooms'];
    }

    // Function to get the number of allocated rooms
    public function getAllocatedRooms() {
        $sql = "SELECT COUNT(*) AS allocated_rooms FROM rooms WHERE available = 'NO'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['allocated_rooms'];
    }

    // Function to get the number of pending room change requests
    public function getPendingRequests() {
        $sql = "SELECT COUNT(*) AS pending_requests FROM room_change_requests WHERE status = 'Pending'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['pending_requests'];
    }


    public function getTotalFeesCollected() {
        $sql = "SELECT SUM(amount) AS total_collected FROM payments WHERE status = 'Success'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total_collected'] ? $row['total_collected'] : 0;
    }

    // Function to get the average payment per student
    public function getAveragePaymentPerStudent() {
        $sql = "SELECT AVG(total_paid) AS avg_payment FROM (SELECT SUM(amount) AS total_paid FROM payments WHERE status = 'Success' GROUP BY reg_number) AS student_totals";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['avg_payment'] ? $row['avg_payment'] : 0;
    }

    // Function to get the total outstanding fees
    public function getTotalOutstandingFees() {
        $sql = "SELECT SUM(amount) AS total_outstanding FROM payments WHERE status = 'Pending'";
        $result = mysqli_query($this->conn, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total_outstanding'] ? $row['total_outstanding'] : 0;
    }


      public function getGenderDistribution() {
        $sql = "SELECT gender, COUNT(*) AS count FROM students GROUP BY gender";
        $result = mysqli_query($this->conn, $sql);
        $genderData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $genderData[$row['gender']] = $row['count'];
        }
        return $genderData;
    }

    // Function to get grade/year distribution
    public function getGradeDistribution() {
        $sql = "SELECT level, COUNT(*) AS count FROM students GROUP BY level";
        $result = mysqli_query($this->conn, $sql);
        $gradeData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $gradeData[$row['level']] = $row['count'];
        }
        return $gradeData;
    }

    // Function to get recent transactions
    public function getRecentTransactions($limit = 3) {
        $sql = "SELECT date, name, amount FROM payments ORDER BY date DESC LIMIT ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }



    public function requestRoomChange($reg_number, $current_room_id, $requested_room_type, $requested_room_id = null, $reason) {
        $status = 'Pending'; // Initial status
        $request_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO room_change_requests (reg_number, current_room_id, requested_room_id, requested_room_type, reason, status, request_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $reg_number, $current_room_id, $requested_room_id, $requested_room_type, $reason, $status, $request_date);
        
        return mysqli_stmt_execute($stmt);

    }



public function getAllocatedRoomDetails($reg_number) {

    $sql = "SELECT r.room_number, r.room_type, r.block_floor, r.hostel_name, r.fee_amount
            FROM room_allocations ra
            JOIN rooms r ON ra.room_id = r.id
            WHERE ra.reg_number = ?";
    
    $stmt = mysqli_prepare($this->conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reg_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); // Fetch a single row

}



public function applyForRoom($reg_number, $room_type, $preferences) {

        $status = 'Pending'; // Initial status
        $application_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO room_applications (reg_number, room_type, preferences, application_date, status)
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $reg_number, $room_type, $preferences, $application_date, $status);
        
        return mysqli_stmt_execute($stmt);

}


   public function getApplicationStatus($reg_number) {
        $sql = "SELECT status FROM room_applications WHERE reg_number = ? ORDER BY application_date DESC LIMIT 1";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $reg_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        return $row ? $row['status'] : 'No application found';
    }



    public function updateStudentInfo($student_id, $session, $level, $address, $semester, $total_units, $date) {
    // Define the correct column names based on your table structure
    $sql = "UPDATE students SET session = ?, level = ?, address = ?, semester = ?, total_units = ?, course_reg_date = ? WHERE reg_number = ?";
    
    // Prepare the SQL statement
    $stmt = $this->conn->prepare($sql);
    
    // Check for preparation errors
    if (!$stmt) {
        die('Prepare failed: ' . $this->conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("sssssss", $session, $level, $address, $semester, $total_units, $date, $student_id);
    
    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
    
    return true;
}


    // public function updateStudentInfo($student_id, $session, $level, $address, $semester, $total_units, $date) {
    //     $sql = "UPDATE students SET session = ?, level = ?, address = ?, semester = ?, total_units = ?, course_reg_date = ? WHERE reg_number = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("sssssss", $session, $level, $address, $semester, $total_units, $date, $student_id);
    //     $stmt->execute();
    // }

// public function updateStudentInfo($student_id, $session, $level, $address, $semester, $total_units, $date) {
//     $sql = "UPDATE students SET session_column_name = ?, level_column_name = ?, address_column_name = ?, semester_column_name = ?, total_units_column_name = ?, course_reg_date_column_name = ? WHERE reg_number = ?";
//     $stmt = $this->conn->prepare($sql);
//     $stmt->bind_param("sssssss", $session, $level, $address, $semester, $total_units, $date, $student_id);
//     $stmt->execute();
// }


















function audit_trial_log($staff_id,$user,$os,$ip,$browser,$device,$description,$token_id,$updatex,$method){
             
    $sql='INSERT INTO audit_trail(name,user,os,ip,browser,device,action_performed,token_id,date_time,method)VALUES(?,?,?,?,?,?,?,?,?,?)';
    $query = $this->conn->prepare($sql);
    $query->bind_param('ssssssssss',$staff_id,$user,$os,$ip,$browser,$device,$description,$token_id,$updatex,$method);
    $query->execute();

        if ($query==true) {

            return true;

        }else {

            return false;

    }

}



function get_user_agent() {
return  $_SERVER['HTTP_USER_AGENT'];
}

function get_ip() {
$mainIp = '';
if (getenv('HTTP_CLIENT_IP'))
    $mainIp = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))
    $mainIp = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
    $mainIp = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
    $mainIp = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
    $mainIp = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
    $mainIp = getenv('REMOTE_ADDR');
else
    $mainIp = 'UNKNOWN';
return $mainIp;
}

function get_OS() {

$user_agent = self::get_user_agent();
$os_platform    =   "Unknown OS Platform";
$os_array       =   array(
    '/windows nt 10/i'      =>  'Windows 10',
    '/windows nt 6.3/i'     =>  'Windows 8.1',
    '/windows nt 6.2/i'     =>  'Windows 8',
    '/windows nt 6.1/i'     =>  'Windows 7',
    '/windows nt 6.0/i'     =>  'Windows Vista',
    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
    '/windows nt 5.1/i'     =>  'Windows XP',
    '/windows xp/i'         =>  'Windows XP',
    '/windows nt 5.0/i'     =>  'Windows 2000',
    '/windows me/i'         =>  'Windows ME',
    '/win98/i'              =>  'Windows 98',
    '/win95/i'              =>  'Windows 95',
    '/win16/i'              =>  'Windows 3.11',
    '/macintosh|mac os x/i' =>  'Mac OS X',
    '/mac_powerpc/i'        =>  'Mac OS 9',
    '/linux/i'              =>  'Linux',
    '/ubuntu/i'             =>  'Ubuntu',
    '/iphone/i'             =>  'iPhone',
    '/ipod/i'               =>  'iPod',
    '/ipad/i'               =>  'iPad',
    '/android/i'            =>  'Android',
    '/blackberry/i'         =>  'BlackBerry',
    '/webos/i'              =>  'Mobile'
);

foreach ($os_array as $regex => $value) {
    if (preg_match($regex, $user_agent)) {
        $os_platform    =   $value;
    }
}   
return $os_platform;
}

function  get_Browser() {

$user_agent= self::get_user_agent();

$browser        =   "Unknown Browser";

$browser_array  =   array(
    '/msie/i'       =>  'Internet Explorer',
    '/Trident/i'    =>  'Internet Explorer',
    '/firefox/i'    =>  'Firefox',
    '/safari/i'     =>  'Safari',
    '/chrome/i'     =>  'Chrome',
    '/edge/i'       =>  'Edge',
    '/opera/i'      =>  'Opera',
    '/netscape/i'   =>  'Netscape',
    '/maxthon/i'    =>  'Maxthon',
    '/konqueror/i'  =>  'Konqueror',
    '/ubrowser/i'   =>  'UC Browser',
    '/mobile/i'     =>  'Handheld Browser'
);

foreach ($browser_array as $regex => $value) {

    if (preg_match($regex, $user_agent)) {
        $browser    =   $value;
    }

}

return $browser;

}

function  get_Device(){

$tablet_browser = 0;
$mobile_browser = 0;

if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
}

if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
}

if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
}

$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');

if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}

if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
    $mobile_browser++;
        //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
        $tablet_browser++;
    }
}
 
if ($tablet_browser > 0) {
       // do something for tablet devices
    return 'Tablet';
}
else if ($mobile_browser > 0) {
       // do something for mobile devices
    return 'Mobile';
}
else {
       // do something for everything else
    return 'Computer';
}   
}




function __destruct() {
        mysqli_close($this->conn);
    }

}

// public function close() {
//     $this->conn->close();
// }
?>