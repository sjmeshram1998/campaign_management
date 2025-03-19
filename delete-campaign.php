<?php
session_start();
include('database.php');

// Check if communication_id is provided in the URL
if (isset($_GET['id'])) {
    // Get the id from the URL and sanitize it
    $id = $_GET['id'];
    
    // Prepare the SQL statement to prevent SQL injection
    $sql = "DELETE FROM campaign_details WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Successful deletion
            $_SESSION['showDeleteCamp'] = true;
            header("Location: http://localhost/crm1/admin-dashboard.php");
            exit();
        } else {
            // Error executing statement
            die("Error executing query: " . mysqli_stmt_error($stmt));
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the statement
        die("Error preparing statement: " . mysqli_error($conn));
    }
} else {
    $_SESSION['showDeleteCampFailure'] = true;
            header("Location: http://localhost/crm1/admin-dashboard.php");
            exit();
    
}

// Close the database connection
mysqli_close($conn);
?>
