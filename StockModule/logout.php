<?php
ob_start();
		
require("header.php");
include 'db_lib.php';
session_destroy();
header( 'Location: menu.php' );
require("footer.php");
?>
