<?php

require('connect.php');
class YahooStock {
    
	/**
	 * Array of stock code
	 */
    private $stocks = array();
	
	/**
	 * Parameters string to be fetched	 
	 */
	private $format;

    /**
     * Populate stock array with stock code
	 *
     * @param string $stock Stock code of company    
     * @return void
     */
    public function addStock($stock)
    {
        $this->stocks[] = $stock;
    }
	
	/**
     * Populate parameters/format to be fetched
	 *
     * @param string $param Parameters/Format to be fetched
     * @return void
     */
	public function addFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Get Stock Data
	 *
     * @return array
     */
    public function getQuotes()
    {        
        $result = array();		
		$format = $this->format;
        
        foreach ($this->stocks as $stock)
        {            
			/**
			 * fetch data from Yahoo!
			 * s = stock code
			 * f = format
			 * e = filetype
			 */
            $s = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$stock&f=$format&e=.csv");
           
			/** 
			 * convert the comma separated data into array
			 */
            $data = explode( ',', $s);
			
			/** 
			 * populate result array with stock code as key
			 */
            $result[$stock] = $data;
        }
        return $result;
    }
    
    public function getSingleQuote($stock, $format)
    {        
        $result = array();		
		//$format = $this->format;
        
        //foreach ($this->stocks as $stock)
        //{            
			/**
			 * fetch data from Yahoo!
			 * s = stock code
			 * f = format
			 * e = filetype
			 */
            $s = file_get_contents("http://finance.yahoo.com/d/quotes.csv?s=$stock&f=$format&e=.csv");
            // echo "--".$s."--";
			/** 
			 * convert the comma separated data into array
			 */
            //$data = explode( ',', $s);
			$data = str_getcsv($s, '', '"');
			//print_r($data);
			/** 
			 * populate result array with stock code as key
			 */
            //$result[$stock] = $data;
       // }
        return $data;
    }
    
    public function getStockChange($chng)
    {
    	// check if positive/negative
    	$ret = array();
    	$count = 0;
    	$count = substr_count($chng, '+', 0);
    	if($count == 2)		// positive
    	{
    		$pos = strpos($chng, '-', 2);
    		$ret[1] = substr($chng, $pos+1);
    		$ret[1] = trim($ret[1]);
    		$ret[0] = substr($chng, 0, $pos);
    		$ret[0] = trim($ret[0]);
			$ret[2] = 1;
    		return $ret;
    	}
    	else 				// negative
    	{
    		$pos = strpos($chng, '-', 2);
    		$ret[1] = substr($chng, $pos+1);
    		$ret[1] = trim($ret[1]);
    		$ret[0] = substr($chng, 0, $pos);
    		$ret[0] = trim($ret[0]);
			$ret[2] = 0;
    		return $ret;
    	}
    }
} 

class User
{
	public function authenticate_user($userid, $password)
	{
		global $sd_con;
		$userid = trim($userid);

		$sql_query = "SELECT count(*) as val FROM user WHERE userid = '$userid' AND password = SHA1('$password') LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		if($row['val'])
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	public function create_user_account($userid, $firstname, $lastname, $password, $level, $flag)
	{
		global $sd_con;
		$userid = trim($userid);
		$level = 2;
		$sql_query = "INSERT INTO user(userid, firstname, lastname, password, level, flag) VALUES ('$userid', '$firstname', '$lastname', SHA1('$password'), $level, $flag)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "SELECT * FROM user WHERE userid = '$userid' ";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
  		$id = $row['id'];
  		
  		$sql_query = "INSERT INTO user_pref(userid) VALUES ($id)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "INSERT INTO user_stats(id) VALUES ($id)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "INSERT INTO user_stats_weekly(id) VALUES ($id)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "INSERT INTO user_stats_monthly(id) VALUES ($id)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
	}
	
	public function get_user_info_by_userid($userid)
	{
		global $sd_con;
		$userid = trim($userid);

		$sql_query = "SELECT * FROM user WHERE userid = '$userid' ";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		return $row;
	}
	
	public function get_user_info_by_id($id)
	{
		global $sd_con;

		$sql_query = "SELECT * FROM user WHERE id = $id ";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		return $row;
	}
	
	public function check_if_user_exists($userid)
	{
		global $sd_con;
		$sql_query = "SELECT userid FROM user";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		while($row = mysqli_fetch_array($result))
		{
			if(trim($row['userid']) == trim($userid))
				return 1;
		}
		return 0;
	}
	
}

class Article
{
	public function insert_new_article($stock, $content, $url)
	{
		
	}
	
