<?php
// Include the database connection file
include 'database.php';
$search_query = '';
$search_param = '';
if (isset($_GET['search'])) {
    $communication_id = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = "WHERE communication_id LIKE ?";
    $search_param = "%$communication_id%";
}
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
} else {
    die("Failed to prepare SQL statement.");
}
$conn->close();





?>
