<?php
require  "sessions.php";

check_authorized();
?>

<html>
<head>
    <title>ÀÑÓ</title>
    <link rel="stylesheet" href="static/style/style.css">
    <link rel="stylesheet" href="static/style/content.css">
    <link rel="stylesheet" href="static/style/filters.css">
</head>
<body>
<?php
include("navigation/menu.php");
include("navigation/filters/orders/filters.php");
include("content/orders/orders.php");
include("navigation/footer.php");
?>
</body>
</html>