	public function check_if_graded($a_id, $user)
	{
		// returns sentiment if graded else 0
		global $sd_con;
		$check = 0;
		$sql_query = "SELECT * FROM user_sentiment WHERE a_id = $a_id AND user_id = $user LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		if($row == NULL)
			$check = 0;
		else
			$check = $row['sentiment'];

		return $check;
	}
	
	
	public function get_articles_by_symbol($symbol, $date, $user)
	{
		global $sd_con;
		$article_list = array();
		$graded = 0;
		$i = 1;
		$sql_query = "SELECT * FROM article_data WHERE stock = '$symbol' ORDER BY date DESC";

		$result = mysqli_query($sd_con, $sql_query);
		
		while($row = mysqli_fetch_array($result))
		{
			$article_list[$i]['sno'] = $i; 
			$article_list[$i]['a_id'] = $row['a_id']; 
			$article_list[$i]['url'] = $row['url'];
			$article_list[$i]['title'] = $row['title']; 
			$article_list[$i]['date'] = $row['date']; 
			$article_list[$i]['status'] = $this->check_if_graded($row['a_id'], $user);
			if($article_list[$i]['status'] >= 1)
				$graded++; 
			$i++;
		}
		$article_list[0]['total'] = $i - 1;
		$article_list[0]['graded'] = $graded;
		
		return $article_list;
	}
	
	
	public function get_article_data_by_id($id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM article_data WHERE a_id = $id LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		
		return $row;
	}
	
	public function get_article_data_by_article_id($article_id, $stock)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM article_data WHERE a_id = $id AND stock = $stock LIMIT 1";
		
		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		
		return $row;
	}
	
	public function get_graded_articles_by_user($username)
	{
		
	}
	
	public function insert_user_sentiment($article_id, $user_id, $sentiment)
	{
		global $sd_con;
		$sql_query = "INSERT INTO user_sentiment (user_id, sentiment, a_id) VALUES ($user_id, $sentiment, $article_id)";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$ustats = new UserStats();
  		
  		$ustats->updateUserStatsAlltime($user_id, 1, 1, 0, 0);
	}
	
	public function insert_system_sentiment($article_id, $sentiment)
	{
		global $sd_con;
		$sql_query = "INSERT INTO system_sentiment (a_id, sentiment) VALUES ($article_id, $sentiment)";
		mysqli_query($sd_con, $sql_query);
	}
	
	public function update_user_sentiment($article_id, $user_id, $sentiment, $initial_sentiment)
	{
		global $sd_con;
		$sql_query = "UPDATE user_sentiment SET sentiment = $sentiment WHERE a_id = $article_id AND $user_id = user_id";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		// make call for update
	}
	
	public function update_system_sentiment($article_id, $sentiment)
	{
		global $sd_con;
		$sql_query = "UPDATE system_sentiment SET sentiment = $sentiment WHERE a_id = $article_id";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
	}
	
	public function get_user_sentiment($userid, $id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_sentiment WHERE a_id = $id AND user_id = $userid LIMIT 1";
		
		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		
		if($row == NULL)
			return -1;
		else
			return $row['sentiment'];
	}
	
	public function get_system_sentiment($id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM system_sentiment WHERE a_id = $id LIMIT 1";
		
		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		
		if($row == NULL)
			return -1;
		else
			return $row['sentiment'];
	}
	

}

