<style>
   /* CSS for hiding sections by default */
   .navbar-sections .section {
   display: none;
   }
   /* Highlight color for active navbar link */
   /* .navbar-nav .nav-item.active .nav-link {
   background-color: #0F8EB6;
   color: white;
   } */
   a{
   font-size: 14px !important;
   }
</style>
<!-- SUB HEADER NAVIGATION STARTS-->
<ul class="nav nav-tabs" id="myTab" role="tablist" >
   <li class="nav-item" role="presentation">
      <a class="nav-link <?php echo $section == 'dashboard' ? 'active' : ''; ?>" href="?section=dashboard">Dashboard</a>
   </li>
   <li class="nav-item" role="presentation">
      <a class="nav-link <?php echo $section == 'live' ? 'active' : ''; ?>" href="?section=live">Live</a>
   </li>
   <li class="nav-item" role="presentation">
      <a class="nav-link <?php echo $section == 'duetoday' ? 'active' : ''; ?>" href="?section=duetoday">Due Today</a>
   </li>
   <li class="nav-item" role="presentation">
      <a class="nav-link <?php echo $section == 'overdue' ? 'active' : ''; ?>" href="?section=overdue">Overdue</a>
   </li>
   <li class="nav-item" role="presentation">
      <a class="nav-link <?php echo $section == 'complete' ? 'active' : ''; ?>" href="?section=complete">Completed</a>
   </li>
