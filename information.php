<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/information.php";
require "utils/render_tables.php";


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

$selected_filter = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['filter'] : 'docs';

$filters[$_POST['filter']] = 'selected';

include("navigation/filters/info/filters.php");
include("content/information/show_information.php");
include("navigation/footer.php");
?>
</body>
</html>
