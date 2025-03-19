<?php
session_start(); // Ensure session is started

require 'vendor/autoload.php'; // Include Composer's autoload
use PhpOffice\PhpSpreadsheet\IOFactory;

// Database connection
include('database.php');

// Check if a file was uploaded
if (isset($_FILES['import-file']) && $_FILES['import-file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['import-file']['name'];
    $file_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed_ext = ['xls', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import-file']['tmp_name'];
        $original_communication_id = isset($_POST['original_communication_id']) ? trim($_POST['original_communication_id']) : '';

        if (empty($original_communication_id)) {
            $_SESSION['showCampUpdateAlert'] = "Original communication id  is missing.";
            header('Location: admin-dashboard.php');
            exit;
        }

        try {
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            // Debugging: Log the data to verify
            error_log("Data loaded from spreadsheet: " . print_r($data, true));

            if (empty($data) || count($data) < 2) {
                throw new Exception("No data found or incorrect format.");
            }

            // Skip the header row
            $row = $data[1]; // Assuming the data to update is in the second row

            if (count($row) < 28) {
                throw new Exception("Not enough columns in the data.");
            }

            // Extract data from the row
            $communication_id = $row[1]; // Assuming camp_code is in the first column

            // Check if the camp_code matches the original camp_code
            if ($communication_id !== $original_communication_id) {
                throw new Exception("The communication id in the file does not match the provided communication id.");
            }

            // Calculate automatically updated fields
            $generated_lead = intval($row[12]);
            $delivered_lead = intval($row[11]);
            $lead_goal = intval($row[9]);

            $undelivered_lead = intval($row[13]);
            // $undelivered_lead = max(0, $generated_lead - $delivered_lead); //13
            $pending_lead = max(0, $lead_goal - $delivered_lead); //14
            $extra_lead = intval($row[15]);
            // $extra_lead = max(0, $generated_lead - $lead_goal); //15

            // Prepare the SQL query to update the specific campaign
            $query = "
            UPDATE campaign_details SET
              camp_code = ?, channel_id = ?, file_no = ?,  quarter = ?, camp_name = ?, camp_start_date = ?, camp_end_date = ?, delivery_days = ?,
                lead_goal = ?, weekly_lead = ?, delivered_lead = ?, generated_lead = ?, undelivered_lead = ?, pending_lead = ?, extra_lead = ?,
                named_acc = ?, exclusions = ?, first_delivery_date = ?, country = ?, company_size = ?, job_title = ?, job_level = ?, 
                industry = ?, custm_que = ?, camp_status = ?, notes = ?, duration = ?
            WHERE communication_id = ?
            ";

            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            // Assign values to variables
            $camp_code = $row[0];
            $channel_id = intval($row[2]);
            $file_no = intval($row[3]);
            $quarter = $row[4];
            $camp_name = $row[5];
            $camp_start_date = $row[6];

            $camp_end_date = $row[7];
            $delivery_days = $row[8];
           
            $weekly_lead = intval($row[10]);
            $named_acc = $row[16];
            $exclusions = $row[17];
            $first_delivery_date = $row[18];
            $country = $row[19];
            $company_size = $row[20];
            $job_title = $row[21];
            $job_level = $row[22];
            $industry = $row[23];
            $custm_que = $row[24];
            $camp_status = $row[25];
            $notes = $row[26];
            $duration = $row[27];
            $communication_id = $original_communication_id;

            // Bind parameters
            $stmt->bind_param(
                'siisssssiiiiiiissssssssssssi',
                $camp_code,$channel_id, $file_no, $quarter,   $camp_name, $camp_start_date, $camp_end_date, $delivery_days,
                $lead_goal, $weekly_lead, $delivered_lead, $generated_lead, $undelivered_lead, $pending_lead, $extra_lead,
                $named_acc, $exclusions, $first_delivery_date, $country, $company_size, $job_title, $job_level, 
                $industry, $custm_que, $camp_status, $notes, $duration, $communication_id
            );

            if ($stmt->execute()) {
                if ($conn->affected_rows > 0) {
                    $_SESSION['showCampUpdateAlert'] = "Record updated successfully.";
                } else {
                    $_SESSION['showCampUpdateAlert'] = "No records updated. Make sure the communication id matches.";
                }

            } else {
                throw new Exception("Error executing statement: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            $_SESSION['showCampUpdateAlert'] = "Error: " . $e->getMessage();
        }

        $conn->close();
        header('Location: http://localhost/crm1/admin-dashboard.php');
        exit;

    } else {
        $_SESSION['showCampUpdateAlert'] = "Invalid file type.";
        header('Location: http://localhost/crm1/admin-dashboard.php');
        exit;
    }
} else {
    $_SESSION['showCampUpdateAlert'] = "No file was uploaded.";
    header('Location: http://localhost/crm1/admin-dashboard.php');
    exit;
}
