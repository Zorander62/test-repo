<?php



require_once '../model/function.php'; 
$Fcall = new mainClass();

// Get user role from session
$user_role = $_SESSION['role'];

// Get OS, IP, Browser, and Device details
$os = $Fcall->get_OS();
$ip = $Fcall->get_ip();
$browser = $Fcall->get_Browser();
$device = $Fcall->get_Device();
$date = date("Y-m-d H:i:s");

// Assuming you store the role in session upon login
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

// Set the action based on the query parameter or default
$action = isset($_GET['a']) ? $_GET['a'] : 'default';

// // Define the action (default is 'home')
// $action = isset($_GET['a']) ? $_GET['a'] : 'default';

// Handle role-based dashboard redirection
switch ($action) {
    case 'home':
        // Based on role, decide which dashboard to show
        switch ($user_role) {
            case 'admin':
                require_once 'pages/dashboard.php';  // Admin dashboard
                break;
            case 'pharmacy':
                require_once 'pages/pharmacy_dashboard.php';  // Pharmacy dashboard
                break;
            case 'receptionist':
                require_once 'pages/receptionist_dashboard.php';  // Receptionist dashboard
                break;
            case 'laboratory':
                require_once 'pages/laboratory_dashboard.php';  // Laboratory dashboard
                break;
            case 'doctor':
                require_once 'pages/doctor_dashboard.php';  // Laboratory dashboard
                break;
            case 'billing':
                    require_once 'pages/billing_dashboard.php';  // Laboratory dashboard
                    break;
            default:
                require_once 'view/dashboard.php';  // Default dashboard if no role matched
        }
        break;

    case 'appointments':
        require_once 'pages/appointments.php';
        break;

    case 'patients':
        require_once 'pages/patients.php';
        break;

    case 'add_user':
        require_once 'pages/add_user.php';
        break;

    case 'settings':
        require_once 'pages/settings.php';
        break;

    case 'reports':
        require_once 'pages/reports.php';
        break;

    case 'billing':
        require_once 'pages/billing.php';
        break;

    case 'user_management':
        require_once 'pages/user_management.php';
        break;

    case 'new_appointment':
        require_once 'pages/new_appointment.php';
        break;

    case 'new_billing':
        require_once 'pages/new_billing.php';
        break;

    case 'edit_patient':
        require_once 'pages/edit_patient.php';
        break;

    case 'appointment_details':
        require_once 'pages/appointment_details.php';
        break;

    case 'edit_appointment':
        require_once 'pages/edit_appointment.php';
        break;

    case 'new_user':
        require_once 'pages/add_user.php';
        break;

    case 'edit_user':
        require_once 'pages/edit_user.php';
        break;

    case 'view_bill':
        require_once 'pages/view_bill.php';
        break;

    case 'manage_payment':
        require_once 'pages/manage_payment.php';
        break;

        case 'access_denied':
            require_once 'pages/access_denied.php';
            break;

        case 'medical_record':
            require_once 'pages/medical_record.php';
            break;
            

        case 'medical_record_details':
            require_once 'pages/medical_record_details.php';
            break;

        case 'view_bill_information':
            require_once 'pages/view_bill_information.php';
            break;

        case 'manage_prescription':
            require_once 'pages/manage_prescription.php';
            break;


        case 'prescription':
            require_once 'pages/prescription.php';
            break;
        
        case 'new_prescription':
            require_once 'pages/new_prescription.php';
            break;

        case 'edit_prescription':
            require_once 'pages/edit_prescription.php';
            break;

        case 'doctor_report':
            require_once 'pages/doctor_report.php';
            break;

        case 'manage_inventory':
            require_once 'pages/manage_inventory.php';
            break;

        
            case 'update_stock':
                require_once 'pages/update_stock.php';
                break;


            case 'low_stock_alert':
                require_once 'pages/low_stock_alert.php';
                break;

            case 'dispense_medication':
                require_once 'pages/dispense_medication.php';
                break;

            case 'add_medication':
                require_once 'pages/add_medication.php';
                break;

            case 'prescriptions_pharmacy':
                require_once 'pages/prescriptions_pharmacy.php';
                break;

            case 'create_prescription':
                require_once 'pages/create_prescription.php';
                break;

            case 'view_prescription':
                require_once 'pages/view_prescription.php';
                break;

            case 'update_prescription':
                require_once 'pages/update_prescription.php';
                break;

            case 'despense':
                require_once 'pages/despense.php';
                break;

            case 'view_transaction':
                require_once 'pages/view_transaction.php';
                break;

                case 'sales_history':
                    require_once 'pages/sales_history.php';
                    break;

                    case 'view_dispened':
                        require_once 'pages/view_dispened.php';
                        break;

                        case 'manage_test':
                            require_once 'pages/manage_test.php';
                            break;

                            case 'manage_samples':
                                require_once 'pages/manage_samples.php';
                                break;

                          
                                case 'result':
                                    require_once 'pages/result.php';
                                    break;
                            
                                case 'view_results':
                                    require_once 'pages/view_results.php';
                                    break;

                                    case 'generate_report':
                                        require_once 'pages/generate_report.php';
                                        break;
                          
                                        case 'edit_test':
                                            require_once 'pages/edit_test.php';
                                            break;
                      
                     


           
    case 'logout':
        require_once 'pages/logout.php';
        break;

    

    default:
    // Set default pages based on role
    switch ($role) {
        case 'admin':
            require_once 'pages/admin_dashboard.php';
            break;
        case 'doctor':
            require_once 'pages/doctor_dashboard.php';
            break;
        case 'receptionist':
            require_once 'pages/receptionist_dashboard.php';
            break;
        case 'pharmacy':
            require_once 'pages/pharmacy_dashboard.php';
            break;
        case 'laboratory':
            require_once 'pages/laboratory_dashboard.php';
            break;
        case 'billing':
            require_once 'pages/billing_dashboard.php';
            break;
        default:
            // Redirect to a guest or login page for unauthenticated users
            require_once 'pages/login.php';
            break;
    }
    break;

    // default:
    //     // Default to dashboard if no action is set
    //     require_once 'pages/dashboard.php';
    //     break;
}
?>
