<?php
include 'sentiment.class.php';

/*
$examples1 = array(
	1 => 'Weather today is not bad. This cake looks okay. His skills are insane. He is very retarded',
	2 => 'This cake looks good. It is awesome. It smells great. it tastes wonderful',
	3 => 'His skills are insane',
	4 => 'He is very retarded. he is bad. He is crazy and awful',
	5 => 'She is seemingly very agressive',
	6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself',
	7 => 'To be or not to be?',
);
*/
function findSentiment ($example) {		
	$t1 = 0;
	$t2 = 0;
	$t3 = 0;
	$sentiment = new Sentiment();
	
	$temp_array = explode(".",$example);
	
	foreach ($temp_array as $key => $example1) {
		$scores = $sentiment->score($example1);
		$t1 = $t1+$scores['pos'];
		$t2 += $scores['neg'];
		$t3 += $scores['neu'];
	}

	$scores['pos'] = $t1;
	$scores['neg'] = $t2;
	$scores['neu'] = $t3;
	
	$var1 = "";
	
	$max_val = max ($scores);
	if ($max_val == $scores['neu'])
	{
		$var1 = 'neutral';
	}
	else if ($max_val == $scores['pos'])
	{
		$var1 = 'positive';
	}
	else if ($max_val == $scores['neg'])
	{
		$var1 = 'negative';
	}
	return ($var1);
}
?>


