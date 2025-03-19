<?php
include('database.php'); // Ensure this file includes your database connection
// $showAlert = false;
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

        $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
         // Registration successful
         // $showAlert = true;
         // Redirect to login page or show success message
         header("Location: http://localhost/crm1/login.php");
         exit;
     } else {
         // Error handling
         echo "Error: " . mysqli_error($conn);
     }
     
  
}

mysqli_close($conn);
?>