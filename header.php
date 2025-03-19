<?php
   include('session.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Yoan One CMS</title>
      <link rel="icon" href="http://localhost/crm1/page-title-logo.jpg" type="image/x-icon"/>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.min.css"> -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     
     
      <style>
 
         @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

         body {
            font-family: "Poppins", sans-serif;
         }

         @media screen and (min-width: 992px) {
            .td-wrap {
               width: 507px;
               height: 100px;
               
      }
         }
         /* Table content styling */
         .table-content {
         font-size: 14px !important;
         }
         th, td {
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
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
         .badge {
         width: 70% !important;
         }
        /* a {
         font-size: 14px;  
        } */
        .navbar {
  
         padding: .1rem 1rem;
        }
      
      /* pagination links starts  */
      
      .page-link {
   
               color: #0F8EB6;
               background-color: #fff;
               border: 1px solid #dee2e6;
               }
      .page-item.active .page-link {
               z-index: 3;
               color: #fff;
               background-color: #0F8EB6;
               border-color: #0F8EB6;
               }
            
      /* pagination links ends  */

         /* subnav tab starts */
         .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
         color: #fff;
         background-color: #0F8EB6 !important;
         border-color: #dee2e6 #dee2e6 #fff;
      }
      a{
                  color: #0F8EB6;
                  text-decoration: none;
                  background-color: transparent;
      }
   /* subnav tab ends */

/* Default styling for list-group items */

.list-group {
   border-radius: none;
   
}
.list-group-item {
    transition: all 0.3s ease; /* Smooth transition for hover effects */
    padding: .45rem 1rem;
    border-radius: 0 !important;
}

/* Hover effect styling */
.list-group-item:hover {
    background-color: #0F8EB6; /* Change background color on hover */
    color: #fff; /* Change text color on hover */
    border-radius: 4px; /* Optionally add rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optionally add shadow */
}

.modal-header {
   background-color: #0F8EB6 !important; 
   color: white !important;
}

/* Sidebar Styling */
.sidebar {
            background-color: #0F8EB6;
            height: 100%;
            border-right: 1px solid #dee2e6;
            padding: 0;
            color: white;
            display: block;                     
         }
       
        .sidebar a {
            color: white;
            text-decoration: none;
            
        }
        .sidebar a:hover {
            background-color: #FFFFFF;
            border-radius: 4px;
            padding: 10px;
            color: #0F8EB6;
            display: block;
        }
        .sidebar ul {
            padding-left: 0;
            list-style-type: none;
        }
        .sidebar li {
            margin-bottom: 10px;
        }
        /* Main Content Styling */
    
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: auto;
                height: auto;
                position: relative;
                border-right: none;
            }
            .content {
                margin-left: 0;
            }
        } 

      /* .td-wrap {
         width: 547px;
    height: 100px;"
      } */
       
      
      </style>
    
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <a class="navbar-brand" href="#"><img src="http://localhost/crm1/logo.png" width="60%" alt=""></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarText">
            <div class="container-fluid">
            </div>
            <span class="navbar-text">
            <a href="http://localhost/crm1/logout.php">
           <div class="d-flex justify-content-center align-items-center">
           <?php
            echo $_SESSION['username'];
            ?>
           <i class="bi bi-box-arrow-right mx-2"  style="color: #FFFFFF; font-size: 25px;"></i>
           
           </div>
         </a>
            </span>
         </div>
      </nav>