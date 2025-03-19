<?php
$servername = "";
$username = "u782566612_admin";
$password = "Yoanone@2024";
$dbname = "u782566612_cms_crm";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection failed:" . mysqli_connect_error());
    
}
else{
    echo '';
}


?>