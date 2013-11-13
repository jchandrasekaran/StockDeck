<?php
require("header.php");
include 'db_lib.php';
?>

<?php
$needfooter = 1;
    $backbutton = 1;
    $homebutton = 1;
    $backlink = "search_stock.php";
    $userlabel = 0;

$userObj = new User();
$user_info = $userObj->get_user_info_by_id($_SESSION['userid']);
$userStatsObj = new UserStats();
$user_stats_info = $userStatsObj->getUserStatsAlltime($_SESSION['userid']);
$user_stats_monthly_info = $userStatsObj->getUserStatsMonthly($_SESSION['userid']);
$user_stats_weekly_info = $userStatsObj->getUserStatsWeekly($_SESSION['userid']);

?>
       <!-- <div data-role="collapsible-set" data-theme="c" data-content-theme="d"> -->
            
                <ul id="user_info" data-role="listview" data-divider-theme="b"
        data-inset="true">
            <li data-role="list-divider" role="heading">
                Account Information
            </li>
           

            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Name:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_info['firstname']." ".$user_info['lastname']; ?>
           		 </div>
           	 </div>
            </li>
           
        	 <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Username:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_info['userid']; ?>
           		 </div>
           	 </div>
            </li>
        
             <li data-role="list-divider" role="heading">
                All-time Stats
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Total articles graded:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_info['graded']; ?>
           		 </div>
           	 </div>
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Points:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_info['points']; ?>
           		 </div>
           	 </div>
            </li>
            
            <li data-role="list-divider" role="heading">
                Monthly Stats
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Total articles graded:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_monthly_info['graded']; ?>
           		 </div>
           	 </div>
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Points:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_monthly_info['points']; ?>
           		 </div>
           	 </div>
            </li>
            
            <li data-role="list-divider" role="heading">
                Weekly Stats
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Total articles graded:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_weekly_info['graded']; ?>
           		 </div>
           	 </div>
            </li>
            
            <li data-theme="c">
             <div class="ui-grid-a">
                <div class="ui-block-a">
                 Points:
                </div>
            	<div class="ui-block-b">
            	<?php echo $user_stats_weekly_info['points']; ?>
           		 </div>
           	 </div>
            </li>
            
            
        </ul>
       
        <!-- </div> -->
<?php
require("footer.php");
?>