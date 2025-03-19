<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <title>Register</title>
      <style>
         .form_style {
         background-color: white; 
         padding: 3%; 
         border-radius: 10px; 
         border: 1px solid gray;
         }
      </style>
   </head>
   <body style="background: #084298">
      <div class="container-fluid" style="margin-top: 6%;">
      <div class="d-flex justify-content-center align-items-center">
         <form action="http://localhost/crm1/signup.php" name="signUpForm"  method = "POST" class="form_style" autocomplete="off">
            <div class="">
               <center>
                  <img src="http://localhost/crm1/logo1.jpg" class="img-fluid" align="center" style="margin: 30px 10px 0px 10px;" alt="">
               </center>
            </div>
            <br>
            <div class="mb-3">
               <label for="username" class="form-label">Username</label>
               <input type="text" class="form-control" id="username" name="username" autocomplete="new-username" pattern="[a-zA-Z0-9_]{5,15}" title="Username must be 5 to 15 characters long and can only contain letters, numbers, and underscores." required>
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="password" name="password" class="form-control" autocomplete="new-password"  id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 characters." required >
            </div>
            <center>
               <button type="submit" name="submit" style="padding: 10px 20px 10px 20px; background-color: #084298; color: white; margin: 20px 20px;" class="btn" >Register</button>
            </center>
         </form>
      </div>
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   </body>
</html>