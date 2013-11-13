<?php
require("header.php");
include 'db_lib.php';
?>

<?php 
$userStatsObj = new UserStats();
$a_id = 1;
$sentiment = 1;
$initial_sentiment = -1;
$userStatsObj->update_user_points($_SESSION['userid'], $a_id, $sentiment, $initial_sentiment);
$needfooter = 1;
$back_link = "user_home.php";
$user = new User();
$alist = get_leaderboard_alltime();  
$acount = count($alist);       
$mlist = get_leaderboard_monthly();  
$mcount = count($mlist); 
$wlist = get_leaderboard_weekly();  
$wcount = count($wlist);
                      
?>
 
<div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-collapsed="false">
<h4>All-Time Leaderboard</h4> 
<ul data-role="listview" >
<?php 
for($i = 1; $i <= $acount; $i++) 
{
	$u = $user->get_user_info_by_id($alist[$i]['id']);
 	echo "<li><div class='ui-grid-a'><div class='ui-block-a'>".$i.". ".$u['userid']."</div><div class='ui-block-b'>".$alist[$i]['points']." </div></div></li>";
} 
?>  
</ul>
</div>

 
<div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
<h4>Monthly Leaderboard</h4> 
<ul data-role="listview" >
<?php 
for($i = 1; $i <= $mcount; $i++) 
{
	$u = $user->get_user_info_by_id($mlist[$i]['id']);
 	echo "<li><div class='ui-grid-a'><div class='ui-block-a'>".$i.". ".$u['userid']."</div><div class='ui-block-b'>".$mlist[$i]['points']." </div></div></li>";
} 
?>  
</ul>
</div>

 
<div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
<h4>Weekly Leaderboard</h4> 
<ul data-role="listview" >
<?php 
for($i = 1; $i <= $wcount; $i++) 
{
	$u = $user->get_user_info_by_id($wlist[$i]['id']);
 	echo "<li><div class='ui-grid-a'><div class='ui-block-a'>".$i.". ".$u['userid']."</div><div class='ui-block-b'>".$wlist[$i]['points']." </div></div></li>";
} 
?>  
</ul>
</div>
     
<?php
require("footer.php");
?>