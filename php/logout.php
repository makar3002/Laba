<?php
session_start();
session_destroy();
$location = $_SERVER['HTTP_REFERER'];
header("Location: $location");
?>
