<?php
   session_start();
       include('database.php');  
   ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <script language="javascript" type="text/javascript">
         window.history.forward();
      </script>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <title>Login</title>
      <style>
         .form_style {
         background-color: white; 
         padding: 0 3%; margin-top: 4%; 
         border-radius: 10px; 
         border: 1px solid gray;
         }
      </style>
   </head>
   <body style="background: #bad2f5">
      <div class="container-fluid" style="margin-top: 4%;">
         <div class="d-flex justify-content-center align-items-center">
            <form action="http://localhost/crm1/authentication.php" name="loginForm"  method = "POST" class="form_style"  style="">
               <center>
               <img src="http://localhost/crm1/logo1.jpg" class="img-responsive" width="65%" align="center" style="margin: 30px 10px 0px 10px;" alt="">
               </center>
               <br><br>
               <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
               </div>
               <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
               </div>
               <center>
                  <button type="submit" name="submit" style="padding: 10px 20px 10px 20px; background-color: #b1070d; color: white; margin: 20px 20px; font-weight: 500;" class="btn">SUBMIT</button>
               </center>
            </form>
         </div>
      </div>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         
         
         -->
   </body>
</html>