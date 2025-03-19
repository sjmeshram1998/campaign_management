<?php
session_start(); // Ensure session is started

require 'vendor/autoload.php'; // Include Composer's autoload
use PhpOffice\PhpSpreadsheet\IOFactory;

// Database connection (ensure this file contains the correct connection details)
include('database.php');

if (isset($_FILES['import-file']) && $_FILES['import-file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['import-file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import-file']['tmp_name'];

        try {
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            if (empty($data)) {
                throw new Exception("No data found in the Excel file.");
            }

            // Prepare the SQL query
            $query = "
                UPDATE campaign_details SET
                    file_no = ?, quarter = ?, channel_id = ?, communication_id = ?, camp_name = ?, camp_start_date = ?, camp_end_date = ?, delivery_days = ?,
                    lead_goal = ?, weekly_lead = ?, delivered_lead = ?, generated_lead = ?, undelivered_lead = ?, pending_lead = ?, extra_lead = ?,
                    named_acc = ?, exclusions = ?, first_delivery_date = ?, country = ?, company_size = ?, job_title = ?, job_level = ?, 
                    industry = ?, custm_que = ?, camp_status = ?, notes = ?, duration = ?
                WHERE camp_code = ?
            ";

            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $success = true;
            $updatedRecordsCount = 0;
            $failedRecordsCount = 0;

            foreach ($data as $rowIndex => $row) {
                if ($rowIndex == 0 || count($row) < 28) {
                    continue;
                }

                // Extract data from the row
                $camp_code = trim($row[0]);
                if (empty($camp_code)) {
                    continue;
                }

                $file_no = trim($row[1]);
                $quarter = trim($row[2]);
                $channel_id = trim($row[3]);
                $communication_id = trim($row[4]);
                $camp_name = trim($row[5]);
                $camp_start_date = trim($row[6]);
                $camp_end_date = trim($row[7]);
                $delivery_days = trim($row[8]);
                $lead_goal = intval(trim($row[9]));
                $weekly_lead = intval(trim($row[10]));
                $delivered_lead = intval(trim($row[11]));
                $generated_lead = intval(trim($row[12]));

                $undelivered_lead = max(0, $generated_lead - $delivered_lead);
                $pending_lead = max(0, $lead_goal - $delivered_lead);
                $extra_lead = max(0, $generated_lead - $lead_goal);

                $named_acc = trim($row[16]);
                $exclusions = trim($row[17]);
                $first_delivery_date = trim($row[18]);
                $country = trim($row[19]);
                $company_size = trim($row[20]);
                $job_title = trim($row[21]);
                $job_level = trim($row[22]);
                $industry = trim($row[23]);
                $custm_que = trim($row[24]);
                $camp_status = trim($row[25]);
                $notes = trim($row[26]);
                $duration = trim($row[27]);

                // Bind parameters
                $bind_result = $stmt->bind_param('isiisssiiiiiiiisssssssssssii',
                    $file_no, $quarter, $channel_id, $communication_id, $camp_name, $camp_start_date, $camp_end_date, $delivery_days,
                    $lead_goal, $weekly_lead, $delivered_lead, $generated_lead, $undelivered_lead, $pending_lead, $extra_lead,
                    $named_acc, $exclusions, $first_delivery_date, $country, $company_size, $job_title, $job_level, $industry, 
                    $custm_que, $camp_status, $notes, $duration, $camp_code
                );

                if ($bind_result === false) {
                    throw new Exception('Bind failed: ' . htmlspecialchars($stmt->error));
                }

                if ($stmt->execute()) {
                    if ($conn->affected_rows > 0) {
                        $updatedRecordsCount++;
                    } else {
                        $failedRecordsCount++;
                    }
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
            }

            $_SESSION['showCampUpdateAlert'] = $success 
                ? "Successfully updated $updatedRecordsCount records. "  
                // $failedRecordsCount records were not updated.
                : "Update failed due to errors.";

        } catch (Exception $e) {
            $_SESSION['showCampUpdateAlert'] = "Error: " . $e->getMessage();
            $success = false;
        } finally {
            if (isset($stmt)) $stmt->close();
            if (isset($conn)) $conn->close();
        }
    } else {
        $_SESSION['showCampUpdateAlert'] = "Invalid file type. Allowed types: xls, csv, xlsx.";
    }
} else {
    $_SESSION['showCampUpdateAlert'] = "File upload error: " . $_FILES['import-file']['error'];
}

header('Location: http://localhost/crm1/admin-dashboard.php');
exit;
?>
