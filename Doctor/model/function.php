<?php
class mainClass {
    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $DB = 'clinic_db';

    // public $host = 'localhost';
    // public $user = 'zockaeor_appfare';
    // public $password = 'oj}wfMJpYfff';
    // public $DB = 'zockaeor_apppay';
 

    private $conn;
 
    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->DB);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Login function
    public function login($email, $password) {

        $email = mysqli_real_escape_string($this->conn, $email);
        $sql = "SELECT id, password, name, role FROM users WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                // Password is correct, start a new session
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $email;
                return true;
            }
        }

        return false;

    }



    public function addPatient($name, $email, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO patients (name, email, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $phone);
        $stmt->execute();
        $stmt->close();
    }

    // Function to get all patients
    public function getAllPatients() {
        $stmt = $this->conn->prepare("SELECT id, name, email, phone FROM patients");
        $stmt->execute();
        $result = $stmt->get_result();
        $patients = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $patients;
    }

    // Function to get a patient by ID
    public function getPatientById($id) {
        $stmt = $this->conn->prepare("SELECT id, name, email, phone FROM patients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $email, $phone);
        $stmt->fetch();
        $stmt->close();
        return ['id' => $id, 'name' => $name, 'email' => $email, 'phone' => $phone];
    }

    // Function to update a patient's details
    public function updatePatient($id, $name, $email, $phone) {
        $stmt = $this->conn->prepare("UPDATE patients SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $phone, $id);
        $stmt->execute();
        $stmt->close();
    }

    // Function to delete a patient
    public function deletePatient($id) {
        $stmt = $this->conn->prepare("DELETE FROM patients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
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



    function DeleteFunc($table,$field,$data){

      $sql  = "DELETE FROM $table WHERE $field='$data'";
      $query = $this->conn->query($sql) or print(mysqli_error($this->conn));
        if($query == true){

                return true;

            }else{

                return false;

            } 
            
//$this->conn->close();  

    }









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
?>