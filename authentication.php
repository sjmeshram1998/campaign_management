<?php
session_start();
include('database.php');

if (isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare SQL statement
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Execute statement
        mysqli_stmt_execute($stmt);

        // Get result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);
            
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables
                $_SESSION["username"] = $row['username'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["user_role"] = $row['role'];

                // Redirect to admin dashboard
                header("Location: http://localhost/crm1/admin-dashboard.php");
                exit;
            } else {
                // Invalid password
                echo '<script>
                        window.location.href= "http://localhost/crm1/login.php";
                        alert("Invalid Credentials");
                      </script>';
            }
        } else {
            // Username not found
            echo '<script>
                    window.location.href= "http://localhost/crm1/login.php";
                    alert("Invalid Credentials");
                  </script>';
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
