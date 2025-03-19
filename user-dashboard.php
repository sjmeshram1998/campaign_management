
<?php include('header.php'); ?>

<style>

.sidebar {
background-color: #084298; 
height: 90vh;
border-right: 1px solid #dee2e6;
}
.table td {
   text-align: center;   
}
.badge {
   padding: 0.80em .5em !important;
   font-size: 80% !important;
}

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        .select2-container .select2-search--inline .select2-search__field {
 
  
  
    height: 28px !important;
   
}

    </style>
   
   
      <div class="container-fluid" style="">
         <!-- Navigation bar -->
         <!-- Page content -->
         <div class="col-md-12" style=" margin: 0px; padding: 0px">
         <?php
         
       
         include('main-content.php');
         ?>
           
         </div>
      </div>
     

      
 






      <!-- CAMPAIGN STARTS -->

    <!-- *********************************************************************************** -->
       
 










    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
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
<script>
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

    </script>
<!-- ADD CAMPAIGN SCRIPT ENDS -->



   </body>
</html>