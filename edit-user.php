<?php
include('database.php'); // Ensure this file includes your database connection
session_start();

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    // $password = md5($_POST['password']);
    $role = $_POST['role'];

        $sql = "UPDATE user SET username= '$username', email='$email', role='$role' WHERE id= '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {    
           $_SESSION['showUpdateAlert'] = true;
          header("Location: http://localhost/crm1/admin-dashboard.php");
       
     

         exit;
     } else {
         // Error handling
         echo "Error: " . mysqli_error($conn);
     }
     
  
}

mysqli_close($conn);
?>