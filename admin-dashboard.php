
<?php include('header.php');
   $user_role = $_SESSION["user_role"]; ?>
<div class="container-fluid">
   <!-- Navigation bar -->
   <!-- Page content -->
   <div class="row">
      <div class="col-md-2">
         <?php
            include('sidebar.php');
            
            ?>
      </div>
      <div class="col-md-10">
         <?php
            include('main-content.php');
            ?>
      </div>
   </div>
</div>




<!-- VIEW USERS STARTS -->
<div class="modal fade " id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #0F8EB6; color: white;">
            <h5 class="modal-title" id="viewUser">All Users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container-fluid mt-4">
               <?php
                 // Pagination variables
                     $limit = 10; // Number of records per page
                     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                     $offset = ($page - 1) * $limit;

                     // Fetch total number of records
                     $sql_count = "SELECT COUNT(*) as total FROM user";
                     $result_count = mysqli_query($conn, $sql_count);
                     $row_count = mysqli_fetch_assoc($result_count);
                     $total_records = $row_count['total'];
                     $total_pages = ceil($total_records / $limit);

                     // Fetch records for the current page
                     $sql = "SELECT * FROM user LIMIT {$offset}, {$limit}";
                     $result = mysqli_query($conn, $sql) or die("Query Failed");

                     // Fetch data and render table
                     if(mysqli_num_rows($result) > 0) {
                                       
                  ?>
               <table class="table table-lg table-bordered table-responsive">
                  <thead >
                     <tr>
                        <th scope="col" style="padding-left:43px !important; padding-right:43px !important;">ID</th>
                        <th scope="col" style="padding-left:43px !important; padding-right:43px !important;">Username</th>
                        <th scope="col" style="padding-left:43px !important; padding-right:43px !important;">Email</th>
                        <th scope="col" style="padding-left:43px !important; padding-right:43px !important;">Role</th>
                        <th scope="col" style="padding-left:43px !important; padding-right:43px !important;" colspan="2">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php                              
                        while($row = mysqli_fetch_assoc($result)){
                        
                        
                        ?>
                     <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td>
                           <a href="#" class="btn btn-info mx-2 mb-2" data-toggle="modal" data-target="#editUserModal" 
                              data-id="<?php echo $row['id']; ?>" 
                              data-username="<?php echo htmlspecialchars($row['username']); ?>" 
                              data-email="<?php echo htmlspecialchars($row['email']); ?>" 
                              data-role="<?php echo htmlspecialchars($row['role']); ?>">Edit</a>
                           <a href="delete-user.php?id=<?php echo $row['id'];?>" class ="btn btn-danger mb-2">Delete</a> 
                        </td>
                     </tr>
                     <?php
                        }
                        ?>
                  </tbody>
               </table>
             <!-- Pagination Controls -->
            <nav aria-label="Page navigation">
               <ul class="pagination">
                  <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                     <a class="page-link" href="?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                     </a>
                  </li>
                  <?php for($i = 1; $i <= $total_pages; $i++) { ?>
                  <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                     <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                  <?php } ?>
                  <li class="page-item <?php if($page >= $total_pages) echo 'disabled'; ?>">
                     <a class="page-link" href="?page=<?php echo ($page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                     </a>
                  </li>
               </ul>
            </nav>

               <?php } ?>

            </div>
         </div>
      </div>
   </div>
</div>
<br><br>
<!-- VIEW USERS ENDS -->
<!--ADD NEW USER STARTS -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color: #0F8EB6; color: white;">
            <h5 class="modal-title" id="exampleModalLabel" >Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="http://localhost/crm1/insert-user.php" name="insertUser"  method = "POST" class="form_style">
               <div class="">
                  <center> <img src="http://localhost/crm1/logo1.jpg" class="img-fluid" style="margin: 30px 10px 0px 10px;" alt=""></center>
               </div>
               <br>
               <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username1" name="username" pattern="[a-z0-9_]{5,15}" title="Username must be 5 to 15 characters long and can only contain letters, numbers, and underscores."  required>
               </div>
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email1" name="email" required>
               </div>
               <div class="mb-3">
                  <label for="password1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password1" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 characters.">
               </div>
               <div class="mb-3">
                  <label for="role"  class="form-label">Role</label>
                  <select name="role" id="role1" class="form-control" required>
                     <option value="" disabled selected>Select Role</option>
                     <option value="admin">admin</option>
                     <option value="user">user</option>
                  </select>
               </div>
               <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                  <button type="submit" name="submit" class="btn" style="background-color: #0F8EB6; color: white;">Add User</button>
               </div>
               <!-- <center>
                  <button type="submit" name="submit" style="padding: 10px 20px 10px 20px; background-color: #084298; color: white; margin: 20px 20px;" class="btn">Register</button>
                  </center> -->
            </form>
         </div>
      </div>
   </div>
