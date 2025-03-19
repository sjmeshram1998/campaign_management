<?php
include('database.php');
?>

<div class="mt-4" id="viewDuetoday" style="<?php echo htmlspecialchars($section) == 'duetoday' ? 'display: block;' : 'display: none;'; ?>">
   <?php
   $current_date = date('Y-m-d');

   // Retrieve and sanitize parameters
   $offset = isset($offset) ? intval($offset) : 0;
   $limit = isset($limit) ? intval($limit) : 10;

   // Construct the SQL query with LIMIT values embedded directly
   $duetoday_sql = "SELECT camp_code, camp_name, camp_start_date, camp_end_date, lead_goal, camp_status 
                    FROM campaign_details 
                    WHERE camp_start_date <= '$current_date'
                    AND camp_end_date = '$current_date'
                    AND camp_status != 'completed'
                    LIMIT $offset, $limit"; // Embed LIMIT values directly

   // Execute the query
   $result = mysqli_query($conn, $duetoday_sql);

   // Check for errors
   if (!$result) {
       echo "Error: " . mysqli_error($conn);
   } else {
       if (mysqli_num_rows($result) > 0) {
   ?>
   <!-- Table to display data -->
   <table class="table table-bordered table-content table-responsive text-center" id="dueTodayTable">
      <thead>
         <tr>
            <th scope="col">Campaign Id</th>
            <th scope="col">Campaign Name</th>
            <th scope="col">Campaign Start Date</th>
            <th scope="col">Campaign End Date</th>
            <th scope="col">Lead Goal</th>
            <th scope="col">Campaign Status</th>
         </tr>
      </thead>
      <tbody>
         <?php while ($row = mysqli_fetch_assoc($result)) { ?>
         <tr>
            <td><?php echo htmlspecialchars($row['camp_code']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
            <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
            <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
            <td><span class="badge badge-pill badge-danger"><?php echo htmlspecialchars($row['camp_status']); ?></span></td>
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
   <?php include('pagination.php'); ?>
</div>