</ul>
<!-- SUB HEADER NAVIGATION ENDS -->
<!-- DASHBOARD SECTION STARTS -->
<div class="mt-4" id="viewDashboard" style="<?php echo htmlspecialchars($section) == 'dashboard' ? 'display: block;' : 'display: none;'; ?>">
   <div class="col-md-3">
      <form class="d-flex" role="search" id="searchForm" method="GET" action="">
         <input class="form-control me-2" id="search" name="search" type="search" placeholder="Search by Campaign Code:" aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
      </form>
   </div>
   <br>
   <?php
   // Pagination logic
   $limit = 30;
   $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
   $offset = ($page - 1) * $limit;

   // Check if a search term exists
   $search_query = '';
   $search_param = '';
   $search_value = '';
   if (isset($_GET['search'])) {
      $search_value = mysqli_real_escape_string($conn, $_GET['search']);
      $search_query = "WHERE camp_code LIKE ?";
      $search_param = "%$search_value%";
   }

   // Fetch the records with pagination
   $sql = "SELECT * FROM campaign_details $search_query ORDER BY created_at DESC LIMIT ?, ?";
   $stmt = $conn->prepare($sql);
   if ($stmt) {
      if ($search_query) {
         $stmt->bind_param('sii', $search_param, $offset, $limit);
      } else {
         $stmt->bind_param('ii', $offset, $limit);
      }
      $stmt->execute();
      $result = $stmt->get_result();
   }

   // Total records count
   $count_sql = "SELECT COUNT(*) as total FROM campaign_details $search_query";
   $count_stmt = $conn->prepare($count_sql);
   if ($count_stmt) {
      if ($search_query) {
         $count_stmt->bind_param('s', $search_param);
      }
      $count_stmt->execute();
      $count_result = $count_stmt->get_result();
      $total_records = $count_result->fetch_assoc()['total'];
   }
   $total_page = ceil($total_records / $limit);
   ?>

   <table class="table table-sm table-bordered table-content table-responsive text-center" id="viewCampTable">
      <thead>
         <tr class="">
            <!-- Table headers -->
            <th scope="col" style="display: none;">Primary Id</th>
            <th scope="col">Campaign Code</th>
            <th scope="col">Communication ID</th>
            <th scope="col">Channel ID</th>
            <th scope="col" >File No</th>
            <th scope="col">Quarter</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Date Added</th>
            <th scope="col">End Date</th>
            <th scope="col">Campaign Status</th>
            <th scope="col">Delivery Days</th>
            <th scope="col">Lead Goal</th>
            <th scope="col">Weekly Leads</th>
            <th scope="col">Delivered Lead</th>
            <th scope="col">Pending Lead</th>
            <th scope="col">Generated Lead</th>
            <th scope="col">Undelivered Lead</th>
            <th scope="col">Extra Lead</th>
            <th scope="col" style="display: none;">Named Account</th>
            <th scope="col" style="display: none;">Exclusions</th>
            <th scope="col">First Delivery Date</th>
            <th scope="col" style="display: none;">Country</th>
            <th scope="col" style="display: none;">Company Size</th>
            <th scope="col" style="display: none;">Job Titles</th>
            <th scope="col" style="display: none;">Job Level</th>
            <th scope="col" style="display: none;">Industry</th>
            <th scope="col" style="display: none;">Custom Question</th>
            <th scope="col" style="display: none;">Notes</th>
            <th scope="col" style="display: none;">Durations</th>
           
            <th scope="col">Action</th>
      
         </tr>
      </thead>
      <tbody>
         <?php while ($row = mysqli_fetch_assoc($result)) { ?>
         <tr class="">
            <!-- Table data -->                                      
            <th scope="col" style="display: none;"><?php echo htmlspecialchars($row['id']); ?></th>   

            <!-- <td><?php echo htmlspecialchars($row['camp_code']); ?></td> -->
            <td>
            <a href="#" class="view-details" data-id="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['camp_code']); ?></a></td>


            <!-- <td>
               <a href="#" data-toggle="modal" data-target="#viewSubModal" data-communication-id="<?php echo htmlspecialchars($row['communication_id']); ?>">
               <?php echo htmlspecialchars($row['communication_id']); ?>
               </a>
            </td> -->
            <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
            <td><?php echo $row['channel_id'] ?></td>
            <td ><?php echo $row['file_no'] ?></td>
            <td><?php echo $row['quarter'] ?></td>
            <td><?php echo $row['camp_name'] ?></td>
            <td><?php echo $row['camp_start_date'] ?></td>
            <td><?php echo $row['camp_end_date'] ?></td>
            <td >
               <?php
                  $status = $row['camp_status'];
                  
                  // Apply different background classes based on status
                  $badgeClass = '';
                  switch ($status) {
                      case 'Pending':
                          $badgeClass = 'bg-danger text-white'; // Using Bootstrap class
                          break;
                      case 'Live':
                          $badgeClass = 'bg-info text-white'; // Using Bootstrap class
                          break;
                      case 'Completed':
                          $badgeClass = 'bg-success text-white'; // Using Bootstrap class
                          break;
                      default:
                          $badgeClass = 'bg-secondary text-white'; // Default class
                  }
                  ?>
               <span class="badge badge-pill <?php echo $badgeClass; ?>">
               <?php echo htmlspecialchars($status); ?>
               </span>
            </td>
            <td><?php echo $row['delivery_days'] ?></td>
            <td><?php echo $row['lead_goal'] ?></td>
            <td><?php echo $row['weekly_lead'] ?></td>
            <td><?php echo $row['delivered_lead'] ?></td>
            <td><?php echo $row['pending_lead'] ?></td>
            <td><?php echo $row['generated_lead'] ?></td>
            <td><?php echo $row['undelivered_lead'] ?></td>
            <td><?php echo $row['extra_lead'] ?></td>
            <td style="display: none;"><?php echo $row['named_acc'] ?></td>
            <td style="display: none;"><?php echo $row['exclusions'] ?></td>
            <td><?php echo $row['first_delivery_date'] ?></td>
            <td style="display: none;">
               <textarea readonly name="country" id="" rows="5" col="6"><?php echo $row['country'] ?></textarea>
            </td>
            <td style="display: none;">
               <?php echo $row['company_size'] ?>
            </td>
            <td style="display: none;"> 
               <textarea readonly name="job_title" rows="5" col="6"><?php echo $row['job_title'] ?></textarea>
            </td>
            <td style="display: none;">
               <textarea readonly name="job_level"  rows="5" col="6"><?php echo $row['job_level'] ?>
               </textarea>
            </td>
            <td style="display: none;">
               <textarea readonly name="industry"  rows="5" col="6"><?php echo $row['industry'] ?></textarea>
            </td>
            <td style="display: none;">
               <textarea readonly name="custm_que"  rows="5" col="6"><?php echo $row['custm_que'] ?></textarea>
            </td>
            <td style="display: none;">
               <textarea readonly name="notes"  rows="5" col="6"><?php echo $row['notes'] ?></textarea>
            </td>
            <td style="display: none;"><?php echo $row['duration'] ?></td>
            <td style="" class="d-flex justify-content-center align-items-center">
              
               <!-- <a href="http://localhost/crm1/download_record_excel.php?communication_id=<?php echo urlencode($row['communication_id']); ?>" class="btn  btn-primary mx-2">Download Record</a>
                  <form action="http://localhost/crm1/upload_edited_excel.php" method="post" enctype="multipart/form-data">
                     <input type="file" name="import-file" accept=".xlsx, .xls" required>
                     <input type="hidden" name="original_communication_id" value="<?php echo htmlspecialchars($row['communication_id']); ?>">
                     <button type="submit" value="Upload" class="btn btn-info">Upload and Update</button>
                  </form>  -->
               <a href="#" 
                  class="btn btn-sm btn-info mx-2 " 
                  data-toggle="modal" data-target="#editCampModal"
                  data-id="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-communication_id="<?php echo htmlspecialchars($row['communication_id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_code="<?php echo htmlspecialchars($row['camp_code'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_name="<?php echo htmlspecialchars($row['camp_name'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_start_date="<?php echo htmlspecialchars($row['camp_start_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_end_date="<?php echo htmlspecialchars($row['camp_end_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-first_delivery_date="<?php echo htmlspecialchars($row['first_delivery_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivery_days="<?php echo htmlspecialchars($row['delivery_days'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-lead_goal="<?php echo htmlspecialchars($row['lead_goal'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-weekly_lead="<?php echo htmlspecialchars($row['weekly_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivered_lead="<?php echo htmlspecialchars($row['delivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-undelivered_lead="<?php echo htmlspecialchars($row['undelivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-pending_lead="<?php echo htmlspecialchars($row['pending_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-extra_lead="<?php echo htmlspecialchars($row['extra_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-generated_lead="<?php echo htmlspecialchars($row['generated_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_status="<?php echo htmlspecialchars($row['camp_status'], ENT_QUOTES, 'UTF-8'); ?>"> 
               Edit </a>
               <?php if ($user_role == 'admin') { ?>
               <a href="http://localhost/crm1/delete-campaign.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Are you sure you want to delete this campaign?');">Delete</a>
               <?php } ?>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
 
   <br>
 <!-- Pagination Links -->
<div class="container">
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search_value); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_value); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_page): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search_value); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>

</div>
<!-- DASHBOARD SECTION ENDS  -->

 <!-- ############################################################################## -->

<!-- VIEW LIVE SECTION STARTS  -->

<div class="mt-4" id="viewLive" style="<?php echo htmlspecialchars($section) == 'live' ? 'display: block;' : 'display: none;'; ?>">
    <div class="col-md-3">
        <form class="d-flex" role="search" id="searchLiveForm" method="GET" action="">
            <input class="form-control me-2" id="searchLive" name="searchLive" type="search" placeholder="Search by Campaign Code:" aria-label="Search" value="<?php echo isset($_GET['searchLive']) ? htmlspecialchars($_GET['searchLive']) : ''; ?>">
            <input type="hidden" name="section" value="live">
        </form>
    </div>
    <br>
    <?php
    $limit = 30; // Number of records per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    
    $searchLive = isset($_GET['searchLive']) ? mysqli_real_escape_string($conn, $_GET['searchLive']) : '';
    $searchLiveQuery = $searchLive ? " AND camp_code LIKE ?" : '';
    
    // SQL query to fetch records
    $live_sql = "SELECT 
                  *
                 FROM campaign_details 
                 WHERE camp_status = 'live'
                 $searchLiveQuery
                 LIMIT ?, ?"; 
    
    $stmt = $conn->prepare($live_sql);
    if ($stmt) {
        if ($searchLive) {
            $searchLiveParam = "%$searchLive%";
            $stmt->bind_param('sii', $searchLiveParam, $offset, $limit);
        } else {
            $stmt->bind_param('ii', $offset, $limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        die("Failed to prepare SQL statement.");
    }
    
    // Count total records for pagination
    $count_sql = "SELECT COUNT(*) as total FROM campaign_details WHERE camp_status = 'live' $searchLiveQuery";
    $count_stmt = $conn->prepare($count_sql);
    if ($count_stmt) {
        if ($searchLive) {
            $count_stmt->bind_param('s', $searchLiveParam);
        }
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $total_records = $count_result->fetch_assoc()['total'];
    } else {
        die("Failed to prepare SQL statement for counting records.");
    }
    
    $total_page = ceil($total_records / $limit);
    ?>
    
    <!-- Table to display data -->
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <table class="table table-sm table-bordered table-content table-responsive text-center" id="dueTodayTable">
        <thead>
            <tr>
                <th scope="col" style="display: none;">Primary Id</th>
                <th scope="col">Campaign Code</th>
                <th scope="col">Communication ID</th>
                <th scope="col">Channel ID</th>
                <th scope="col">Campaign Name</th>
                <th scope="col">Date Added</th>
                <th scope="col">Campaign End Date</th>
                <th scope="col">Campaign Status</th>
                <th scope="col">Delivery Days</th>
                <th scope="col">First Delivery Date</th>
                <th scope="col">Lead Goal</th>
                <th scope="col">Weekly Leads</th>
                <th scope="col">Delivered Lead</th>
                <th scope="col">Pending Lead</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
            <th scope="col" style="display: none;"><?php echo htmlspecialchars($row['id']); ?></th>   

           
            <td>
            <a href="#" class="view-details" data-id="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['camp_code']); ?></a></td>

              
                <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
                <td><?php echo htmlspecialchars($row['channel_id']); ?></td>
                <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
                <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
                <td><span class="badge badge-pill badge-danger"><?php echo htmlspecialchars($row['camp_status']); ?></span></td>
                <td><?php echo htmlspecialchars($row['delivery_days']); ?></td>
                <td><?php echo htmlspecialchars($row['first_delivery_date']); ?></td>
                <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
                <td><?php echo htmlspecialchars($row['weekly_lead']); ?></td>
                <td><?php echo htmlspecialchars($row['delivered_lead']); ?></td>
                <td><?php echo htmlspecialchars($row['pending_lead']); ?></td>
               
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No Live Campaigns Found.</p>
    <?php endif; ?>
    
    <!-- Pagination Links -->
    <div class="container">
        <ul class="pagination">
            <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>&searchLive=<?php echo urlencode($searchLive); ?>&section=live" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>&searchLive=<?php echo urlencode($searchLive); ?>&section=live">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>
            
            <?php if ($page < $total_page): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>&searchLive=<?php echo urlencode($searchLive); ?>&section=live" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!-- ############################################################################## -->


<!-- DUE TODAY SECTION STARTS -->
<div class="mt-4" id="viewDuetoday" style="<?php echo htmlspecialchars($section) == 'duetoday' ? 'display: block;' : 'display: none;'; ?>">
   <div class="col-md-3">
      <form class="d-flex" role="search" id="searchDuetodayForm" method="GET" action="">
         <input class="form-control me-2" id="searchDuetoday" name="searchDuetoday" type="search" placeholder="Search by Campaign Code:" aria-label="Search" value="<?php echo isset($_GET['searchDuetoday']) ? htmlspecialchars($_GET['searchDuetoday']) : ''; ?>">
         <input type="hidden" name="section" value="duetoday">
      </form>
   </div>
   <br>
   <?php
      $limit = 30; // or any other number you prefer

      // Calculate the total number of pages (ensure you have $total_records from the total count query)
      $total_page = ceil($total_records / $limit);

      // Determine the current page from the query parameter, default to 1 if not set
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

      // Ensure the page number is within the valid range
      $page = max(1, min($total_page, $page));

      // Calculate the offset for the SQL query
      $offset = ($page - 1) * $limit;

      // Current date
      $current_date = date('Y-m-d');

      // Get search term and escape it for SQL
      $searchDuetoday = isset($_GET['searchDuetoday']) ? mysqli_real_escape_string($conn, $_GET['searchDuetoday']) : '';
      $searchDuetodayQuery = $searchDuetoday ? " AND camp_code LIKE '%$searchDuetoday%'" : '';

      // SQL query to select campaigns due today
      $duetoday_sql = "
          SELECT * 
          FROM 
              campaign_details
          WHERE 
              CURDATE() BETWEEN camp_start_date AND camp_end_date
              AND camp_status = 'Live'
              AND (
                 
                  (first_delivery_date = CURDATE())
                  OR
                
                  (first_delivery_date < CURDATE() 
                      AND FIND_IN_SET(DAYNAME(CURDATE()), delivery_days) > 0)
              )
          $searchDuetodayQuery
          ORDER BY 
              CASE 
                  WHEN first_delivery_date = CURDATE() THEN 1
                  ELSE 2
              END
          LIMIT $offset, $limit
      ";

      // Execute the query
      $result = mysqli_query($conn, $duetoday_sql);

      // Check for query errors
      if (!$result) {
          echo "Error: " . mysqli_error($conn);
      } else {
          if (mysqli_num_rows($result) > 0) {
   ?>
   <!-- Table to display data -->
   <table class="table table-sm table-bordered table-content table-responsive text-center" id="dueTodayTable">
      <thead>
         <tr><th scope="col" style="display: none;">Primary Id</th>
            <th scope="col">Campaign Code</th>
            <th scope="col">Communication ID</th>
            <th scope="col">Channel ID</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Date Added</th>
            <th scope="col">Campaign End Date</th>
            <th scope="col">Campaign Status</th>
            <th scope="col">Delivery Days</th>
            <th scope="col">First Delivery Date</th>
            <th scope="col">Lead Goal</th>
            <th scope="col">Weekly Leads</th>
            <th scope="col">Delivered Lead</th>
            <th scope="col">Pending Lead</th>
            <!-- <th scope="col">Action</th> -->
         </tr>
      </thead>
      <tbody>
         <?php while ($row = mysqli_fetch_assoc($result)) { ?>
         <tr>
         <th scope="col" style="display: none;"><?php echo htmlspecialchars($row['id']); ?></th>   

           
            <td>
            <a href="#" class="view-details" data-id="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['camp_code']); ?></a></td>


            
            <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
            <td><?php echo htmlspecialchars($row['channel_id']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
            <td><span class="badge badge-pill badge-danger"><?php echo htmlspecialchars($row['camp_status']); ?></span></td>
            <td><?php echo htmlspecialchars($row['delivery_days']); ?></td>
            <td><?php echo htmlspecialchars($row['first_delivery_date']); ?></td>
            <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
            <td><?php echo htmlspecialchars($row['weekly_lead']); ?></td>
            <td><?php echo htmlspecialchars($row['delivered_lead']); ?></td>
            <td><?php echo htmlspecialchars($row['pending_lead']); ?></td>
            <!-- <td><a href="#" 
                  class="btn btn-sm btn-info mx-2 " 
                  data-toggle="modal" data-target="#editCampModal"
                  data-id="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-communication_id="<?php echo htmlspecialchars($row['communication_id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_code="<?php echo htmlspecialchars($row['camp_code'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_name="<?php echo htmlspecialchars($row['camp_name'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_start_date="<?php echo htmlspecialchars($row['camp_start_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_end_date="<?php echo htmlspecialchars($row['camp_end_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-first_delivery_date="<?php echo htmlspecialchars($row['first_delivery_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivery_days="<?php echo htmlspecialchars($row['delivery_days'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-lead_goal="<?php echo htmlspecialchars($row['lead_goal'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-weekly_lead="<?php echo htmlspecialchars($row['weekly_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivered_lead="<?php echo htmlspecialchars($row['delivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-undelivered_lead="<?php echo htmlspecialchars($row['undelivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-pending_lead="<?php echo htmlspecialchars($row['pending_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-extra_lead="<?php echo htmlspecialchars($row['extra_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-generated_lead="<?php echo htmlspecialchars($row['generated_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_status="<?php echo htmlspecialchars($row['camp_status'], ENT_QUOTES, 'UTF-8'); ?>"> 
               Edit </a></td> -->
         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php
          } else {
              echo "<p>No campaigns due today.</p>";
          }
      }
   ?>

   <!-- Pagination Links -->
   <div class="container">
      <ul class="pagination">
         <?php if ($page > 1): ?>
         <li class="page-item">
            <a class="page-link" href="?page=<?php echo $page - 1; ?>&searchDuetoday=<?php echo urlencode($searchDuetoday); ?>&section=duetoday" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
         </li>
         <?php endif; ?>
         
         <?php for ($i = 1; $i <= $total_page; $i++): ?>
         <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>&searchDuetoday=<?php echo urlencode($searchDuetoday); ?>&section=duetoday">
                <?php echo $i; ?>
            </a>
         </li>
         <?php endfor; ?>
         
         <?php if ($page < $total_page): ?>
         <li class="page-item">
            <a class="page-link" href="?page=<?php echo $page + 1; ?>&searchDuetoday=<?php echo urlencode($searchDuetoday); ?>&section=duetoday" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
         </li>
         <?php endif; ?>
      </ul>
   </div>
</div>
<!-- DUE TODAY SECTION ENDS -->



<!-- ############################################################################## -->

<!-- OVERDUE SECTION STARTS -->
<div class="mt-4" id="viewOverdue" style="<?php echo htmlspecialchars($section) == 'overdue' ? 'display: block;' : 'display: none;'; ?>">


   <div class="col-md-3">
      <form class="d-flex" role="search" id="searchOverdueForm" method="GET" action="">
         <input class="form-control me-2" id="searchOverdue" name="searchOverdue" type="search" placeholder="Search by Campaign Code:" aria-label="Search" value="<?php echo isset($_GET['searchOverdue']) ? htmlspecialchars($_GET['searchOverdue']) : ''; ?>">
         <input type="hidden" name="section" value="overdue">
        
      </form>
      <br>
   </div>
   <?php
      $current_date = date('Y-m-d');
      $searchOverdue = isset($_GET['searchOverdue']) ? $_GET['searchOverdue'] : '';
      $searchOverdueParam = '%' . $searchOverdue . '%';
      
      // Pagination setup
      $limit = 30; // Number of records per page
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($page - 1) * $limit;
      
      // Query for fetching records
      $sql = "SELECT communication_id, camp_code, channel_id, camp_name, camp_start_date, camp_end_date, delivery_days, lead_goal, camp_status, first_delivery_date, delivered_lead, pending_lead, weekly_lead
              FROM campaign_details 
              WHERE camp_end_date < ? 
              AND camp_status = 'Live' 
              AND camp_code LIKE ?
              LIMIT ?, ?";
      
      $stmt = $conn->prepare($sql);
      if ($stmt) {
          $stmt->bind_param('ssii', $current_date, $searchOverdueParam, $offset, $limit);
          $stmt->execute();
          $result = $stmt->get_result();
      } else {
          echo "Error: " . $conn->error;
      }

      // Query for counting total records
      $count_sql = "SELECT COUNT(*) as total 
                    FROM campaign_details 
                    WHERE camp_end_date < ? 
                    AND camp_status = 'Live' 
                    AND camp_code LIKE ?";
      
      $count_stmt = $conn->prepare($count_sql);
      if ($count_stmt) {
          $count_stmt->bind_param('ss', $current_date, $searchOverdueParam);
          $count_stmt->execute();
          $count_result = $count_stmt->get_result();
          $total_records = $count_result->fetch_assoc()['total'];
      } else {
          echo "Error: " . $conn->error;
      }

      $total_page = ceil($total_records / $limit);
   ?>

   <?php if ($result && mysqli_num_rows($result) > 0): ?>
   <table class="table table-sm table-bordered table-content table-responsive text-center" id="viewOverduetable">
      <thead>
         <tr>
            <th scope="col">Campaign Code</th>
            <th scope="col">Communication ID</th>
            <th scope="col">Channel ID</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Date Added</th>
            <th scope="col">Campaign End Date</th>
            <th scope="col">Campaign Status</th>
            <th scope="col">Delivery Days</th>
            <th scope="col">First Delivery Date</th>
            <th scope="col">Lead Goal</th>
            <th scope="col">Weekly Leads</th>
            <th scope="col">Delivered Lead</th>
            <th scope="col">Pending Lead</th>
            
         </tr>
      </thead>
      <tbody>
         <?php while ($row = mysqli_fetch_assoc($result)): ?>
         <tr>
            <td><?php echo htmlspecialchars($row['camp_code']); ?></td>
            <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
            <td><?php echo htmlspecialchars($row['channel_id']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
            <td><span class="badge badge-pill badge-danger"><?php echo htmlspecialchars($row['camp_status']); ?></span></td>
            <td><?php echo htmlspecialchars($row['delivery_days']); ?></td>
            <td><?php echo htmlspecialchars($row['first_delivery_date']); ?></td>
            <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
            <td><?php echo htmlspecialchars($row['weekly_lead']); ?></td>
            <td><?php echo htmlspecialchars($row['delivered_lead']); ?></td>
            <td><?php echo htmlspecialchars($row['pending_lead']); ?></td>

    
            
         </tr>
         <?php endwhile; ?>
      </tbody>
   </table>
   <?php else: ?>
   <p>No overdue campaigns found.</p>
   <?php endif; ?>

   <!-- Pagination Links -->
   <div class="container">
      <ul class="pagination">
         <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?section=overdue&page=<?php echo $page - 1; ?>&searchOverdue=<?php echo urlencode($searchOverdue); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
         <?php endif; ?>

         <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?section=overdue&page=<?php echo $i; ?>&searchOverdue=<?php echo urlencode($searchOverdue); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
         <?php endfor; ?>

         <?php if ($page < $total_page): ?>
            <li class="page-item">
                <a class="page-link" href="?section=overdue&page=<?php echo $page + 1; ?>&searchOverdue=<?php echo urlencode($searchOverdue); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
         <?php endif; ?>
      </ul>
   </div>
</div>
<!-- OVERDUE SECTION ENDS -->

 
<!-- ############################################################################## -->

<!-- COMPLETED SECTION STARTS -->
<div class="mt-4" id="viewComplete" style="<?php echo $section == 'complete' ? 'display: block;' : 'display: none;'; ?>">
   <div class="col-md-3">
      <form class="d-flex" role="search" id="searchCompleteForm" method="GET" action="">
         <input class="form-control me-2" id="searchComplete" name="searchComplete" type="search" placeholder="Search by Campaign Code:" aria-label="Search" value="<?php echo isset($_GET['searchComplete']) ? htmlspecialchars($_GET['searchComplete']) : ''; ?>">
         <input type="hidden" name="section" value="complete">
      </form>
   </div>
   <br>
   <?php
      $searchComplete = isset($_GET['searchComplete']) ? mysqli_real_escape_string($conn, $_GET['searchComplete']) : '';
      $searchCompleteQuery = $searchComplete ? " AND camp_code LIKE '%$searchComplete%'" : '';

      //  $update_sql = "UPDATE campaign_details
      //       SET camp_status = 'Completed'
      //       WHERE camp_status = 'Live'
      //       AND lead_goal = delivered_leads
      //       AND CURDATE() BETWEEN camp_start_date AND camp_end_date;";

      //     mysqli_query($conn, $update_sql);

      $select_sql = "SELECT id, communication_id, camp_code, channel_id, camp_name, camp_start_date, camp_end_date, delivery_days, lead_goal, weekly_lead, delivered_lead, generated_lead, undelivered_lead, pending_lead, extra_lead, camp_status 
                     FROM campaign_details 
                     WHERE camp_status = 'completed'
                     $searchCompleteQuery
                     LIMIT {$offset}, {$limit}";

      $result = mysqli_query($conn, $select_sql);

      if (!$result) {
         echo "Error: " . mysqli_error($conn);
      } else {
         if (mysqli_num_rows($result) > 0) {
   ?>
   <table class="table table-sm table-bordered table-content table-responsive text-center" id="completedCampTable">
      <thead>
         <tr class="">
            <th scope="col" style="display: none;">Primary Id</th>
            <th scope="col">Campaign Code</th>
            <th scope="col">Communication ID</th>
            <th scope="col">Channel ID</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Date Added</th>
            <th scope="col">Campaign End Date</th>
            <th scope="col">Delivery Days</th>
            <th scope="col">Lead Goal</th>
            <th scope="col" style="display: none;">Weekly Leads</th>
            <th scope="col" style="display: none;">Delivered Lead</th>
            <th scope="col" style="display: none;">Generated Lead</th>
            <th scope="col" style="display: none;">Undelivered Lead</th>
            <th scope="col" style="display: none;">Pending Lead</th>
            <th scope="col" style="display: none;">Extra Lead</th>
            <th scope="col">Campaign Status</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
         <?php while ($row = mysqli_fetch_assoc($result)) { ?>
         <tr>
            <td style="display: none;"><?php echo $row['id']; ?></td>
            <td><?php echo $row['camp_code']; ?></td>
            <td><?php echo $row['communication_id']; ?></td>
            <td><?php echo $row['channel_id']; ?></td>
            <td><?php echo $row['camp_name']; ?></td>
            <td><?php echo $row['camp_start_date']; ?></td>
            <td><?php echo $row['camp_end_date']; ?></td>
            <td><?php echo $row['delivery_days']; ?></td>
            <td><?php echo $row['lead_goal']; ?></td>
            <td style="display: none;"><?php echo $row['weekly_lead']; ?></td>
            <td style="display: none;"><?php echo $row['delivered_lead']; ?></td>
            <td style="display: none;"><?php echo $row['generated_lead']; ?></td>
            <td style="display: none;"><?php echo $row['undelivered_lead']; ?></td>
            <td style="display: none;"><?php echo $row['pending_lead']; ?></td>
            <td style="display: none;"><?php echo $row['extra_lead']; ?></td>
            <td><span class="badge badge-pill badge-success"><?php echo $row['camp_status']; ?></span></td>
            <td>
               <a href="#" 
                  class="btn btn-info mx-2" 
                  data-toggle="modal" data-target="#editCampModal"
                  data-id="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-communication_id="<?php echo htmlspecialchars($row['communication_id'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_code="<?php echo htmlspecialchars($row['camp_code'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_name="<?php echo htmlspecialchars($row['camp_name'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_start_date="<?php echo htmlspecialchars($row['camp_start_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_end_date="<?php echo htmlspecialchars($row['camp_end_date'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivery_days="<?php echo htmlspecialchars($row['delivery_days'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-lead_goal="<?php echo htmlspecialchars($row['lead_goal'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-weekly_lead="<?php echo htmlspecialchars($row['weekly_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-delivered_lead="<?php echo htmlspecialchars($row['delivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-undelivered_lead="<?php echo htmlspecialchars($row['undelivered_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-pending_lead="<?php echo htmlspecialchars($row['pending_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-extra_lead="<?php echo htmlspecialchars($row['extra_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-generated_lead="<?php echo htmlspecialchars($row['generated_lead'], ENT_QUOTES, 'UTF-8'); ?>"
                  data-camp_status="<?php echo htmlspecialchars($row['camp_status'], ENT_QUOTES, 'UTF-8'); ?>"> 
               Edit 
               </a>
            </td>
         </tr>
         <?php } ?>
      </tbody>
   </table>
   <?php
      } else {
         echo "<p>No completed campaigns found.</p>";
      }
      }
   ?>
   <!-- Pagination Links -->
   <div class="container">
      <ul class="pagination">
         <?php if ($page > 1): ?>
            <li class="page-item">
               <a class="page-link" href="?section=complete&page=<?php echo $page - 1; ?>&searchComplete=<?php echo urlencode($searchComplete); ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
               </a>
            </li>
         <?php endif; ?>

         <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
               <a class="page-link" href="?section=complete&page=<?php echo $i; ?>&searchComplete=<?php echo urlencode($searchComplete); ?>">
                  <?php echo $i; ?>
               </a>
            </li>
         <?php endfor; ?>

         <?php if ($page < $total_page): ?>
            <li class="page-item">
               <a class="page-link" href="?section=complete&page=<?php echo $page + 1; ?>&searchComplete=<?php echo urlencode($searchComplete); ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
               </a>
            </li>
         <?php endif; ?>
      </ul>
   </div>
</div>
<!-- COMPLETED SECTION ENDS -->


<!-- ############################################################################## -->



<!-- EDIT CAMPAIGN THROUGH FORM STARTS -->
<div class="modal fade" id="editCampModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editCampModalLabel">Edit Campaign</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="http://localhost/crm1/update-campaign.php" name="campaignUpdateForm" id="campaignUpdateForm" method="POST" class="form_style">
               <div class="mb-3">
                  <input type="hidden" name="id" id="id_update" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">
               </div>
               <div class="mb-3">
                  <label for="camp_code_update" class="form-label">Campaign Code</label>
                  <input type="text" class="form-control" id="camp_code_update" name="camp_code" required="">
               </div>
               <div class="mb-3">
                  <label for="communication_id_update" class="form-label">Communication ID</label>
                  <input type="text" class="form-control" id="communication_id_update" name="communication_id" required="">
               </div>
               <div class="mb-3">
                  <label for="camp_name_update" class="form-label">Campaign Name</label>
                  <input type="text" name="camp_name" class="form-control" id="camp_name_update" required="">
               </div>
               <div class="mb-3">
                  <label for="camp_start_date_update" class="form-label">Date Added</label>
                  <input type="date" name="camp_start_date" class="form-control" id="camp_start_date_update" required="">
               </div>
               <div class="mb-3">
                  <label for="camp_end_date_update" class="form-label">Campaign End Date</label>
                  <input type="date" name="camp_end_date" class="form-control" id="camp_end_date_update" required="">
               </div>
               <div class="mb-3">
                  <label for="first_delivery_date_update" class="form-label">First Delivery Date	</label>
                  <input type="date" name="first_delivery_date" class="form-control" id="first_delivery_date_update" required="">
               </div>
               <div class="mb-3">
                  <label>Delivery Days:</label>
                  <div class="checkbox-group" id="delivery_days_checkbox">
                     <label><input type="checkbox" name="delivery_days[]" value="Monday"> Monday</label>
                     <label><input type="checkbox" name="delivery_days[]" value="Tuesday"> Tuesday</label>
                     <label><input type="checkbox" name="delivery_days[]" value="Wednesday"> Wednesday</label>
                     <label><input type="checkbox" name="delivery_days[]" value="Thursday"> Thursday</label>
                     <label><input type="checkbox" name="delivery_days[]" value="Friday"> Friday</label>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="lead_goal_update" class="form-label">Lead Goal</label>
                  <input type="number" name="lead_goal" class="form-control" id="lead_goal_update" required="">
               </div>
               <div class="mb-3">
                  <label for="weekly_lead_update" class="form-label">Weekly Leads</label>
                  <input type="number" name="weekly_lead" class="form-control" id="weekly_lead_update" required="">
               </div>
               <div class="mb-3">
                  <label for="delivered_lead_update" class="form-label">Delivered Leads</label>
                  <input type="number" name="delivered_lead" class="form-control" id="delivered_lead_update">
               </div>
               <!-- <div class="mb-3">
                  <label for="undelivered_lead" class="form-label">Undelivered Leads</label>
                  <input type="number" name="undelivered_lead" class="form-control" id="undelivered_lead_update" >
                  </div> -->
               <!-- <div class="mb-3">
                  <label for="pending_lead" class="form-label">Pending Leads</label>
                  <input type="number" name="pending_lead" class="form-control" id="pending_lead_update" >
                  </div> -->
               <!-- <div class="mb-3">
                  <label for="extra_lead" class="form-label">Extra Leads</label>
                  <input type="number" name="extra_lead" class="form-control" id="extra_lead_update" >
                  </div> -->
               <div class="mb-3">
                  <label for="generated_lead_update" class="form-label">Generated Leads</label>
                  <input type="number" name="generated_lead" class="form-control" id="generated_lead_update">
               </div>
               <!-- <div class="mb-3">
                  <label for="country">Country</label>
                  <select class="form-control select2-hidden-accessible" id="country_select_update" name="country[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-country_select_update" tabindex="-1" aria-hidden="true">
                     <option value="﻿AFGHANISTAN">﻿AFGHANISTAN</option>
                     <option value="ALBANIA">ALBANIA</option>
                     <option value="ALGERIA">ALGERIA</option>
                     <option value="AMERICAN SAMOA">AMERICAN SAMOA</option>
                     <option value="ANDORRA">ANDORRA</option>
                     <option value="ANGOLA">ANGOLA</option>
                     <option value="ANGUILLA">ANGUILLA</option>
                     <option value="ANTARCTICA">ANTARCTICA</option>
                     <option value="ANTIGUA AND BARBUDA">ANTIGUA AND BARBUDA</option>
                     <option value="ARGENTINA">ARGENTINA</option>
                     <option value="ARMENIA">ARMENIA</option>
                     <option value="ARUBA">ARUBA</option>
                     <option value="AUSTRALIA">AUSTRALIA</option>
                     <option value="AUSTRIA">AUSTRIA</option>
                     <option value="AZERBAIJAN">AZERBAIJAN</option>
                     <option value="BAHAMAS">BAHAMAS</option>
                     <option value="BAHRAIN">BAHRAIN</option>
                     <option value="BANGLADESH">BANGLADESH</option>
                     <option value="BARBADOS">BARBADOS</option>
                     <option value="BELARUS">BELARUS</option>
                     <option value="BELGIUM">BELGIUM</option>
                     <option value="BELIZE">BELIZE</option>
                     <option value="BENIN">BENIN</option>
                     <option value="BERMUDA">BERMUDA</option>
                     <option value="BHUTAN">BHUTAN</option>
                     <option value="BOLIVIA">BOLIVIA</option>
                     <option value="BOSNIA AND HERZEGOVINA">BOSNIA AND HERZEGOVINA</option>
                     <option value="BOTSWANA">BOTSWANA</option>
                     <option value="BOUVET ISLAND">BOUVET ISLAND</option>
                     <option value="BRAZIL">BRAZIL</option>
                     <option value="BRITISH INDIAN OCEAN TERRITORY">BRITISH INDIAN OCEAN TERRITORY</option>
                     <option value="BRUNEI DARUSSALAM">BRUNEI DARUSSALAM</option>
                     <option value="BULGARIA">BULGARIA</option>
                     <option value="BURKINA FASO">BURKINA FASO</option>
                     <option value="BURUNDI">BURUNDI</option>
                     <option value="CAMBODIA">CAMBODIA</option>
                     <option value="CAMEROON">CAMEROON</option>
                     <option value="CANADA">CANADA</option>
                     <option value="CAPE VERDE">CAPE VERDE</option>
                     <option value="CAYMAN ISLANDS">CAYMAN ISLANDS</option>
                     <option value="CENTRAL AFRICAN REPUBLIC">CENTRAL AFRICAN REPUBLIC</option>
                     <option value="CHAD">CHAD</option>
                     <option value="CHILE">CHILE</option>
                     <option value="CHINA">CHINA</option>
                     <option value="CHRISTMAS ISLAND">CHRISTMAS ISLAND</option>
                     <option value="COCOS (KEELING) ISLANDS">COCOS (KEELING) ISLANDS</option>
                     <option value="COLOMBIA">COLOMBIA</option>
                     <option value="COMOROS">COMOROS</option>
                     <option value="CONGO">CONGO</option>
                     <option value="CONGO, THE DEMOCRATIC REPUBLIC OF THE">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
                     <option value="COOK ISLANDS">COOK ISLANDS</option>
                     <option value="COSTA RICA">COSTA RICA</option>
                     <option value="COTE D'IVOIRE">COTE D'IVOIRE</option>
                     <option value="CROATIA">CROATIA</option>
                     <option value="CUBA">CUBA</option>
                     <option value="CYPRUS">CYPRUS</option>
                     <option value="CZECH REPUBLIC">CZECH REPUBLIC</option>
                     <option value="DENMARK">DENMARK</option>
                     <option value="DJIBOUTI">DJIBOUTI</option>
                     <option value="DOMINICA">DOMINICA</option>
                     <option value="DOMINICAN REPUBLIC">DOMINICAN REPUBLIC</option>
                     <option value="ECUADOR">ECUADOR</option>
                     <option value="EGYPT">EGYPT</option>
                     <option value="EL SALVADOR">EL SALVADOR</option>
                     <option value="ELAND ISLANDS">ELAND ISLANDS</option>
                     <option value="EQUATORIAL GUINEA">EQUATORIAL GUINEA</option>
                     <option value="ERITREA">ERITREA</option>
                     <option value="ESTONIA">ESTONIA</option>
                     <option value="ETHIOPIA">ETHIOPIA</option>
                     <option value="FALKLAND ISLANDS (MALVINAS)">FALKLAND ISLANDS (MALVINAS)</option>
                     <option value="FAROE ISLANDS">FAROE ISLANDS</option>
                     <option value="FIJI">FIJI</option>
                     <option value="FINLAND">FINLAND</option>
                     <option value="FRANCE">FRANCE</option>
                     <option value="FRENCH GUIANA">FRENCH GUIANA</option>
                     <option value="FRENCH POLYNESIA">FRENCH POLYNESIA</option>
                     <option value="FRENCH SOUTHERN TERRITORIES">FRENCH SOUTHERN TERRITORIES</option>
                     <option value="GABON">GABON</option>
                     <option value="GAMBIA">GAMBIA</option>
                     <option value="GEORGIA">GEORGIA</option>
                     <option value="GERMANY">GERMANY</option>
                     <option value="GHANA">GHANA</option>
                     <option value="GIBRALTAR">GIBRALTAR</option>
                     <option value="GREECE">GREECE</option>
                     <option value="GREENLAND">GREENLAND</option>
                     <option value="GRENADA">GRENADA</option>
                     <option value="GUADELOUPE">GUADELOUPE</option>
                     <option value="GUAM">GUAM</option>
                     <option value="GUATEMALA">GUATEMALA</option>
                     <option value="GUINEA">GUINEA</option>
                     <option value="GUINEA-BISSAU">GUINEA-BISSAU</option>
                     <option value="GUYANA">GUYANA</option>
                     <option value="HAITI">HAITI</option>
                     <option value="HEARD ISLAND AND MCDONALD ISLANDS">HEARD ISLAND AND MCDONALD ISLANDS</option>
                     <option value="HOLY SEE (VATICAN CITY STATE)">HOLY SEE (VATICAN CITY STATE)</option>
                     <option value="HONDURAS">HONDURAS</option>
                     <option value="HONG KONG">HONG KONG</option>
                     <option value="HUNGARY">HUNGARY</option>
                     <option value="ICELAND">ICELAND</option>
                     <option value="INDIA">INDIA</option>
                     <option value="INDONESIA">INDONESIA</option>
                     <option value="IRAN, ISLAMIC REPUBLIC OF">IRAN, ISLAMIC REPUBLIC OF</option>
                     <option value="IRAQ">IRAQ</option>
                     <option value="IRELAND">IRELAND</option>
                     <option value="ISRAEL">ISRAEL</option>
                     <option value="ITALY">ITALY</option>
                     <option value="JAMAICA">JAMAICA</option>
                     <option value="JAPAN">JAPAN</option>
                     <option value="JORDAN">JORDAN</option>
                     <option value="KAZAKHSTAN">KAZAKHSTAN</option>
                     <option value="KENYA">KENYA</option>
                     <option value="KIRIBATI">KIRIBATI</option>
                     <option value="KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF">KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF</option>
                     <option value="KOREA, REPUBLIC OF">KOREA, REPUBLIC OF</option>
                     <option value="KUWAIT">KUWAIT</option>
                     <option value="KYRGYZSTAN">KYRGYZSTAN</option>
                     <option value="LAO PEOPLE'S DEMOCRATIC REPUBLIC">LAO PEOPLE'S DEMOCRATIC REPUBLIC</option>
                     <option value="LATVIA">LATVIA</option>
                     <option value="LEBANON">LEBANON</option>
                     <option value="LESOTHO">LESOTHO</option>
                     <option value="LIBERIA">LIBERIA</option>
                     <option value="LIBYAN ARAB JAMAHIRIYA">LIBYAN ARAB JAMAHIRIYA</option>
                     <option value="LIECHTENSTEIN">LIECHTENSTEIN</option>
                     <option value="LITHUANIA">LITHUANIA</option>
                     <option value="LUXEMBOURG">LUXEMBOURG</option>
                     <option value="MACAO">MACAO</option>
                     <option value="MACEDONIA">MACEDONIA</option>
                     <option value="MADAGASCAR">MADAGASCAR</option>
                     <option value="MALAWI">MALAWI</option>
                     <option value="MALAYSIA">MALAYSIA</option>
                     <option value="MALDIVES">MALDIVES</option>
                     <option value="MALI">MALI</option>
                     <option value="MALTA">MALTA</option>
                     <option value="MARSHALL ISLANDS">MARSHALL ISLANDS</option>
                     <option value="MARTINIQUE">MARTINIQUE</option>
                     <option value="MAURITANIA">MAURITANIA</option>
                     <option value="MAURITIUS">MAURITIUS</option>
                     <option value="MAYOTTE">MAYOTTE</option>
                     <option value="MEXICO">MEXICO</option>
                     <option value="MICRONESIA, FEDERATED STATES OF">MICRONESIA, FEDERATED STATES OF</option>
                     <option value="MOLDOVA, REPUBLIC OF">MOLDOVA, REPUBLIC OF</option>
                     <option value="MONACO">MONACO</option>
                     <option value="MONGOLIA">MONGOLIA</option>
                     <option value="MONTSERRAT">MONTSERRAT</option>
                     <option value="MOROCCO">MOROCCO</option>
                     <option value="MOZAMBIQUE">MOZAMBIQUE</option>
                     <option value="MYANMAR">MYANMAR</option>
                     <option value="NAMIBIA">NAMIBIA</option>
                     <option value="NAURU">NAURU</option>
                     <option value="NEPAL">NEPAL</option>
                     <option value="NETHERLANDS">NETHERLANDS</option>
                     <option value="NETHERLANDS ANTILLES">NETHERLANDS ANTILLES</option>
                     <option value="NEW CALEDONIA">NEW CALEDONIA</option>
                     <option value="NEW ZEALAND">NEW ZEALAND</option>
                     <option value="NICARAGUA">NICARAGUA</option>
                     <option value="NIGER">NIGER</option>
                     <option value="NIGERIA">NIGERIA</option>
                     <option value="NIUE">NIUE</option>
                     <option value="NORFOLK ISLAND">NORFOLK ISLAND</option>
                     <option value="NORTHERN MARIANA ISLANDS">NORTHERN MARIANA ISLANDS</option>
                     <option value="NORWAY">NORWAY</option>
                     <option value="OMAN">OMAN</option>
                     <option value="PAKISTAN">PAKISTAN</option>
                     <option value="PALAU">PALAU</option>
                     <option value="PALESTINIAN TERRITORY, OCCUPIED">PALESTINIAN TERRITORY, OCCUPIED</option>
                     <option value="PANAMA">PANAMA</option>
                     <option value="PAPUA NEW GUINEA">PAPUA NEW GUINEA</option>
                     <option value="PARAGUAY">PARAGUAY</option>
                     <option value="PERU">PERU</option>
                     <option value="PHILIPPINES">PHILIPPINES</option>
                     <option value="PITCAIRN">PITCAIRN</option>
                     <option value="POLAND">POLAND</option>
                     <option value="PORTUGAL">PORTUGAL</option>
                     <option value="PUERTO RICO">PUERTO RICO</option>
                     <option value="QATAR">QATAR</option>
                     <option value="REUNION">REUNION</option>
                     <option value="ROMANIA">ROMANIA</option>
                     <option value="RUSSIAN FEDERATION">RUSSIAN FEDERATION</option>
                     <option value="RWANDA">RWANDA</option>
                     <option value="SAINT HELENA">SAINT HELENA</option>
                     <option value="SAINT KITTS AND NEVIS">SAINT KITTS AND NEVIS</option>
                     <option value="SAINT LUCIA">SAINT LUCIA</option>
                     <option value="SAINT PIERRE AND MIQUELON">SAINT PIERRE AND MIQUELON</option>
                     <option value="SAINT VINCENT AND THE GRENADINES">SAINT VINCENT AND THE GRENADINES</option>
                     <option value="SAMOA">SAMOA</option>
                     <option value="SAN MARINO">SAN MARINO</option>
                     <option value="SAO TOME AND PRINCIPE">SAO TOME AND PRINCIPE</option>
                     <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                     <option value="SENEGAL">SENEGAL</option>
                     <option value="SERBIA">SERBIA</option>
                     <option value="SERBIA AND MONTENEGRO">SERBIA AND MONTENEGRO</option>
                     <option value="SEYCHELLES">SEYCHELLES</option>
                     <option value="SIERRA LEONE">SIERRA LEONE</option>
                     <option value="SINGAPORE">SINGAPORE</option>
                     <option value="SLOVAKIA">SLOVAKIA</option>
                     <option value="SLOVENIA">SLOVENIA</option>
                     <option value="SOLOMON ISLANDS">SOLOMON ISLANDS</option>
                     <option value="SOMALIA">SOMALIA</option>
                     <option value="SOUTH AFRICA">SOUTH AFRICA</option>
                     <option value="SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS">SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS</option>
                     <option value="SPAIN">SPAIN</option>
                     <option value="SRI LANKA">SRI LANKA</option>
                     <option value="SUDAN">SUDAN</option>
                     <option value="SURINAME">SURINAME</option>
                     <option value="SVALBARD AND JAN MAYEN">SVALBARD AND JAN MAYEN</option>
                     <option value="SWAZILAND">SWAZILAND</option>
                     <option value="SWEDEN">SWEDEN</option>
                     <option value="SWITZERLAND">SWITZERLAND</option>
                     <option value="SYRIAN ARAB REPUBLIC">SYRIAN ARAB REPUBLIC</option>
                     <option value="TAIWAN, PROVINCE OF CHINA">TAIWAN, PROVINCE OF CHINA</option>
                     <option value="TAJIKISTAN">TAJIKISTAN</option>
                     <option value="TANZANIA, UNITED REPUBLIC OF">TANZANIA, UNITED REPUBLIC OF</option>
                     <option value="THAILAND">THAILAND</option>
                     <option value="TIMOR-LESTE">TIMOR-LESTE</option>
                     <option value="TOGO">TOGO</option>
                     <option value="TOKELAU">TOKELAU</option>
                     <option value="TONGA">TONGA</option>
                     <option value="TRINIDAD AND TOBAGO">TRINIDAD AND TOBAGO</option>
                     <option value="TUNISIA">TUNISIA</option>
                     <option value="TURKEY">TURKEY</option>
                     <option value="TURKMENISTAN">TURKMENISTAN</option>
                     <option value="TURKS AND CAICOS ISLANDS">TURKS AND CAICOS ISLANDS</option>
                     <option value="TUVALU">TUVALU</option>
                     <option value="UGANDA">UGANDA</option>
                     <option value="UKRAINE">UKRAINE</option>
                     <option value="UNITED ARAB EMIRATES">UNITED ARAB EMIRATES</option>
                     <option value="UNITED KINGDOM">UNITED KINGDOM</option>
                     <option value="UNITED STATES">UNITED STATES</option>
                     <option value="UNITED STATES MINOR OUTLYING ISLANDS">UNITED STATES MINOR OUTLYING ISLANDS</option>
                     <option value="URUGUAY">URUGUAY</option>
                     <option value="UZBEKISTAN">UZBEKISTAN</option>
                     <option value="VANUATU">VANUATU</option>
                     <option value="VENEZUELA">VENEZUELA</option>
                     <option value="VIET NAM">VIET NAM</option>
                     <option value="VIRGIN ISLANDS, BRITISH">VIRGIN ISLANDS, BRITISH</option>
                     <option value="VIRGIN ISLANDS, U.S.">VIRGIN ISLANDS, U.S.</option>
                     <option value="WALLIS AND FUTUNA">WALLIS AND FUTUNA</option>
                     <option value="WESTERN SAHARA">WESTERN SAHARA</option>
                     <option value="YEMEN">YEMEN</option>
                     <option value="ZAMBIA">ZAMBIA</option>
                     <option value="ZIMBABWE">ZIMBABWE</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-1-13i6" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-country_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-country_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="mb-3">
                  <label for="company_size">Company Size</label>
                  <select class="form-control select2-hidden-accessible" id="company_size_select_update" name="company_size[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-company_size_select_update" tabindex="-1" aria-hidden="true">
                     <option value="1-10">1-10</option>
                     <option value="11-50">11-50</option>
                     <option value="51-100">51-100</option>
                     <option value="101-500">101-500</option>
                     <option value="501-1000">501-1000</option>
                     <option value="1000+">1000+</option>
                  </select>
                  <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-2tg7" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-company_size_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-company_size_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="mb-3">
                  <label for="job_title">Job Titles</label>
                  <select class="form-control select2-hidden-accessible" id="job_title_select_update" name="job_title[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-job_title_select_update" tabindex="-1" aria-hidden="true">
                     <option value="Application / Software Development">Application / Software Development</option>
                     <option value="Application Management: Finance">Application Management: Finance</option>
                     <option value="Application Management: HR">Application Management: HR</option>
                     <option value="Application Management: Healthcare">Application Management: Healthcare</option>
                     <option value="Application Management: Integration / Middleware">Application Management: Integration / Middleware</option>
                  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-3-buzr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-job_title_select_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-job_title_select_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="mb-3">
                  <label for="job_level">Job Level</label>
                  <select class="form-control select2-hidden-accessible" id="job_level_update" name="job_level[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-job_level_update" tabindex="-1" aria-hidden="true">
                     <option value="Architect">Architect</option>
                     <option value="C-Level / Executive Team">C-Level / Executive Team</option>
                     <option value="Director">Director</option>
                     <option value="EVP / SVP / VP / AVP">EVP / SVP / VP / AVP</option>
                     <option value="Manager">Manager</option>
                  </select>
                  <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-r1xa" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-job_level_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-job_level_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="mb-3">
                  <label for="industry">Industry</label>
                  <select class="form-control select2-hidden-accessible" id="industry_update" name="industry[]" multiple="" style="width: 100%;" required="" data-select2-id="select2-data-industry_update" tabindex="-1" aria-hidden="true">
                     <option value="Accountable Care Organization">Accountable Care Organization</option>
                     <option value="Accounting">Accounting</option>
                     <option value="Agriculture/Forestry">Agriculture/Forestry</option>
                     <option value="Airlines/Aviation">Airlines/Aviation</option>
                     <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                     <option value="Alternative Medicine">Alternative Medicine</option>
                     <option value="Ancillary Clinical Service Provider">Ancillary Clinical Service Provider</option>
                     <option value="Animation">Animation</option>
                     <option value="Apparel &amp; Fashion">Apparel &amp; Fashion</option>
                     <option value="Architecture &amp; Planning">Architecture &amp; Planning</option>
                     <option value="Architecture and Engineering">Architecture and Engineering</option>
                     <option value="Arts and Crafts">Arts and Crafts</option>
                     <option value="Automotive">Automotive</option>
                     <option value="Aviation &amp; Aerospace">Aviation &amp; Aerospace</option>
                     <option value="Banking">Banking</option>
                     <option value="Biomedical Engineering">Biomedical Engineering</option>
                     <option value="Biotechnology">Biotechnology</option>
                     <option value="Broadcast Media">Broadcast Media</option>
                     <option value="Building Materials">Building Materials</option>
                     <option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
                     <option value="Business services">Business services</option>
                     <option value="Capital Markets">Capital Markets</option>
                     <option value="Chemicals">Chemicals</option>
                     <option value="Civic &amp; Social Organization">Civic &amp; Social Organization</option>
                     <option value="Civil Engineering">Civil Engineering</option>
                     <option value="Clinical Research Organization">Clinical Research Organization</option>
                     <option value="Commercial Real Estate">Commercial Real Estate</option>
                     <option value="Computer And Computer Peripheral Equipment And Software Merchant Wholesalers">Computer And Computer Peripheral Equipment And Software Merchant Wholesalers</option>
                     <option value="Construction">Construction</option>
                     <option value="Consumer Electronics">Consumer Electronics</option>
                     <option value="Consumer Goods">Consumer Goods</option>
                     <option value="Consumer Goods &amp; Services">Consumer Goods &amp; Services</option>
                     <option value="Consumer Services">Consumer Services</option>
                     <option value="Cosmetics">Cosmetics</option>
                     <option value="Dairy">Dairy</option>
                     <option value="Defense &amp; Space">Defense &amp; Space</option>
                     <option value="Design">Design</option>
                     <option value="E-Learning">E-Learning</option>
                     <option value="Education">Education</option>
                     <option value="Education Management">Education Management</option>
                     <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                     <option value="Entertainment">Entertainment</option>
                     <option value="Environmental Services">Environmental Services</option>
                     <option value="Events Services">Events Services</option>
                     <option value="Executive Office">Executive Office</option>
                     <option value="Facilities Services">Facilities Services</option>
                     <option value="Farming">Farming</option>
                     <option value="Federal/State/Municipal Health Agency">Federal/State/Municipal Health Agency</option>
                     <option value="Financial Services">Financial Services</option>
                     <option value="Financial/Banking">Financial/Banking</option>
                     <option value="Fine Art">Fine Art</option>
                     <option value="Fishery">Fishery</option>
                     <option value="Food &amp; Beverages">Food &amp; Beverages</option>
                     <option value="Food Production">Food Production</option>
                     <option value="Fund-Raising">Fund-Raising</option>
                     <option value="Furniture">Furniture</option>
                     <option value="Gambling &amp; Casinos">Gambling &amp; Casinos</option>
                     <option value="Glass, Ceramics &amp; Concrete">Glass, Ceramics &amp; Concrete</option>
                     <option value="Government &amp; Public Policy">Government &amp; Public Policy</option>
                     <option value="Government Administration">Government Administration</option>
                     <option value="Government Relations">Government Relations</option>
                     <option value="Graphic Design">Graphic Design</option>
                     <option value="Health, Wellness and Fitness">Health, Wellness and Fitness</option>
                     <option value="Healthcare/Health Services">Healthcare/Health Services</option>
                     <option value="Higher Education">Higher Education</option>
                     <option value="Hospital &amp; Health Care">Hospital &amp; Health Care</option>
                     <option value="Hospital/Medical Center/Multi-Hospital System/IDN">Hospital/Medical Center/Multi-Hospital System/IDN</option>
                     <option value="Hospitality">Hospitality</option>
                     <option value="Human Resources">Human Resources</option>
                     <option value="Import and Export">Import and Export</option>
                     <option value="Individual &amp; Family Services">Individual &amp; Family Services</option>
                     <option value="Industrial Automation">Industrial Automation</option>
                     <option value="Information Services">Information Services</option>
                     <option value="Insurance">Insurance</option>
                     <option value="Insurance (non-Healthcare)">Insurance (non-Healthcare)</option>
                     <option value="International Affairs">International Affairs</option>
                     <option value="International Trade and Development">International Trade and Development</option>
                     <option value="Internet">Internet</option>
                     <option value="Investment Banking">Investment Banking</option>
                     <option value="Investment Management">Investment Management</option>
                     <option value="Judiciary">Judiciary</option>
                     <option value="Law Enforcement">Law Enforcement</option>
                     <option value="Law Practice">Law Practice</option>
                     <option value="Legal services">Legal services</option>
                     <option value="Legislative Office">Legislative Office</option>
                     <option value="Leisure, Travel &amp; Tourism">Leisure, Travel &amp; Tourism</option>
                     <option value="Libraries">Libraries</option>
                     <option value="Life Sciences">Life Sciences</option>
                     <option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
                     <option value="Luxury Goods &amp; Jewelry">Luxury Goods &amp; Jewelry</option>
                     <option value="Machinery">Machinery</option>
                     <option value="Management Consulting">Management Consulting</option>
                     <option value="Manufacturing/Industrial (non-computer related)">Manufacturing/Industrial (non-computer related)</option>
                     <option value="Maritime">Maritime</option>
                     <option value="Market Research">Market Research</option>
                     <option value="Marketing and Advertising">Marketing and Advertising</option>
                     <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                     <option value="Media Production">Media Production</option>
                     <option value="Medical Devices">Medical Devices</option>
                     <option value="Medical Practice">Medical Practice</option>
                     <option value="Mental Health Care">Mental Health Care</option>
                     <option value="Military">Military</option>
                     <option value="Mining &amp; Metals">Mining &amp; Metals</option>
                     <option value="Mobile Games">Mobile Games</option>
                     <option value="Motion Pictures and Film">Motion Pictures and Film</option>
                     <option value="Museums and Institutions">Museums and Institutions</option>
                     <option value="Music">Music</option>
                     <option value="Nanotechnology">Nanotechnology</option>
                     <option value="Newspapers">Newspapers</option>
                     <option value="Nonprofit Organization Management">Nonprofit Organization Management</option>
                     <option value="Oil &amp; Energy">Oil &amp; Energy</option>
                     <option value="Oil/Gas/Mining/Other natural resources">Oil/Gas/Mining/Other natural resources</option>
                     <option value="Online Media">Online Media</option>
                     <option value="Other">Other</option>
                     <option value="Outpatient Center">Outpatient Center</option>
                     <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                     <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                     <option value="Packaging and Containers">Packaging and Containers</option>
                     <option value="Paper &amp; Forest Products">Paper &amp; Forest Products</option>
                     <option value="Payer/Insurance Company/Managed Care Organization">Payer/Insurance Company/Managed Care Organization</option>
                     <option value="Performing Arts">Performing Arts</option>
                     <option value="Pharmaceuticals">Pharmaceuticals</option>
                     <option value="Philanthropy">Philanthropy</option>
                     <option value="Photography">Photography</option>
                     <option value="Physician Practice/Physician Group">Physician Practice/Physician Group</option>
                     <option value="Plastics">Plastics</option>
                     <option value="Political Organization">Political Organization</option>
                     <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                     <option value="Printing">Printing</option>
                     <option value="Professional Training &amp; Coaching">Professional Training &amp; Coaching</option>
                     <option value="Program Development">Program Development</option>
                     <option value="Public Policy">Public Policy</option>
                     <option value="Public Relations and Communications">Public Relations and Communications</option>
                     <option value="Public Safety">Public Safety</option>
                     <option value="Publishing">Publishing</option>
                     <option value="Publishing/Broadcast/Media">Publishing/Broadcast/Media</option>
                     <option value="Railroad Manufacture">Railroad Manufacture</option>
                     <option value="Ranching">Ranching</option>
                     <option value="Real Estate">Real Estate</option>
                     <option value="Recreation/Entertainment">Recreation/Entertainment</option>
                     <option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
                     <option value="Religious Institutions">Religious Institutions</option>
                     <option value="Renewables &amp; Environment">Renewables &amp; Environment</option>
                     <option value="Research">Research</option>
                     <option value="Research and Consulting">Research and Consulting</option>
                     <option value="Restaurants">Restaurants</option>
                     <option value="Retail">Retail</option>
                     <option value="Security and Investigations">Security and Investigations</option>
                     <option value="Semiconductors">Semiconductors</option>
                     <option value="Shipbuilding">Shipbuilding</option>
                     <option value="Skilled Nursing Facility">Skilled Nursing Facility</option>
                     <option value="Sporting Goods">Sporting Goods</option>
                     <option value="Sports">Sports</option>
                     <option value="Staffing and Recruiting">Staffing and Recruiting</option>
                     <option value="Supermarkets">Supermarkets</option>
                     <option value="Telecommunications">Telecommunications</option>
                     <option value="Textiles">Textiles</option>
                     <option value="Think Tanks">Think Tanks</option>
                     <option value="Tobacco">Tobacco</option>
                     <option value="Translation and Localization">Translation and Localization</option>
                     <option value="Transportation/Distribution">Transportation/Distribution</option>
                     <option value="Transportation/Trucking/Railroad">Transportation/Trucking/Railroad</option>
                     <option value="Travel/Hospitality">Travel/Hospitality</option>
                     <option value="Utilities">Utilities</option>
                     <option value="Venture Capital &amp; Private Equity">Venture Capital &amp; Private Equity</option>
                     <option value="Veterinary">Veterinary</option>
                     <option value="Warehousing">Warehousing</option>
                     <option value="Wholesale">Wholesale</option>
                     <option value="Wine and Spirits">Wine and Spirits</option>
                     <option value="Wireless">Wireless</option>
                     <option value="Writing and Editing">Writing and Editing</option>
                  </select>
                  <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-r1xa" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-industry_update-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-industry_update-container" placeholder="" style="width: 0.75em;"></textarea></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                  </div>
                  <div class="mb-3">
                  <label for="custm_que">Custom Question</label>
                  <select class="form-control" id="custm_que_update" name="custm_que" required="">
                     <option value="" disabled=""> Custom Question</option>
                     <option value="yes">yes</option>
                     <option value="no">no</option>
                  </select>
                  </div>  -->
               <div class="mb-3">
                  <label for="camp_status_update" class="form-label">Campaign Status</label>
                  <select name="camp_status" id="camp_status_update" class="form-control" required="">
                     <option value="" disabled="">Select Status</option>
                     <option value="Pending">Pending</option>
                     <option value="Live">Live</option>
                     <option value="Pause">Pause</option>
                     <option value="Completed">Completed</option>
                     <option value="Cancel">Cancel</option>
                     <option value="Escalation">Escalation</option>
                  </select>
               </div>
               <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                  <button type="submit" name="submit" class="btn " style="background-color: #0F8EB6; color: white;">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- EDIT CAMPAIGN THROUGH FORM ENDS -->





<!-- Download Data Monthly Starts -->
<div class="modal fade" id="downloadDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="downloadDataModalLabel">Download Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="download-all-data-excel.php" method="post">
               <label for="month">Month:</label>
               <select id="month" name="month" required>
               <?php
                  // Populate month dropdown
                  for ($m = 1; $m <= 12; $m++) {
                      echo "<option value=\"$m\">" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
                  }
                  ?>
               </select>
               <label for="year">Year:</label>
               <input type="number" id="year" name="year" min="2000" max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" required>
               <input type="submit" value="Export to Excel">
            </form>
         </div>
      </div>
   </div>
</div>
<!--  Download Data Monthly Ends -->
  




<!-- View CAMPAIGN SUB MODAL STARTS -->
<div class="modal fade" id="viewSubModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="viewSubModalLabel">View Campaign Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>
<!-- View CAMPAIGN SUB MODAL ENDS -->











<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Initialize Select2 -->
<!-- MULTIPLE SELECT ENDS -->
<!-- Include Bootstrap JS (if needed) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function() {
       try {
           var urlParams = new URLSearchParams(window.location.search);
           var section = urlParams.get('section') || 'dashboard';
           
           // Capitalize the first letter and ensure it matches the ID
           var sectionId = 'view' + section.charAt(0).toUpperCase() + section.slice(1);
           
           // Show the selected section and hide others
           $('#' + sectionId).show().siblings('div[id^="view"]').hide();
           
           // Set the active class on the nav
           $('.nav-link').removeClass('active');
           $('.nav-link[href="?section=' + section + '"]').addClass('active');
       } catch (error) {
           console.error('Error setting up the dashboard:', error);
       }
   });
</script>
<script>
   $(document).ready(function() {
    // Initialize Select2 for all relevant fields
    $('#country-select_update, #company-size-select_update, #job-title-select_update, #job-level-select_update, #industry_update').select2({
        placeholder: function() {
            $(this).data('placeholder');
        },
        allowClear: true
    });
   
    $('#editCampModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
   
        // Extract data attributes
        var data = button.data();
        var modal = $(this);
        console.log('ID:', data.id); // Check if ID is being set correctly

        // Populate the modal fields
        modal.find('#id_update').val(data.id);
        modal.find('#camp_code_update').val(data.camp_code);
        modal.find('#communication_id_update').val(data.communication_id);
        modal.find('#camp_name_update').val(data.camp_name);
        modal.find('#camp_start_date_update').val(data.camp_start_date);
        modal.find('#camp_end_date_update').val(data.camp_end_date);
        modal.find('#first_delivery_date_update').val(data.first_delivery_date);
        modal.find('#weekly_lead_update').val(data.weekly_lead);
        modal.find('#lead_goal_update').val(data.lead_goal);
        modal.find('#delivered_lead_update').val(data.delivered_lead);
        modal.find('#undelivered_lead_update').val(data.undelivered_lead);
        modal.find('#pending_lead_update').val(data.pending_lead);
        modal.find('#extra_lead_update').val(data.extra_lead);
        modal.find('#generated_lead_update').val(data.generated_lead);
   
        // Handle delivery days checkboxes
      // Handle delivery days checkboxes
    var deliveryDaysArray = data.delivery_days ? data.delivery_days.split(',').map(day => day.trim()) : [];
    modal.find('input[name="delivery_days[]"]').each(function () {
        $(this).prop('checked', deliveryDaysArray.includes($(this).val()));
    });
   //  var deliveryDaysArray = data.delivery_days ? data.delivery_days.split(',') : [];
   //  modal.find('input[name="delivery_days[]"]').each(function () {
   //      $(this).prop('checked', deliveryDaysArray.includes($(this).val()));
   //  });
      //   // Populate multi-select elements
      //   var setMultiSelectValues = function(selector, values) {
      //       var valuesArray = values.split(',');
      //       var select = modal.find(selector);
      //       select.val(valuesArray).trigger('change');
      //   };
   
      //   setMultiSelectValues('#country-select_update', data.country);
      //   setMultiSelectValues('#company-size-select_update', data.company_size);
      //   setMultiSelectValues('#job-title-select_update', data.job_title);
      //   setMultiSelectValues('#job-level-select_update', data.job_level);
      //   setMultiSelectValues('#industry_update', data.industry);
   
      //   // Set selected value for custom question
      //   modal.find('#custm_que_update').val(data.custm_que);
   
        // Set selected value for camp_status
        modal.find('#camp_status_update').val(data.camp_status);
    });
   });
   
</script>
<!-- VIEW SUB MODAL STARTS -->
<script>
$(document).ready(function() {
    // When a link with class 'view-details' is clicked
    $('.view-details').on('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        var id = $(this).data('id'); // Get the ID from data attribute

        // Make an AJAX request to fetch campaign details
        $.ajax({
            url: 'http://localhost/crm1/fetch-campaign-details.php', // URL to the PHP file that fetches the campaign details
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $('#viewSubModal').find('.modal-body').html(response); // Update the modal body with the fetched data
                $('#viewSubModal').modal('show'); // Show the modal
            },
            error: function(xhr, status, error) {
                $('#viewSubModal').find('.modal-body').html('<p>Error loading campaign details: ' + error + '</p>');
                $('#viewSubModal').modal('show'); // Show the modal even if there's an error
            }
        });
    });
});
</script>

<!-- VIEW SUB MODAL ENDS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->