class UserPrefs
{
	
	public function addToPortfolio($user_id, $symbol)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_pref WHERE userid = $user_id LIMIT 1";
		
		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		if(isset($row['portfolio']))
		{
			$slist = explode(',', $row['portfolio']);
			//print_r($row['portfolio']);
			//print_r($slist);
			if(in_array($symbol, $slist))
			{
				return 0;
			}
			else
			{
				//echo count($slist);
				$newstr = $row['portfolio']."$symbol".",";
				$sql_query = "UPDATE user_pref SET portfolio = '$newstr' WHERE userid = $user_id";
				if (!mysqli_query($sd_con, $sql_query))
  				{
  					die('Error: ' . mysqli_error($sd_con));
  				}
		
				//echo $newstr;
				return 1;
			}
		}
		
		return 0;
	}	
		
	
	
	public function getPortfolio($user_id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_pref WHERE userid = $user_id LIMIT 1";
		
		$result = mysqli_query($sd_con, $sql_query);
		$row = mysqli_fetch_array($result);
		//$slist = explode(',', $row['portfolio']);
		return $row['portfolio'];
	}
}

class UserStats
{
	public function getUserStatsAlltime($id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats where id = $id LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		return $row;
	}
	
	public function getUserStatsWeekly($id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats_weekly where id = $id LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		return $row;
	}
	
	public function getUserStatsMonthly($id)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats_monthly where id = $id LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		return $row;
	}
	
	public function updateUserStatsAlltime($userid, $graded, $majority, $minority, $neither)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$graded = $row['graded'] + $graded;
		$majority = $row['majority'] + $majority;
		$minority = $row['minority'] + $minority;
		$neither = $row['neither'] + $neither;
		
		$sql_query = "UPDATE user_stats SET graded = $graded, majority = $majority, minority = $minority, neither = $neither WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
		
	}
	
	public function updateUserStatsWeekly($userid, $graded, $majority, $minority, $neither)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats_weekly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$graded = $row['graded'] + $graded;
		$majority = $row['majority'] + $majority;
		$minority = $row['minority'] + $minority;
		$neither = $row['neither'] + $neither;
		
		$sql_query = "UPDATE user_stats_weekly SET graded = $graded, majority = $majority, minority = $minority, neither = $neither WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
		
	}
	
	public function updateUserStatsMonthly($userid, $graded, $majority, $minority, $neither)
	{
		global $sd_con;
		$sql_query = "SELECT * FROM user_stats_monthly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$graded = $row['graded'] + $graded;
		$majority = $row['majority'] + $majority;
		$minority = $row['minority'] + $minority;
		$neither = $row['neither'] + $neither;
		
		$sql_query = "UPDATE user_stats_monthly SET graded = $graded, majority = $majority, minority = $minority, neither = $neither WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
		
	}
	
	
	public function update_user_points($userid, $a_id, $sentiment, $initial_sentiment)
	{
		// 1-Positive, 2-Negative, 3-Neutral
		global $sd_con;

		$articleObj = new Article();
		$article_data = $articleObj->get_article_data_by_id($a_id);
		
		$points = 0;
		$major = 0;
		//$usrSent = $articleObj->get_user_sentiment($userid, $a_id);
		$sysSentiment = $articleObj->get_system_sentiment($a_id);
		//echo $usrSent.",".$sysSentiment;
		//echo $article_data['sentiment'];
		//print_r($article_data);
		$positive = $article_data['positive'];
		$negative = $article_data['negative'];
		$neutral = $article_data['neutral'];
		
		$total = $positive + $negative + $neutral;
		
		if($initial_sentiment != -1)
		{
			
		if($total > 10)
		{		
			if($positive > $negative)
			{
				if($positive > $neutral)
					$major = 1;
				else
					$major = 3;
			}
			else
			{
				if($negative > $neutral)
					$major = 2;
				else
					$major = 3;
			}
		
			if($initial_sentiment == $sysSentiment)
			{
				if($initial_sentiment == $major)
					$points = 5;
				else
					$points = 2;
			}
			else
			{
				if($initial_sentiment == $major)
					$points = 3;
				else
					$points = 0;
			}	
		}
		else
		{
			if($initial_sentiment == $sysSentiment)
			{
				$points = 5;
			}
			else
			{
				$points = 3;
			}	
		}
		echo "<br>Points to delete:".$points;	
		$sql_query = "SELECT * FROM user_stats where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] - $points;
		$sql_query = "UPDATE user_stats SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "SELECT * FROM user_stats_monthly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] - $points;
		$sql_query = "UPDATE user_stats_monthly SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "SELECT * FROM user_stats_weekly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] - $points;
		$sql_query = "UPDATE user_stats_weekly SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}	
		}
		
		if($total > 10)
		{		
			if($positive > $negative)
			{
				if($positive > $neutral)
					$major = 1;
				else
					$major = 3;
			}
			else
			{
				if($negative > $neutral)
					$major = 2;
				else
					$major = 3;
			}
		
			if($sentiment == $sysSentiment)
			{
				if($sentiment == $major)
					$points = 5;
				else
					$points = 2;
			}
			else
			{
				if($sentiment == $major)
					$points = 3;
				else
					$points = 0;
			}	
		}
		else
		{
			if($sentiment == $sysSentiment)
			{
				$points = 5;
			}
			else
			{
				$points = 3;
			}	
		}
		echo "<br>Points to add:".$points;			
		$sql_query = "SELECT * FROM user_stats where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] + $points;
		$sql_query = "UPDATE user_stats SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "SELECT * FROM user_stats_monthly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] + $points;
		$sql_query = "UPDATE user_stats_monthly SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  		
  		$sql_query = "SELECT * FROM user_stats_weekly where id = $userid LIMIT 1";

		$result = mysqli_query($sd_con, $sql_query);
		
		$row = mysqli_fetch_array($result);
		
		$upoints = $row['points'] + $points;
		$sql_query = "UPDATE user_stats_weekly SET points = $upoints WHERE id = $userid";
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
  			
	}
}

