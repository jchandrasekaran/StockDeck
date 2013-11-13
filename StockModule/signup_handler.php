<?php
ob_start();
include 'db_lib.php';

$user = new User();
$userid = $_REQUEST['email'];	
$firstname = $_REQUEST['firstname'];	
$lastname = $_REQUEST['lastname'];	
$password = $_REQUEST['password'];	
$level = 0;
$flag = 0;



    if($user->check_if_user_exists($userid))
	{
		//echo "<br>Authenticated";
		 header( 'Location: login.php?exists=p' ) ;
	}
	else
	{
		$user->create_user_account($userid, $firstname, $lastname, $password, $level, $flag);
		//echo "<br>Invalid User ID";
		header( 'Location: login.php?created=p' ) ;
	}


?>
