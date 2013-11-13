<?php
require("header.php");
include 'db_lib.php';
//print_r($_SESSION);
//session_start();
//echo $_SESSION['userid'];
$needfooter = 0;
$user = new User();
$userinfo = $user->get_user_info_by_id($_SESSION['userid']);
$userprefs = new UserPrefs();
$objYahooStock = new YahooStock();
if(isset($_REQUEST['stock']))
{
	$userprefs->addToPortfolio($_SESSION['userid'], $_REQUEST['stock']);
}
$portfolio_str = $userprefs->getPortfolio($_SESSION['userid']);
$count = substr_count($portfolio_str, ',');
$slist = explode(',', $portfolio_str);
//print_r($slist);
echo "Welcome ".$userinfo['firstname'].",";
?>
	
	<div data-role="collapsible" data-collapsed="false" data-theme="b" data-content-theme="c">
    <h4>Portfolio</h4>
   <ul data-role="listview">
   <?php
   		if($count > 0)
   		{
   			for($i = 0; $i < $count; $i++)
   			{
   				$stoc = $slist[$i];
   				$stock_data = $objYahooStock->getSingleQuote($stoc,"snl1d1t1cv");
				$symbol = $stock_data[0];//"CSCO";
				$symbol = trim($symbol,'"');
				$company = $stock_data[1];//"Cisco Systems Inc.";
				$company = trim($company,'"');
				$price = $stock_data[2];//6.83;
				$change = $stock_data[5];//0.66;
				$change = trim($change,'"');
				$chg = $objYahooStock->getStockChange($change);
   				echo "<li>";
   				if($chg[2] == 1)
   					echo "<a href='view_analysis.php?stock=".$stoc."'><font color='green'>".$stock_data[1]." (".$stoc.")"."<span class='ui-li-count'><font color='green'>".$price." (".$chg[0].")"."</font></span></font></a></li>";
   				else
   					echo "<a href='view_analysis.php?stock=".$stoc."'><font color='red'>".$stock_data[1]." (".$stoc.")"."<span class='ui-li-count'><font color='red'>".$price." (".$chg[0].")"."</font></span></font></a></li>";
   				echo "</li>";
   			}
   		}
   ?>
          <!--  <li><a href="index.html">Inbox <span class="ui-li-count">12</span></a></li> -->
            
        </ul>
	</div>
        <ul data-role="listview" data-divider-theme="b" data-inset="true">
            <li data-theme="b">
                <a href="search_stock.php" data-transition="slide">
                    View Sentiment
                </a>
            </li>
            <li data-theme="b">
                <a href="grade.php" data-transition="slide">
                    Grade Articles
                </a>
            </li>
             <li data-theme="b">
                <a href="user_info.php" data-transition="slide">
                    View Your Profile
                </a>
            </li>
            <li data-theme="b">
                <a href="leaderboard.php" data-transition="slide">
                    View Leaderboard
                </a>
            </li>
            <li data-theme="b">
                <a href="logout.php" data-transition="slide">
                    Logout
                </a>
            </li>
        </ul>
<?php
require("footer.php");
?>