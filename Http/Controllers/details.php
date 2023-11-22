<?php
use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$heading = "1.88 Million US Wildfires";

// Pagination settings
$results_per_page = 25;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$forest = $_GET['forest'];
$start_index = ($current_page - 1) * $results_per_page;

$query = <<<QUERY
    SELECT 
        FPA_ID, 
        NWCG_REPORTING_UNIT_NAME, 
        FIRE_NAME, 
        STAT_CAUSE_DESCR, 
        STRFTIME('%Y-%m-%d',DISCOVERY_DATE) DISCOVERY_DATE,
        STRFTIME('%H:%M',substr(DISCOVERY_TIME, 1, 2) || ':' || substr(DISCOVERY_TIME, 3, 2)) AS DISCOVERY_TIME
    FROM Fires 
    WHERE NWCG_REPORTING_UNIT_NAME = :forest
        LIMIT :start, :limit
QUERY;

$forests = $db->query($query,[
    ':start'=> $start_index,
    ':limit'=>$results_per_page,
    ':forest'=>$forest,
])->fetchAll(PDO::FETCH_ASSOC);

$query = <<<QUERY
    SELECT COUNT(*) FROM 
        (SELECT NWCG_REPORTING_UNIT_NAME 
            FROM Fires 
            WHERE NWCG_REPORTING_UNIT_NAME = :forest)
QUERY;

$total_results = $db->query($query,[':forest'=>$forest])->fetch()[0];
$total_pages = ceil($total_results / $results_per_page);
// Determine the range of displayed pages
$visible_page_range = 5;
$start_display_page = max(1, min($current_page - floor($visible_page_range / 2), $total_pages - $visible_page_range + 1));
$end_display_page = min($total_pages, $start_display_page + $visible_page_range - 1);

view('details.view.php', [
    'forest' => $forest,
    'heading' => "Forest: {$forest}",
    'forests' => $forests,
    'start_display_page' => $start_display_page,
    'end_display_page' => $end_display_page,
    'total_pages' => $total_pages,
    
]);