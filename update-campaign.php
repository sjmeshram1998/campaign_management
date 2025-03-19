<?php
include('database.php'); // Ensure this file includes your database connection
session_start();

if (isset($_POST['submit'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // Sanitize input data
    $id = isset($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : 0;

    // Check if the id is valid
    if ($id === false || $id <= 0) {
        $_SESSION['showUpdateCampAlertInvalid'] = true;
        header("Location: http://localhost/crm1/admin-dashboard.php");
        exit;
      
    }
    $camp_code = $_POST['camp_code'] ?? '';
    $communication_id = $_POST['communication_id'] ?? '';
    $camp_name = $_POST['camp_name'] ?? '';
    $camp_start_date = $_POST['camp_start_date'] ?? '';
    $camp_end_date = $_POST['camp_end_date'] ?? '';
    $first_delivery_date = $_POST['first_delivery_date'] ?? '';

    // Retrieve and process delivery days
    $delivery_days1 = $_POST['delivery_days'] ?? [];
    // $delivery_days = implode(",", $delivery_days1); // Convert array to comma-separated string
    $delivery_days = implode(",", array_map('trim', $delivery_days1));
    // Retrieve and process leads
    $lead_goal = isset($_POST['lead_goal']) ? intval($_POST['lead_goal']) : 0;
    $weekly_lead = isset($_POST['weekly_lead']) ? intval($_POST['weekly_lead']) : 0;
    $delivered_lead = isset($_POST['delivered_lead']) ? intval($_POST['delivered_lead']) : 0;
    $generated_lead = isset($_POST['generated_lead']) ? intval($_POST['generated_lead']) : 0;
    $undelivered_lead = isset($_POST['undelivered_lead']) ? intval($_POST['undelivered_lead']) : 0;

    // Compute lead values
    // $undelivered_lead = max(0, $generated_lead - $delivered_lead);
    $pending_lead = max(0, $lead_goal - $delivered_lead);
    // $extra_lead = max(0, $generated_lead - $lead_goal);
    $extra_lead = isset($_POST['extra_lead']) ? intval($_POST['extra_lead']) : 0;
    // Retrieve and process other fields
    // Assuming these fields might be included in your future form updates
    // $country = isset($_POST['country']) ? implode(",", $_POST['country']) : '';
    // $company_size = isset($_POST['company_size']) ? implode(",", $_POST['company_size']) : '';
    // $job_title = isset($_POST['job_title']) ? implode(",", $_POST['job_title']) : '';
    // $job_level = isset($_POST['job_level']) ? implode(",", $_POST['job_level']) : '';
    // $industry = isset($_POST['industry']) ? implode(",", $_POST['industry']) : '';
    // $custm_que = $_POST['custm_que'] ?? '';
    $camp_status = $_POST['camp_status'] ?? '';
    
    // Prepare SQL query
    $stmt = $conn->prepare("UPDATE campaign_details SET 
        camp_code = ?, 
        communication_id = ?, 
        camp_name = ?, 
        camp_start_date = ?, 
        camp_end_date = ?, 
        first_delivery_date = ?, 
        delivery_days = ?, 
        lead_goal = ?, 
        weekly_lead = ?, 
        delivered_lead = ?, 
        undelivered_lead = ?, 
        pending_lead = ?, 
        extra_lead = ?, 
        generated_lead = ?, 
        camp_status = ? 
        WHERE id = ?");

    // Bind parameters
    $stmt->bind_param("sisssssiiiiiiisi", 
        $camp_code, 
        $communication_id,
        $camp_name, 
        $camp_start_date, 
        $camp_end_date, 
        $first_delivery_date, 
        $delivery_days, 
        $lead_goal, 
        $weekly_lead, 
        $delivered_lead, 
        $undelivered_lead, 
        $pending_lead, 
        $extra_lead, 
        $generated_lead, 
        $camp_status, 
        $id
    );

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['showUpdateCampAlert'] = true;
        header("Location: http://localhost/crm1/admin-dashboard.php");
        exit;
    } else {
        // Error handling
        $_SESSION['showUpdateCampAlertFailure'] = true;
        header("Location: http://localhost/crm1/admin-dashboard.php");
        exit;
       
    }

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);
}
?>
