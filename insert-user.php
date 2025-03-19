<?php
include('database.php'); // Ensure this file includes your database connection
session_start();

if (isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Use bcrypt for password hashing
    $role = trim($_POST['role']);

    // Check if username or email already exists
    $checkSql = "SELECT id FROM user WHERE username = ? OR email = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);

    if ($checkStmt) {
        // Bind parameters and execute statement
        mysqli_stmt_bind_param($checkStmt, "ss", $username, $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
              $_SESSION['showAlertUserExist'] = true;
              header("Location: http://localhost/crm1/admin-dashboard.php");
            
        } else {
            // Prepare SQL statement for insertion
            $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $role);

                // Execute statement
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['showAlert'] = true;
                    header("Location: http://localhost/crm1/admin-dashboard.php");
                    exit;
                } else {
                    // Error handling
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                // Error preparing statement
                echo "Error preparing statement: " . mysqli_error($conn);
            }
        }

        // Close check statement
        mysqli_stmt_close($checkStmt);
    } else {
        // Error preparing check statement
        echo "Error preparing check statement: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
