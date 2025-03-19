<?php

$user_role = $_SESSION["user_role"];
?>
<div class="row sidebar">
     <div class=" pt-3 px-4">
         <ul style="list-style-type: none; color:white;">
               <li> 
                 <a href="http://localhost/crm1/admin-dashboard.php">Dashboard</a>
               </li>
               <?php if ($user_role == 'admin') {?>
               <li>
                 <a href=""  data-toggle="modal" data-target="#exampleModal">Add User</a>
               </li>

               <li>
                 <a href="#"  data-toggle="modal" data-target="#viewUserModal">View User</a>
               </li>

               <li>       
                 <a href="#" data-toggle="modal" data-target="#addCampExcelModal">Upload Campaign</a>
               </li>
               <?php } ?>
               <li>
                    <a href="#"   data-toggle="modal" data-target="#downloadDataModal">Download all data</a>
               </li>
                    
          </ul>
         
     </div>
</div>
   