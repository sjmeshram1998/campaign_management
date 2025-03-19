<?php 
            if(isset($_SESSION['showAlert']) && $_SESSION['showAlert']) {
              echo '<div class="alert alert-success" role="alert">
            User has been successfully added
            
              </div>';
              $_SESSION['showAlert'] = false; // Reset showAlert session variable
            }
            ?>

            <!-- User already exists starts -->

            <?php 
            if(isset($_SESSION['showAlertUserExist']) && $_SESSION['showAlertUserExist']) {
              echo '<div class="alert alert-info" role="alert">
           Username or email already exists. Please choose a different one.
            
              </div>';
              $_SESSION['showAlertUserExist'] = false; // Reset showAlert session variable
            }
            ?>
            <!-- User already exists ends -->

         <!-- show update alert starts -->
         <?php
            if(isset($_SESSION['showUpdateAlert']) && $_SESSION['showUpdateAlert']){
              echo '<div class="alert alert-info">
              <strong>User information has been successfully updated</strong>
            </div>';
            $_SESSION['showUpdateAlert'] = false;
            }
            ?> 
         <!-- show update alert ends -->

         <!-- show delete alert starts -->
         <?php
            if(isset($_SESSION['showDeleteAlert']) && $_SESSION['showDeleteAlert']){
              echo '<div class="alert alert-danger">
              <strong>User  has been successfully deleted.</strong>
            </div>';
            $_SESSION['showDeleteAlert'] = false;
            }
            ?> 
         <!-- show delete alert ends -->

         <!-- campagin code already exists starts -->
         <?php
            if(isset($_SESSION['showCampErrorAlert']) && $_SESSION['showCampErrorAlert']){
              echo '<div class="alert alert-warning">
              <strong>Communication id  already exists!</strong>
            </div>';
            $_SESSION['showCampErrorAlert'] = false;
            }
            ?> 
         <!-- campagin code already exists ends -->

         <!-- New campagien added successfully starts -->
         <?php
            if(isset($_SESSION['showCampAddAlert']) && $_SESSION['showCampAddAlert']){
              echo '<div class="alert alert-success">';
              echo htmlspecialchars($_SESSION['showCampAddAlert']); // Output the alert message
              echo '</div>';
              // Unset the session variable after displaying it
              unset($_SESSION['showCampAddAlert']);

            }
            ?> 

         <!-- New campagien added successfully ends -->
         <!-- camp update through excel -->
         <?php
            if(isset($_SESSION['showCampUpdateAlert']) && $_SESSION['showCampUpdateAlert']){
              echo '<div class="alert alert-success">';
              echo htmlspecialchars($_SESSION['showCampUpdateAlert']); // Output the alert message
              echo '</div>';
              // Unset the session variable after displaying it
              unset($_SESSION['showCampUpdateAlert']);

            }
            ?> 
                    <!--  ends -->
         <!-- campaign deletes successfully starts -->
         <?php
            if(isset($_SESSION['showDeleteCamp']) && $_SESSION['showDeleteCamp']){
              echo '<div class="alert alert-danger">
              <strong>Campaign deleted successfully</strong>
            </div>';
            $_SESSION['showDeleteCamp'] = false;
            }
            ?> 

         <?php
            if(isset($_SESSION['showDeleteCampFailure']) && $_SESSION['showDeleteCampFailure']){
              echo '<div class="alert alert-danger">
              <strong>No campaign code specified.</strong>
            </div>';
            $_SESSION['showDeleteCampFailure'] = false;
            }
            ?> 

             <!-- campaign update successfully starts -->
             <?php
            if(isset($_SESSION['showUpdateCampAlert']) && $_SESSION['showUpdateCampAlert']){
              echo '<div class="alert alert-info">
              <strong>Campaign Updated successfully</strong>
            </div>';
            $_SESSION['showUpdateCampAlert'] = false;
            }
            ?> 
            
         <!-- campaign update successfully ends -->

         <!-- Show update alert failure starts -->
         <?php
            if(isset($_SESSION['showUpdateCampAlertFailure']) && $_SESSION['showUpdateCampAlertFailure']){
              echo '<div class="alert alert-info">
              <strong>Campaign Updated Error</strong>
            </div>';
            $_SESSION['showUpdateCampAlertFailure'] = false;
            }
            ?>
         <!-- Show update alert failure ends -->

          <!-- Update alert invalid starts -->
          <?php
            if(isset($_SESSION['showUpdateCampAlertInvalid']) && $_SESSION['showUpdateCampAlertInvalid']){
              echo '<div class="alert alert-info">
              <strong>Invalid  ID</strong>
            </div>';
            $_SESSION['showUpdateCampAlertInvalid'] = false;
            }
            ?>
            <!-- Update alert invalid ends -->