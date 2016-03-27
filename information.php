<?php
require  "sessions.php";

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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $selected_filter = $_GET['filter'] ? $_GET['filter'] : 'docs';
}

include("navigation/filters/info/" . $selected_filter . ".php");
include("content/information/show_information.php");
include("navigation/footer.php");
?>
</body>
</html>