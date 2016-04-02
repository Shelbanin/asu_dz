<?php
require  "sessions.php";

if (check_session()) {
    header("Location: index.php");
    exit();
} else {
    require "content/login_page.php";
}
?>