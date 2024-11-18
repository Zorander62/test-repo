<?php

// Ensure the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../login.php");
//     exit();
// } 

//require_once '../model/function.php'; 
require_once 'model/function.php'; 
$db = new mainClass();

// $user = $_SESSION['name'];
// $user_role = $_SESSION['role'];
$os=$db->get_OS();
$ip=$db->get_ip();
$browser=$db->get_Browser();
$device=$db->get_Device();
$date=date("Y-m-d H:m:s");

$action = isset($_GET['a']) ? $_GET['a'] : 'default';

switch ($action) {

    case 'home':
        // Home action
        require_once 'view/home.php';
        break;

        case 'about':
            // Home action
            require_once 'view/about.php';
            break;

            case 'service':
                require_once 'view/service.php';
                break;

                case 'booking':
                    require_once 'view/booking.php';
                    break;

                    case 'contact':
                        require_once 'view/contact.php';
                        break;

                        case 'login':
                            require_once 'view/login.php';
                            break;

                            case 'signup':
                                require_once 'view/signup.php';
                                break;

                                case 'process_booking':
                                    require_once 'view/process_booking.php';
                                    break;
                                    
                                        case 'process_login':
                                            require_once 'view/process_login.php';
                                            break;

                                                case 'success':
                                                    require_once 'view/success.php';
                                                    break;

                                                        case 'register':
                                                            require_once 'view/register.php';
                                                            break;  

         


        default:

        require_once 'view/home.php';
         break;
 }
 ?>
 