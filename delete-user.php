<?php
session_start();
include('database.php');

// Ensure 'id' is set and use it directly
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Directly use the ID (not recommended for production)

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM user WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Set session variable to show alert
        $_SESSION['showDeleteAlert'] = true;
    } else {
        die("Query Unsuccessful.");
    }

    mysqli_close($conn);

    // Redirect to the admin dashboard
    header('Location: http://localhost/crm1/admin-dashboard.php');
    exit(); // Ensure no further code is executed
} else {
    die("No ID specified.");
}
?>
