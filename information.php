<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/information.php";
require "utils/render_tables.php";


check_authorized();
?>

<html>
<head>
    <title>АСУ</title>
    <link rel="stylesheet" href="static/style/style.css">
    <link rel="stylesheet" href="static/style/content.css">
    <link rel="stylesheet" href="static/style/filters.css">
    <script src="static/js/main-script.js"></script>
    <meta charset="utf-8">
</head>
<body>
<?php
include("navigation/menu.php");

$selected_filter = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['filter'] : 'docs';

include("navigation/filters/info/" . $selected_filter . ".php");
include("content/information/show_information.php");
include("navigation/footer.php");
?>
</body>
</html>
