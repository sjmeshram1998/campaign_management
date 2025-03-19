<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['edited_excel_file'])) {
    $file = $_FILES['edited_excel_file']['tmp_name'];
    $original_camp_code = $_POST['original_camp_code'];

    if ($file) {
        try {
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // Remove headers
            $header = array_shift($data);

            // Database connection
            include('database.php');

            // Update database record
            $stmt = $conn->prepare("UPDATE campaigns SET file_no = ?, quarter = ?, channel_id = ?, communication_id = ?, camp_name = ?, camp_start_date = ?, camp_end_date = ?, delivery_days = ?, lead_goal = ?, weekly_lead = ?, delivered_lead = ?, generated_lead = ?, undelivered_lead = ?, pending_lead = ?, extra_lead = ?, named_acc = ?, exclusions = ?, first_delivery_date = ?, country = ?, company_size = ?, job_title = ?, job_level = ?, industry = ?, custm_que = ?, camp_status = ?, notes = ?, duration = ? WHERE camp_code = ?");
            $stmt->bind_param("ssssssssssssssssssssssssss", $data[0][1], $data[0][2], $data[0][3], $data[0][4], $data[0][5], $data[0][6], $data[0][7], $data[0][8], $data[0][9], $data[0][10], $data[0][11], $data[0][12], $data[0][13], $data[0][14], $data[0][15], $data[0][16], $data[0][17], $data[0][18], $data[0][19], $data[0][20], $data[0][21], $data[0][22], $data[0][23], $data[0][24], $data[0][25], $data[0][26], $data[0][27], $original_camp_code);
            $stmt->execute();
            $stmt->close();

            echo "Data updated successfully!";
        } catch (Exception $e) {
            echo "Error loading file: " . $e->getMessage();
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    echo "Invalid request.";
}
?>
