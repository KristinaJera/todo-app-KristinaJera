<?php
include('db.php');
session_destroy();
header('Location: ' . SITEURL . 'index.php');
?>