<?php

// Ensure the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit();
// } 

//require_once '../model/function.php'; 
require_once '../model/function.php'; 
$Fcall = new mainClass();

// $user = $_SESSION['name'];
// $user_role = $_SESSION['role'];
$os=$Fcall->get_OS();
$ip=$Fcall->get_ip();
$browser=$Fcall->get_Browser();
$device=$Fcall->get_Device();
$date=date("Y-m-d H:m:s");

$action = isset($_GET['a']) ? $_GET['a'] : 'default';

switch ($action) {

    case 'home':
        // Home action
        require_once 'pages/dashboard.php';
        break;


        case 'profile':
            // Home action
            require_once 'pages/profile.php';
            break;


        case 'appointment':
            // Home action
            require_once 'pages/appointment.php';
            break;



            case 'cancel_apointment':
                // Home action
                require_once 'pages/cancel_apointment.php';
                break;


                case 'billing':
                    // Home action
                    require_once 'pages/billing.php';
                    break;


                    case 'check_result':
                        // Home action
                        require_once 'pages/check_result.php';
                        break;

                        case 'view_appointments':
                            // Home action
                            require_once 'pages/view_appointments.php';
                            break;
    

            
                        


        default:

        require_once 'pages/dashboard.php';
         break;
 }
 ?>
 