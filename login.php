<?php
require  "sessions.php";

if (check_session()) {
    header("Location: index.php");
} else {
    require "content/login_page.php";
}
?>