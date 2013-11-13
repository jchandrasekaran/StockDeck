<?php
ob_start();
require("header.php");
include 'db_lib.php';
$id = $_REQUEST['article_id'];
$sentiment = intval($_POST['sentiment']);
$initial_sentiment = $_POST['initial_sentiment'];
$uid = $_SESSION['userid'];
$article = new Article();

if($initial_sentiment == 0)
{
	$article->insert_user_sentiment($id, $uid, $sentiment);
	$redirectLink = "Location: article_list.php?stock=".$_REQUEST['stocksym'];
	header( $redirectLink) ;
}
else	
{
	$article->update_user_sentiment($id, $uid, $sentiment, $initial_sentiment);
	$redirectLink = "Location: article_list.php?stock=".$_REQUEST['stocksym'];
	header( $redirectLink) ;
}
    
require("footer.php");
?>
