<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <!-- <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
        <span class="ms-1 font-weight-bold text-center"><?php echo $_SESSION['role']." ".'dashboard';?></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="?a=dashboard">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

         <!-- Admin-specific menu items -->
         <?php //if ($_SESSION['role'] === 'admin'): ?>
          <!-- <li class="nav-item">
          <a class="nav-link " href="?a=patients">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manage Patients</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="?a=appointments">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manage Appointments</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="?a=billing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Billing Management</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link " href="?a=reports">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Reports</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="?a=settings">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Settings</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link " href="?a=user_management">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manage User</span>
          </a>
        </li> -->
        <?php //endif; ?>


        <?php if ($_SESSION['role'] === 'admin'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=patients">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users text-warning text-sm opacity-10"></i> <!-- Users icon for managing patients -->
            </div>
            <span class="nav-link-text ms-1">Manage Patients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=appointments">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calendar-check text-success text-sm opacity-10"></i> <!-- Calendar check icon for managing appointments -->
            </div>
            <span class="nav-link-text ms-1">Manage Appointments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=billing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-credit-card text-info text-sm opacity-10"></i> <!-- Credit card icon for billing management -->
            </div>
            <span class="nav-link-text ms-1">Billing Management</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=reports">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-pie text-danger text-sm opacity-10"></i> <!-- Pie chart icon for reports -->
            </div>
            <span class="nav-link-text ms-1">Reports</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=settings">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-cogs text-info text-sm opacity-10"></i> <!-- Gear icon for settings -->
            </div>
            <span class="nav-link-text ms-1">Settings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=user_management">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users-cog text-warning text-sm opacity-10"></i> <!-- User cog icon for managing users -->
            </div>
            <span class="nav-link-text ms-1">Manage User</span>
        </a>
    </li>
<?php endif; ?>




        <?php if ($_SESSION['role'] === 'doctor'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=appointments">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-calendar-grid-58 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Manage Appointments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=medical_record">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-copy-04 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">View Medical Records</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=view_bill_information">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-money-coins text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">View Bill Information</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=manage_prescription">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-ruler-pencil text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Prescription</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=doctor_report">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-chart-bar-32 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Reports</span>
        </a>
    </li>
<?php endif; ?>

    
    <?php if ($_SESSION['role'] === 'pharmacy'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=manage_inventory">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-cogs text-success text-sm opacity-10"></i> <!-- Gear icon for managing inventory -->
            </div>
            <span class="nav-link-text ms-1">Manage Inventory</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=prescriptions_pharmacy">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-prescription-bottle-alt text-success text-sm opacity-10"></i> <!-- Prescription icon for managing prescriptions -->
            </div>
            <span class="nav-link-text ms-1">Manage Prescription</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=low_stock_alert">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-exclamation-circle text-danger text-sm opacity-10"></i> <!-- Warning icon for low stock -->
            </div>
            <span class="nav-link-text ms-1">Low Stock</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=despense">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-capsules text-info text-sm opacity-10"></i> <!-- Pill bottle icon for dispensing medication -->
            </div>
            <span class="nav-link-text ms-1">Dispense Medication</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=sales_history">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-history text-primary text-sm opacity-10"></i> <!-- Clock/history icon for sales history -->
            </div>
            <span class="nav-link-text ms-1">Sales History</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=view_dispened">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-clipboard-check text-success text-sm opacity-10"></i> <!-- Clipboard check icon for dispensed history -->
            </div>
            <span class="nav-link-text ms-1">Dispensed History</span>
        </a>
    </li>
<?php endif; ?>


<?php if ($_SESSION['role'] === 'laboratory'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=manage_test">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-flask text-success text-sm opacity-10"></i> <!-- Flask icon for managing tests -->
            </div>
            <span class="nav-link-text ms-1">Manage Test</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=manage_samples">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-vial text-warning text-sm opacity-10"></i> <!-- Vial icon for managing samples -->
            </div>
            <span class="nav-link-text ms-1">Manage Sample</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=result">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-line text-primary text-sm opacity-10"></i> <!-- Line chart icon for viewing results -->
            </div>
            <span class="nav-link-text ms-1">View Results</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=generate_report">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-file-alt text-info text-sm opacity-10"></i> <!-- File icon for generating reports -->
            </div>
            <span class="nav-link-text ms-1">Generate Report</span>
        </a>
    </li>
<?php endif; ?>


<?php if ($_SESSION['role'] === 'admin'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=patients">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users text-warning text-sm opacity-10"></i> <!-- Users icon for managing patients -->
            </div>
            <span class="nav-link-text ms-1">Manage Patients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=appointments">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calendar-check text-success text-sm opacity-10"></i> <!-- Calendar check icon for managing appointments -->
            </div>
            <span class="nav-link-text ms-1">Manage Appointments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=billing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-credit-card text-info text-sm opacity-10"></i> <!-- Credit card icon for billing management -->
            </div>
            <span class="nav-link-text ms-1">Billing Management</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=reports">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-chart-pie text-danger text-sm opacity-10"></i> <!-- Pie chart icon for reports -->
            </div>
            <span class="nav-link-text ms-1">Reports</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=settings">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-cogs text-info text-sm opacity-10"></i> <!-- Gear icon for settings -->
            </div>
            <span class="nav-link-text ms-1">Settings</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=user_management">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users-cog text-warning text-sm opacity-10"></i> <!-- User cog icon for managing users -->
            </div>
            <span class="nav-link-text ms-1">Manage User</span>
        </a>
    </li>
<?php endif; ?>


<?php if ($_SESSION['role'] === 'receptionist'): ?>
    <li class="nav-item">
        <a class="nav-link" href="?a=patients">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-users text-warning text-sm opacity-10"></i> <!-- Users icon for managing patients -->
            </div>
            <span class="nav-link-text ms-1">Manage Patients</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=appointments">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calendar-check text-success text-sm opacity-10"></i> <!-- Calendar check icon for managing appointments -->
            </div>
            <span class="nav-link-text ms-1">Manage Appointments</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="?a=billing">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-credit-card text-info text-sm opacity-10"></i> <!-- Credit card icon for billing management -->
            </div>
            <span class="nav-link-text ms-1">Billing Management</span>
        </a>
    </li>


 

   
<?php endif; ?>


        
        
    
        
        <li class="nav-item">
          <a class="nav-link " href="?logout=1">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
        
       
      
      </ul>
    </div>

  </aside>