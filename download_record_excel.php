<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Protection;

// Database connection
include('database.php');

if (!isset($_GET['communication_id'])) {
    die("No communication id specified.");
}

$communication_id = $_GET['communication_id'];

// Query to get the data for the specific record
$stmt = $conn->prepare("SELECT * FROM campaign_details WHERE communication_id = ?");
$stmt->bind_param("i", $communication_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Record not found.");
}

$row = $result->fetch_assoc();

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$headers = [
    
    'Campaign Code', 'Communication ID','Channel ID', 'File No', 'Quarter', 
    'Campaign Name', 'Start Date', 'End Date', 'Delivery Days', 'Lead Goal',
    'Weekly Leads', 'Delivered Lead', 'Generated Lead', 'Undelivered Lead',
    'Pending Lead', 'Extra Lead', 'Named Account', 'Exclusions', 
    'First Delivery Date', 'Country', 'Company Size', 'Job Titles', 
    'Job Level', 'Industry', 'Custom Question', 'Campaign Status', 
    'Notes', 'Durations'
];
$sheet->fromArray($headers, NULL, 'A1');

// Populate the sheet with data
$data = [
    
    $row['camp_code'], // Column B.
    $row['communication_id'], // Column A
    $row['channel_id'], // Column C.
    $row['file_no'], // Column D
    $row['quarter'], // Column E
                        
    
    $row['camp_name'], // Column F
    $row['camp_start_date'], // Column G
    $row['camp_end_date'], // Column H
    $row['delivery_days'], // Column I
    $row['lead_goal'], // Column J
    $row['weekly_lead'], // Column K
    $row['delivered_lead'], // Column L
    $row['generated_lead'], // Column M
    $row['undelivered_lead'], // Column N
    $row['pending_lead'], // Column O
    $row['extra_lead'], // Column P
    $row['named_acc'], // Column Q
    $row['exclusions'], // Column R
    $row['first_delivery_date'], // Column S
    $row['country'], // Column T
    $row['company_size'], // Column U
    $row['job_title'], // Column V
    $row['job_level'], // Column W
    $row['industry'], // Column X
    $row['custm_que'], // Column Y
    $row['camp_status'], // Column Z
    $row['notes'], // Column AA
    $row['duration'] // Column AB
];
$sheet->fromArray($data, NULL, 'A2');

// Protect the sheet but leave all cells unlocked except the specified columns
$sheet->getProtection()->setSheet(true);
$sheet->getProtection()->setSort(false);
$sheet->getProtection()->setInsertRows(false);
$sheet->getProtection()->setDeleteRows(false);
$sheet->getProtection()->setFormatCells(false);
$sheet->getProtection()->setFormatColumns(false);

// Define locked columns
$lockedColumns = [
    'B2:B100', // Campaign Id
    'N2:N100', // Undelivered Lead
    'O2:O100', // Pending Lead
    'P2:P100'  // Extra Lead
];

// Lock specific columns
foreach ($lockedColumns as $range) {
    $sheet->getStyle($range)->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);
}

// Define unlocked columns
$unlockedColumns = [
    'A2:A100',
    'C2:M100', // Columns from B to L (adjust as needed)
    'Q2:Z100'  // Columns from P to Z (adjust as needed)
];

// Unlock specific columns
foreach ($unlockedColumns as $range) {
    $sheet->getStyle($range)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
}

// Create a writer and save the file to a temporary location
$writer = new Xlsx($spreadsheet);
$tempFile = tempnam(sys_get_temp_dir(), 'excel');
$writer->save($tempFile);

// Send the file to the browser for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="campaign_record.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

// Clean up
unlink($tempFile);
exit();
?>
