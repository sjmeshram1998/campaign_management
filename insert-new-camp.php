<?php
session_start(); // Start the session

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Include database connection details
include('database.php');

const ALLOWED_EXTENSIONS = ['xls', 'csv', 'xlsx'];
const UPLOAD_ERROR_MESSAGE = "File upload error: ";

if (isset($_POST['insert-new-camp'])) {
    $fileName = $_FILES['import-file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    if (in_array($file_ext, ALLOWED_EXTENSIONS)) {
        $inputFileNamePath = $_FILES['import-file']['tmp_name'];

        if ($_FILES['import-file']['error'] != UPLOAD_ERR_OK) {
            $_SESSION['showCampAddAlert'] = UPLOAD_ERROR_MESSAGE . $_FILES['import-file']['error'];
            header('Location: http://localhost/crm1/admin-dashboard.php');
            exit;
        }

        try {
            $spreadsheet = IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            // Prepare SQL statement
            $insertStmt = $conn->prepare("INSERT INTO campaign_details (
                  communication_id, camp_code, channel_id, file_no, quarter, camp_name, camp_start_date, camp_end_date, delivery_days,
                  lead_goal, weekly_lead, delivered_lead, generated_lead, undelivered_lead, pending_lead,
                  extra_lead, named_acc, exclusions, first_delivery_date, country, company_size, job_title, job_level,
                  industry, custm_que, camp_status, notes, duration
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if (!$insertStmt) {
                $_SESSION['showCampAddAlert'] = "Failed to prepare SQL statement: " . $conn->error;
                header('Location: http://localhost/crm1/admin-dashboard.php');
                exit;
            }

            // Initialize error counters
            $totalRecords = 0;
            $addedRecordsCount = 0;
            $failedRecordsCount = 0;
            $invalidDateCount = 0;
            $blankCommunicationIdCount = 0;
            $blankCampCodeCount = 0;
            $blankCampNameCount = 0;
            $blankStartDateCount = 0;
            $blankEndDateCount = 0;

            foreach ($data as $index => $row) {
                if ($index == 0 || count($row) < 28) {
                    continue; // Skip header row and rows with insufficient columns
                }

                $totalRecords++;

                // Sanitize and validate input data
                $communication_id = filter_var(trim($row[0]), FILTER_SANITIZE_STRING);
                $camp_code = filter_var(trim($row[1]), FILTER_SANITIZE_STRING);
                $channel_id = filter_var(trim($row[2]), FILTER_SANITIZE_STRING);
                $file_no = filter_var(trim($row[3]), FILTER_SANITIZE_STRING);
                $quarter = filter_var(trim($row[4]), FILTER_SANITIZE_STRING);
                $camp_name = filter_var(trim($row[5]), FILTER_SANITIZE_STRING);
                $camp_start_date = filter_var(trim($row[6]), FILTER_SANITIZE_STRING);
                $camp_end_date = filter_var(trim($row[7]), FILTER_SANITIZE_STRING);

                // Sanitize and format delivery_days
                $delivery_days = trim($row[8]);
                $delivery_days_cleaned = preg_replace('/\s*,\s*/', ',', $delivery_days); // Remove spaces around commas

                // Log sanitized delivery_days for debugging
                error_log("Raw delivery_days: $delivery_days");
                error_log("Cleaned delivery_days: $delivery_days_cleaned");

                $lead_goal = is_numeric(trim($row[9])) ? intval(trim($row[9])) : 0;
                $weekly_lead = is_numeric(trim($row[10])) ? intval(trim($row[10])) : 0;
                $delivered_lead = is_numeric(trim($row[11])) ? intval(trim($row[11])) : 0;
                $generated_lead = is_numeric(trim($row[12])) ? intval(trim($row[12])) : 0;
                $undelivered_lead = is_numeric(trim($row[13])) ? intval(trim($row[13])) : 0;

                $pending_lead = max(0, intval($lead_goal) - intval($delivered_lead));
                
                $extra_lead = is_numeric(trim($row[15])) ? intval(trim($row[15])) : 0;

                $named_acc = filter_var(trim($row[16]), FILTER_SANITIZE_STRING);
                $exclusions = filter_var(trim($row[17]), FILTER_SANITIZE_STRING);
                $first_delivery_date = filter_var(trim($row[18]), FILTER_SANITIZE_STRING);
                $country = filter_var(trim($row[19]), FILTER_SANITIZE_STRING);
                $company_size = filter_var(trim($row[20]), FILTER_SANITIZE_STRING);
                $job_title = filter_var(trim($row[21]), FILTER_SANITIZE_STRING);
                $job_level = filter_var(trim($row[22]), FILTER_SANITIZE_STRING);
                $industry = filter_var(trim($row[23]), FILTER_SANITIZE_STRING);
                $custm_que = filter_var(trim($row[24]), FILTER_SANITIZE_STRING);
                $camp_status = !empty($row[25]) ? $row[25] : 'Pending';
                $notes = filter_var(trim($row[26]), FILTER_SANITIZE_STRING);
                $duration = filter_var(trim($row[27]), FILTER_SANITIZE_STRING);

                // Validate communication_id
                if (empty($communication_id)) {
                    $blankCommunicationIdCount++;
                    $failedRecordsCount++;
                    continue; // Skip if communication_id is empty
                }

                // Validate camp_code
                if (empty($camp_code)) {
                    $blankCampCodeCount++;
                    $failedRecordsCount++;
                    continue; // Skip if camp_code is empty
                }

                // Validate camp_name
                if (empty($camp_name)) {
                    $blankCampNameCount++;
                    $failedRecordsCount++;
                    continue; // Skip if camp_name is empty
                }

                // Check if dates are missing
                if (empty($camp_start_date)) {
                    $blankStartDateCount++;
                    $failedRecordsCount++;
                    continue; // Skip if start date is missing
                }

                if (empty($camp_end_date)) {
                    $blankEndDateCount++;
                    $failedRecordsCount++;
                    continue; // Skip if end date is missing
                }

                // Date validation
                try {
                    $startDate = new DateTime($camp_start_date);
                    $endDate = new DateTime($camp_end_date);

                    if ($startDate > $endDate) {
                        $invalidDateCount++;
                        $failedRecordsCount++;
                        continue; // Skip if start date is after end date
                    }
                } catch (Exception $e) {
                    $invalidDateCount++;
                    $failedRecordsCount++;
                    continue;
                }

                // Check if the numeric fields are missing or invalid
                if ($lead_goal < 0 || $weekly_lead < 0 || $delivered_lead < 0) {
                    $failedRecordsCount++;
                    continue; // Skip if any of the numeric fields have invalid values
                }

                // Bind parameters and execute the insert statement
                $insertStmt->bind_param('isiisssssiiiiiiissssssssssss', 
                $communication_id, $camp_code, $channel_id, $file_no, $quarter, $camp_name, $camp_start_date, $camp_end_date, $delivery_days_cleaned, 
                $lead_goal, $weekly_lead, $delivered_lead, $generated_lead, $undelivered_lead, $pending_lead, 
                $extra_lead, $named_acc, $exclusions, $first_delivery_date, $country, $company_size, $job_title, 
                $job_level, $industry, $custm_que, $camp_status, $notes, $duration);

                if ($insertStmt->execute()) {
                    $addedRecordsCount++;
                } else {
                    error_log("Failed to execute statement: " . $insertStmt->error);
                    $failedRecordsCount++;
                }
            }

            // Provide feedback on the import results
            $_SESSION['showCampAddAlert'] = "Total records processed from Excel: $totalRecords. 
                                             Successfully added: $addedRecordsCount. 
                                             Failed records: $failedRecordsCount. 
                                             Records failed due to invalid date or blank date: $invalidDateCount. 
                                             Records failed due to blank Communication Id: $blankCommunicationIdCount. 
                                             Records failed due to blank Camp Code: $blankCampCodeCount. 
                                             Records failed due to blank Camp Name: $blankCampNameCount.";

            $insertStmt->close();
        } catch (Exception $e) {
            $_SESSION['showCampAddAlert'] = "Error loading file: " . $e->getMessage();
        }

        $conn->close();
        header('Location: http://localhost/crm1/admin-dashboard.php');
        exit;
    } else {
        $_SESSION['showCampAddAlert'] = "Invalid File Type";
        header('Location: http://localhost/crm1/admin-dashboard.php');
        exit;
    }
}
?>
