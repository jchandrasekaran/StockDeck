<?php
require("header.php");
include 'db_lib.php';

$needfooter = 1;
$backlink = "grade.php"
?>


<?php
$user = $_SESSION['userid'];
$symbol = strtoupper($_REQUEST['stock']);
$date = "2013-04-08";
$article = new Article();
$article_list = $article->get_articles_by_symbol($symbol, $date, $user);
//echo "<pre>";
//print_r($article_list);
//echo "</pre>";
$i = 1;
$total = $article_list[0]['total'];
$graded = $article_list[0]['graded'];
?>
<h3><?php echo $symbol; ?></h3>
<h4><?php echo "Articles found: ".$total."<br> Articles already graded: ".$graded."<br>"; ?></h4>

<?php 
if($total > 0) {
$dt = $article_list[1]['date'];
?>       
<ul data-role="listview" data-count-theme="c" data-inset="true">
 <li data-role="list-divider"><?php echo $article_list[1]['date']; ?></li>

<?php for($i = 1; $i <= $total; $i++) { 
	if ($dt != $article_list[$i]['date'])
	{
		$dt = $article_list[$i]['date'];
	?>
	<li data-role="list-divider"><?php echo $article_list[$i]['date']; ?></li>
	<?php } ?>
    <li><a href="grade_article.php?id=<?php echo $article_list[$i]['a_id'].'&sentiment='.$article_list[$i]['status'].'&stock='.$symbol; ?>"><?php echo $article_list[$i]['title']; ?> <span class="ui-li-count"><?php if($article_list[$i]['status'] >= 1) {echo "Graded"; } else { echo "Ungraded"; } ?></span></a></li>
<?php } ?>    
</ul>
<?php } else {}?>

       
<?php
require("footer.php");
?>