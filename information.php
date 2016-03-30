<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/information.php";
require "utils/render_tables.php";
require "utils/page_type.php";

check_authorized();
?>

<html>
<head>
    <title>ÀÑÓ</title>
    <link rel="stylesheet" href="static/style/style.css">
    <link rel="stylesheet" href="static/style/content.css">
    <link rel="stylesheet" href="static/style/filters.css">
    <script src="static/js/main-script.js"></script>
</head>
<body>
<?php
include("navigation/menu.php");

$page_to_include = page_to_show('information', $_GET);

if ($page_to_include['type'] == 'show') {
    $selected_filter = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['filter'] : 'docs';
    $filters[$_POST['filter']] = 'selected';
    include("navigation/filters/info/filters.php");
}
if (in_array($page_to_include['type'], array('edit', 'delete'))) {
    // TODO: GET DATA FOR EDIT/DELETE
}
include($page_to_include['path']);;

include("navigation/footer.php");
?>
</body>
</html>
