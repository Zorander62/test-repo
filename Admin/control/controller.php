<?php

// Ensure the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit();
// } 

//require_once '../model/function.php'; 
require_once 'model/function.php'; 
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
        require_once 'view/dashboard.php';
        break;


        case 'appointments':
            // Home action
            require_once 'pages/appointments.php';
            break;


        case 'patients':
            // Home action
            require_once 'pages/patients.php';
            break;



            case 'settings':
                // Home action
                require_once 'pages/settings.php';
                break;


                case 'reports':
                    // Home action
                    require_once 'pages/reports.php';
                    break;


                    case 'billing':
                        // Home action
                        require_once 'pages/billing.php';
                        break;

            




        default:

        require_once 'pages/dashboard.php';
         break;
 }
 ?>
 