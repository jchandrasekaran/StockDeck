<?php
require("header.php");
include 'db_lib.php';

$needfooter = 1;
$backlink = "search_stock.php"
?>

<?php
$sym = $_REQUEST['stock'];
$objYahooStock = new YahooStock();
//$stock_data = $objYahooStock->getSingleQuote("GLUU","snl1d1t1cv");
//$stock_data = $objYahooStock->getSingleQuote("MSFT","snl1d1t1cv");
$stock_data = $objYahooStock->getSingleQuote($sym,"snl1d1t1cv");
//$objYahooStock->addFormat("snl1d1t1cv"); 
//$objYahooStock->addStock("csco");
//$stock_data = $objYahooStock->getQuotes();
$symbol = $stock_data[0];//"CSCO";
$symbol = trim($symbol,'"');

$company = $stock_data[1];//"Cisco Systems Inc.";
$company = trim($company,'"');
$price = $stock_data[2];//6.83;
$change = $stock_data[5];//0.66;
$change = trim($change,'"');
$chg = $objYahooStock->getStockChange($change);
//print_r($chg);
$change_perc = 2.4;
$volume = $stock_data[6];//1900000;
?>
	<h4 align='center'><?php echo $company." (".$symbol.")"; ?></h4>
       <!-- <div data-role="collapsible-set" data-theme="c" data-content-theme="d"> -->
            <div id='stock_data_heading' data-role="collapsible" data-collapsed="false" data-theme="b">
                <h3>
                     Stock Information
                </h3>
                <ul id="stock_view" data-role="listview" data-divider-theme="b"
        data-inset="true">
            
            <li data-theme="c">
            <?php if($chg[2] == 1) { ?>
              Last Price: <font color="green"><?php echo "$".$price; ?></font>
            <?php } else { ?>
            	Last Price: <font color="red"><?php echo "$".$price; ?></font> 
             <?php } ?> 
               
            </li>
            <li data-theme="c">
            <?php if($chg[2] == 1) { ?>
                Change: <font color="green"><?php echo $chg[0]; ?></font>
              <?php } else { ?>  
                 Change: <font color="red"><?php echo $chg[0]; ?></font>
              <?php } ?>  
            </li>
            <li data-theme="c">
             <?php if($chg[2] == 1) { ?>
                Change Perc: <font color="green"><?php echo $chg[1]; ?></font>
        	 <?php } else { ?>  
        	     Change Perc: <font color="red"><?php echo $chg[1]; ?></font>
             <?php } ?>     
            </li>
            <li data-theme="c">
                Volume: <?php echo $volume; ?>
            </li>
            
        </ul>
            </div>
            <div id='sentiment_data_heading' data-role="collapsible" data-collapsed="false" data-theme="b">
                <h3>
                    Market Sentiment
                </h3>
                <ul id="sentiment_view" data-role="listview" data-divider-theme="b"
        data-inset="true">
            <li data-role="list-divider" role="heading">
                Our Analysis
            </li>
            <li data-theme="c">
                Positive: 
                
            </li>
            <li data-theme="c">
                Negative:
            </li>
            <li data-theme="c">
                Neutral:
            </li>
            <li data-role="list-divider" role="heading">
                Analysis by our Users
            </li>
            <li data-theme="c">
                Positive: 
                
            </li>
            <li data-theme="c">
                Negative:
            </li>
            <li data-theme="c">
                Neutral:
            </li>
            
        </ul>
            </div>
        <form id="grade_article_form" action="portfolio_handler.php" method="POST">
          <a data-role="button" data-icon="plus" data-iconpos="left" data-theme="d" href='user_home.php?stock=<?php echo $sym; ?>'>Add to Portfolio</a>

		<input type='hidden' name='stock_sym' value='<?php echo $sym; ?>' />

		</form>
        <!-- </div> -->
<?php
require("footer.php");
?>