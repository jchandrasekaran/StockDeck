<?php
ob_start();
		
require("header.php");
include 'db_lib.php';
$userid = $_POST['userid'];
$password = $_POST['password'];
//echo "<br>:".$username.",".$password.":<br>";
//$username = "user3";
//$password = "password";
//echo "Login";
$user = new User();
	
//echo $userid."*".$password;
//echo "9999";
    if($user->authenticate_user($userid, $password))
	{
		//echo "<br>Authenticated";
		//session_destroy();
		//ob_start();
		/*
		if(session_start())
			echo "Yeah";
		else
			echo "Nope";
		*/
			//header( 'Location: menu.php' ) ;
		$userinfo = $user->get_user_info_by_userid($userid);
		$_SESSION['userid'] = $userinfo['id'];
		//ob_end_flush();
		//echo $_SESSION['$userid'];
		header( 'Location: user_home.php' ) ;
	}
	else
	{
		//session_destroy();
		if(isset($_SESSION['userid']))
		{
			header( 'Location: user_home.php' ) ;
		}
		else
		{
			header('Location: login.php?invalid=p' ) ;
		}
		//echo "<br>Invalid User ID";
	}
require("footer.php");
?>
