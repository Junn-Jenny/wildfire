<?php
use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$heading = "1.88 Million US Wildfires";

// Pagination settings
$results_per_page = 25;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_index = ($current_page - 1) * $results_per_page;

$query = <<<QUERY
    SELECT NWCG_REPORTING_UNIT_NAME 
        FROM Fires 
        GROUP BY NWCG_REPORTING_UNIT_NAME 
        LIMIT :start, :limit
QUERY;

$fires = $db->query($query,[
    ':start'=> $start_index,
    ':limit'=>$results_per_page,
])->fetchAll(PDO::FETCH_ASSOC);

$query = <<<QUERY
    SELECT COUNT(*) FROM 
        (SELECT NWCG_REPORTING_UNIT_NAME 
            FROM Fires GROUP BY NWCG_REPORTING_UNIT_NAME)
QUERY;

$total_results = $db->query($query)->fetch()[0];
$total_pages = ceil($total_results / $results_per_page);
// Determine the range of displayed pages
$visible_page_range = 5;
$start_display_page = max(1, min($current_page - floor($visible_page_range / 2), $total_pages - $visible_page_range + 1));
$end_display_page = min($total_pages, $start_display_page + $visible_page_range - 1);

view('index.view.php', [
    'heading' => $heading,
    'fires' => $fires,
    'start_display_page' => $start_display_page,
    'end_display_page' => $end_display_page,
    'total_pages' => $total_pages,
    
]);