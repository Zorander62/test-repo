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
        require_once 'view/dasboard.php';
        break;


        case 'about':
            // Home action
            require_once 'view/about.php';
            break;


        case 'service':
            // Home action
            require_once 'view/service.php';
            break;



            case 'booking':
                // Home action
                require_once 'view/booking.php';
                break;


                case 'contact':
                    // Home action
                    require_once 'view/contact.php';
                    break;


                    case 'login':
                        // Home action
                        require_once 'view/login.php';
                        break;

            




        default:

        require_once 'view/dasboard.php';
         break;
 }
 ?>
 