function get_leaderboard_alltime()
{
	global $sd_con;
		$ulist = array();
		$graded = 0;
		$i = 1;
		$sql_query = "SELECT * FROM user_stats ORDER BY points DESC LIMIT 10";

		$result = mysqli_query($sd_con, $sql_query);
		
		while($row = mysqli_fetch_array($result))
		{
			$ulist[$i] = $row;
			$i++;
		}
		
		return $ulist;
}

function get_leaderboard_weekly()
{
	global $sd_con;
		$ulist = array();
		$graded = 0;
		$i = 1;
		$sql_query = "SELECT * FROM user_stats_weekly ORDER BY points DESC LIMIT 10";

		$result = mysqli_query($sd_con, $sql_query);
		
		while($row = mysqli_fetch_array($result))
		{
			$ulist[$i] = $row;
			$i++;
		}
		
		return $ulist;
}

function get_leaderboard_monthly()
{
	global $sd_con;
		$ulist = array();
		$graded = 0;
		$i = 1;
		$sql_query = "SELECT * FROM user_stats_monthly ORDER BY points DESC LIMIT 10";

		$result = mysqli_query($sd_con, $sql_query);
		
		while($row = mysqli_fetch_array($result))
		{
			$ulist[$i] = $row;
			$i++;
		}
		
		return $ulist;
}

function executeCronJob()
{
	global $sd_con;
	echo "<br>Executing StockDeck Cron Job";
	$val = 999;
	$sql_query = "INSERT INTO cronjob_status(val) VALUES ($val)";
		
		if (!mysqli_query($sd_con, $sql_query))
  		{
  			die('Error: ' . mysqli_error($sd_con));
  		}
	
}


?>