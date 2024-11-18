<?php
 require_once "../model/function.php"; 
  $Call = new  mainClass();
 

  if (isset($_GET['getdata'])) {

    // Database connection
    $conn = mysqli_connect($Call->host, $Call->user, $Call->password, $Call->DB);

    // Get patient data from the URL (format: first_name_last_name_dob)
    $PatientData = explode('_', $_GET['getdata']);
    $firstname = $PatientData[0];
    $lastname = isset($PatientData[1]) ? $PatientData[1] : ''; // Ensure last name exists
    $dob = isset($PatientData[2]) ? $PatientData[2] : ''; // Ensure dob exists

    // Build the query dynamically
    $query = "SELECT * FROM patients WHERE 1=1"; // Base query
    $params = [];
    $types = '';

    // Add conditions based on the provided input
    if (!empty($firstname)) {
        $query .= " AND first_name LIKE ?";
        $params[] = '%' . $firstname . '%';
        $types .= 's';
    }
    if (!empty($lastname)) {
        $query .= " AND last_name LIKE ?";
        $params[] = '%' . $lastname . '%';
        $types .= 's';
    }
    if (!empty($dob)) {
        $query .= " AND date_of_birth = ?";
        $params[] = $dob;
        $types .= 's';
    }

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        if (!empty($params)) {
            // Bind parameters dynamically
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        // Check if results exist
        if ($result->num_rows > 0) {
            // Output the result rows
            $counter = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>
                        <td>' . $counter++ . '</td>
                        <td>' . $row["first_name"] . ' ' . $row["last_name"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["phone_number"] . '</td>
                        <td>' . $row["date_of_birth"] . '</td>
                        <td>
                            <a href="?a=view_patient&id=' . $row["patient_id"] . '" class="btn btn-warning">View</a>
                           
                        </td>
                      </tr>';
            }
        } else {
            // If no matching results
            echo '<tr><td colspan="6" class="text-center">No patients found matching your search criteria.</td></tr>';
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the query
        echo "Error preparing the query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

