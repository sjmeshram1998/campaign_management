<?php
// Include database connection
include 'database.php'; // Adjust the path to your actual database connection file

// Ensure $camp_code is defined and sanitized before use
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

if ($id) {
    // Prepare the SQL query
    $sql = "SELECT camp_code, communication_id, camp_name, camp_start_date, camp_end_date, delivery_days, lead_goal, weekly_lead, delivered_lead, pending_lead, generated_lead, named_acc, exclusions,country,job_title, job_level, industry,custm_que, company_size
            FROM `campaign_details` 
            WHERE `id` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        ?>
        <table class="table table-bordered table-responsive">
            <tr>
                <th>Campaign Code</th>
                <td><?php echo htmlspecialchars($row['camp_code']); ?></td>
            </tr>
            <tr>
                <th>Communication ID</th>
                <td><?php echo htmlspecialchars($row['communication_id']); ?></td>
            </tr>
            <tr>
                <th>Campaign Name</th>
                <td><?php echo htmlspecialchars($row['camp_name']); ?></td>
            </tr>
            <tr>
                <th>Start Date</th>
                <td><?php echo htmlspecialchars($row['camp_start_date']); ?></td>
            </tr>
            <tr>
                   
                <th>End Date</th>
                <td><?php echo htmlspecialchars($row['camp_end_date']); ?></td>
            </tr>
            <tr>
                <th>Delivery Days</th>
                <td><?php echo htmlspecialchars($row['delivery_days']); ?></td>
            </tr>
            <tr>
                <th>Lead Goal</th>
                <td><?php echo htmlspecialchars($row['lead_goal']); ?></td>
            </tr>
            <tr>
                <th>Weekly Leads</th>
                <td><?php echo htmlspecialchars($row['weekly_lead']); ?></td>
            </tr>
            <tr>
                <th>Delivered Lead</th>
                <td><?php echo htmlspecialchars($row['delivered_lead']); ?></td>
            </tr>
            <tr>
                <th>Pending Lead</th>
                <td><?php echo htmlspecialchars($row['pending_lead']); ?></td>
            </tr>
            <tr>
                <th>Generated Lead</th>
                <td><?php echo htmlspecialchars($row['generated_lead']); ?></td>
            </tr>
            <tr>
                <th>Named Account</th>
                <td><?php echo htmlspecialchars($row['named_acc']); ?></td>
            </tr>
            <tr>
                <th>Exclusions</th>
                <td><?php echo htmlspecialchars($row['exclusions']); ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><textarea name="country" id="country" class="td-wrap" readonly><?php echo htmlspecialchars($row['country']); ?></textarea></td>
            </tr>
            <tr>
                <th>Job Title</th>
                <td><textarea name="job_title" id="job_title" class="td-wrap" readonly><?php echo htmlspecialchars($row['job_title']); ?></textarea></td>
            </tr>
            <tr>
                <th>Job Level</th>
                <td><textarea name="job_level" id="job_level" class="td-wrap" readonly><?php echo htmlspecialchars($row['job_level']); ?></textarea></td>
              
            </tr>
            <tr>
                <th>Industry</th>
                <td><textarea name="industry" id="industry" col="40" rows="5" class="td-wrap"  readonly><?php echo htmlspecialchars($row['industry']); ?></textarea></td>
            </tr>
            <tr>
                <th>Custom Question</th>
                <td><?php echo htmlspecialchars($row['custm_que']); ?></td>
            </tr>
            <tr>
                <th>Company Size</th>
                <td><textarea name="company_size" id="company_size" class="td-wrap"  readonly><?php echo htmlspecialchars($row['company_size']); ?></textarea></td>
            </tr>
        </table>
        <?php
    } else {
        echo "<p>No details found for the selected campaign.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p>No communication Id  provided.</p>";
}
?>
