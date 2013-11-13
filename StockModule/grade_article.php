<?php
require("header.php");
include 'db_lib.php';
$needfooter = 1;
$backlink = "article_list.php?stock=".$_REQUEST['stock'];
$submitLink = "grade_article_handler.php?stock=".$_REQUEST['stock'];
$id = $_REQUEST['id'];
$initial_sentiment = $_REQUEST['sentiment'];
$stock = $_REQUEST['stock'];
$uid = $_SESSION['userid'];
$article = new Article();
$article_data = $article->get_article_data_by_id($id);
?>

		<div id="article_content" data-role="collapsible-set" data-theme="c" data-content-theme="d">
            <div data-role="collapsible" data-collapsed="false">
                <h3>
                    <?php echo $article_data['title']; ?>
                </h3>
                <div id='article_text'>
                <p><?php echo $article_data['content']; ?></p>
                </div>
            </div>
        
        <?php
        	
        	if($initial_sentiment > 0)
        	{
        		echo "<br>";
        		if($initial_sentiment == 1)
        			echo "Previously graded by you as Positive News";
        		else if($initial_sentiment == 2)
        			echo "Previously graded by you as Negative News";
        		else if($initial_sentiment == 3)
        			echo "Previously graded by you as Neutral News";
        		else if($initial_sentiment == 4)
        			echo "Previously graded by you as Don't know";
        	}
        ?> 
            
        </div>
        <form id="grade_article_form" action="grade_article_handler.php" method="POST">
        <div id="sentiment_radio" data-role="fieldcontain">
            <fieldset data-role="controlgroup" data-type="vertical">
                <legend>
                    Grade Article:
                </legend>
                <input id="radio1" name="sentiment" value="1" type="radio">
                <label for="radio1">
                    Positive News 
                </label>
                <input id="radio2" name="sentiment" value="2" type="radio">
                <label for="radio2">
                    Negative News
                </label>
                <input id="radio3" name="sentiment" value="3" type="radio">
                <label for="radio3">
                    Neutral
                </label>
                <input id="radio4" name="sentiment" value="4" type="radio" checked>
                <label for="radio4">
                    Don't know
                </label>
            </fieldset>
        </div>
        <fieldset class="ui-grid-a">
                    <div class="ui-block-a"><a data-role="button" data-icon="back" data-iconpos="left" data-theme="d" href='article_list.php?stock=<?php echo $stock; ?>'>Back</a></div>
                    <div class="ui-block-b"><button type="submit" data-icon="check" data-iconpos="right" data-theme="b">Submit</button></div>
        </fieldset>
        <!--<input type="submit" data-icon="check" data-iconpos="left" data-inline="true" value="Submit">

        <input type="submit" data-icon="check" data-iconpos="left" data-inline="true" value="Submit">-->
		
		<input type='hidden' name='initial_sentiment' value='<?php echo $initial_sentiment; ?>' />

		<input type='hidden' name='article_id' value='<?php echo $id; ?>' />
		<input type='hidden' name='stocksym' value='<?php echo $stock; ?>' />

		</form>
		
<?php
require("footer.php");
?>