</div>
<!-- ADD NEW USER ENDS -->
<!--UPDATE STARTS -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="edit-user.php" name="editUser"  method = "POST" class="form_style">
               <div class="">
                  <img src="http://localhost/crm1/logo1.jpg" class="img-fluid" align="center" style="margin: 30px 10px 0px 10px;" alt="">
               </div>
               <br>
               <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="hidden" name="id" id="id" value="">
                  <input type="text" class="form-control" id="username" name="username" value="" >
               </div>
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="" >
               </div>
               <!-- <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="password" >
                  </div> -->
               <div class="mb-3">
                  <label for="role"  class="form-label">Role</label>
                  <select name="role" id="role" class="form-control">
                     <option value="hidden">Select Role</option>
                     <option value="admin">admin</option>
                     <option value="user" >user</option>
                  </select>
               </div>
               <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                  <button type="submit" name="submit" class="btn" style="background-color: #0F8EB6 !important; 
   color: white !important;">Save Data</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- UPDATE ENDS -->
<!-- CAMPAIGN STARTS -->
<!-- *********************************************************************************** -->
<!-- UPLOAD NEW CAMPAIGN THROUGH EXCEL STARTS -->
<!-- <div class="modal fade" id="addCampExcelModal" tabindex="-1" role="dialog" aria-labelledby="addCampExcelLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" >
            <h5 class="modal-title" id="addCampExcelLabel">Add Campaign Through Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container">
               <div class="card mt-5 p-5" >
                  <br>
                  <h1 >Upload Excel File</h1>
                  <br>
                  <form action="http://localhost/crm1/insert-new-camp.php" method="POST" enctype="multipart/form-data">
                     <input type="file" name="import-file" required class="form-control"><br>
                     <button type="submit" class="btn" name="insert-new-camp">Upload</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->
<!-- UPLOAD NEW CAMPAIGN THROUGH EXCEL ENDS -->
<!-- UP BUTTON STARTS -->
<?php
   include('back-to-top.php');
   ?>
<!-- UP BUTTON ENDS -->
<?php
   include('footer.php');
   ?>
<!-- UPDATE USER SCRIPT STARTS -->
<script>
   $('#editUserModal').on('show.bs.modal', function (event) {
       var button = $(event.relatedTarget); // Button that triggered the modal
       var id = button.data('id');
       var username = button.data('username');
       var email = button.data('email');
       var role = button.data('role');
   
       var modal = $(this);
       modal.find('#id').val(id);
       modal.find('#username').val(username);
       modal.find('#email').val(email);
       modal.find('#role').val(role);
   });
</script>
<!-- UPDATE USER SCRIPT ENDS -->
<!-- ADD CAMPAIGN SCRIPT STARTS -->
<!-- <script>
   document.getElementById('campaignForm').addEventListener('submit', function(event) {
       const startDate = new Date(document.getElementById('camp_start_date').value);
       const endDate = new Date(document.getElementById('camp_end_date').value);
       const leads = document.getElementById('leads').value;
   
   
       if (startDate > endDate) {
           alert('End date must be after the start date.');
           event.preventDefault(); // Prevent form submission
       }
       if (!Number.isInteger(Number(leads)) || Number(leads) < 0) {
           alert('Leads must be a non-negative integer.');
           event.preventDefault(); // Prevent form submission
       }
   });
   
   </script> -->
<!-- ADD CAMPAIGN SCRIPT ENDS -->