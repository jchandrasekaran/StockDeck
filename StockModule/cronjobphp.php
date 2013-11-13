<?php 
require("header.php");
include 'db_lib.php';


executeCronJob();
?>
<?php
require("footer.php");
?>