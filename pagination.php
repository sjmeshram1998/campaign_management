<?php
// Include database connection
include("database.php");

// Define pagination limit
$limit = 10;

// Get current page and section
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$section = isset($_GET['section']) ? htmlspecialchars($_GET['section']) : 'dashboard';

// Ensure page is a valid number
$page = ($page <= 0) ? 1 : $page;
$offset = ($page - 1) * $limit;

// SQL query for total number of records
$search_query = '';
$search_param = '';
if (isset($_GET['search'])) {
    $camp_code = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = "WHERE camp_code LIKE ?";
    $search_param = "%$camp_code%";
}
$sql = "SELECT COUNT(*) as total FROM campaign_details $search_query";
$count_stmt = $conn->prepare($sql);

if ($count_stmt) {
    if ($search_query) {
        $count_stmt->bind_param('s', $search_param);
    }
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total_records = $count_result->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $limit);
} else {
    die("Failed to prepare SQL statement for counting records.");
}

// Output paginated data
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination">';

// Previous button
if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?section=' . $section . '&page=' . ($page - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
}

// Determine the range of pages to display
$start_page = max(1, $page - 5); // Show up to 5 pages before the current page
$end_page = min($total_pages, $page + 5); // Show up to 5 pages after the current page

// Adjust the start and end pages if there are fewer than 10 pages
if ($total_pages > 10) {
    if ($start_page == 1) {
        $end_page = min(10, $total_pages); // Adjust end page when start page is at the beginning
    } elseif ($end_page == $total_pages) {
        $start_page = max($total_pages - 9, 1); // Adjust start page when end page is at the end
    }
}

// Page number links
for ($i = $start_page; $i <= $end_page; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='?section=$section&page=$i'>$i</a></li>";
}

// Next button
if ($page < $total_pages) {
    echo '<li class="page-item"><a class="page-link" href="?section=' . $section . '&page=' . ($page + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
}

echo '</ul>';
echo '</nav>';
?>
