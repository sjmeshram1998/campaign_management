<?php

include('database.php');
include('header.php');

// Example query - update as necessary
$query = "SELECT * FROM campaign_details";
$result = $conn->query($query);

if (!$result) {
    die("Error: " . $conn->error);
}
?>

<div class="container">
    <h1>Campaign List</h1>
    <?php
    if (isset($_SESSION['showCampAddAlert']) && $_SESSION['showCampAddAlert']) {
        $alertMessage = $_SESSION['showCampAddAlert'];
        $alertParts = explode('|', $alertMessage, 2);
        $alertType = $alertParts[0];
        $alertText = isset($alertParts[1]) ? $alertParts[1] : '';

        $alertClass = ($alertType === 'success') ? 'alert-success' : 'alert-danger';
        echo '<div class="alert ' . $alertClass . '">';
        echo '<strong>' . htmlspecialchars($alertText, ENT_QUOTES) . '</strong>';
        echo '</div>';

        $_SESSION['showCampAddAlert'] = false;
    }
    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
                    <th scope="col">Campaign Id</th>
                    <th scope="col">File No</th>
                    <th scope="col">Quarter</th>
                    <th scope="col">Channel ID</th>
                    <th scope="col">Communication ID</th>
                    <th scope="col">Campaign Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Delivery Days</th>
                    <th scope="col">Lead Goal</th>
                    <th scope="col">Weekly Leads</th>
                    <th scope="col">Delivered Lead</th>
                    <th scope="col">Generated Lead</th>
                    <th scope="col">Undelivered Lead</th>
                    <th scope="col">Pending Lead</th>
                    <th scope="col">Extra Lead</th>
                    <th scope="col">Named Account</th>
                    <th scope="col">Exclusions</th>
                    <th scope="col">First Delivery Date</th>
                    <th scope="col">Country</th>
                    <th scope="col">Company Size</th>
                    <th scope="col">Job Titles</th>
                    <th scope="col">Job Level</th>
                    <th scope="col">Industry</th>
                    <th scope="col">Custom Question</th>
                    <th scope="col">Campaign Status</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Durations</th>
                    <th scope="col">Action</th>
                </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                        <td><?php echo htmlspecialchars($row['camp_code']); ?></td>
                        <td><?php echo htmlspecialchars($row['file_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['quarter']); ?></td>
                        <td><?php echo htmlspecialchars($row['channel_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivery_days']); ?></td>
                        <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
                        <td><?php echo htmlspecialchars($row['weekly_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['delivered_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['generated_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['undelivered_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['pending_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['extra_lead']); ?></td>
                        <td><?php echo htmlspecialchars($row['named_acc']); ?></td>
                        <td><?php echo htmlspecialchars($row['exclusions']); ?></td>
                        <td><?php echo htmlspecialchars($row['first_delivery_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['country']); ?></td>
                        <td><?php echo htmlspecialchars($row['company_size']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['job_level']); ?></td>
                        <td><?php echo htmlspecialchars($row['industry']); ?></td>
                        <td><?php echo htmlspecialchars($row['custm_que']); ?></td>
                        <td><span class="badge badge-pill badge-secondary"><?php echo htmlspecialchars($row['camp_status']); ?></span></td>
                        <td><?php echo htmlspecialchars($row['notes']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td>
                        <!-- <a href="edit-campaign.php?camp_code=<?php echo urlencode($row['camp_code']); ?>" class="btn btn-primary">Edit</a> -->
                        <!-- <a href="download-all-data-excel.php" class="btn btn-primary">Download Excel</a> -->
                        <a href="http://localhost/crm1/download_record_excel.php?camp_code=<?php echo urlencode($row['camp_code']); ?>" class="btn btn-primary">Download Excel</a>

                        <form action="http://localhost/crm1/upload_edited_excel.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="edited_excel_file" accept=".xlsx, .xls" required>
                        <input type="hidden" name="original_camp_code" value="<?php echo htmlspecialchars($row['camp_code']); ?>">
                        <button type="submit">Upload and Update</button>
                    </form>

                        </td>
                    </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
