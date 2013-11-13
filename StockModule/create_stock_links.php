<?php
$row = 1;
$co = 0;
$stocksFile = "stock_links_grade.txt";
$companylistFile = "companylist.csv";
$fp = fopen("n500.txt", 'r') or die("can't open file");
$nas = array();
while (($buffer = fgets($fp, 4096)) !== false) {
        $nas[] = trim($buffer);
    }
    //print_r($nas);
$fhw = fopen($stocksFile, 'w') or die("can't open file");
$handle = fopen($companylistFile, 'r') or die("can't open file");
//$stringData = "Bobby Bopper\n";
//fwrite($fh, $stringData);
//$stringData = "Tracy Tanner\n";
//fwrite($fh, $stringData);


 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       echo $data[0]."<br>";
        $co++;
        if($num == 10 && $co < 5000)
    	{
    	   // <li data-filtertext="AAPL Apple Inc."><a href="view_analysis.php?stock=AAPL">Apple Inc. (AAPL)</a></li>
			if(in_array(trim($data[0]), $nas))
    		{
    			echo "--<br>";
    		$str = "<li data-filtertext='".$data[0]." ".$data[1]."'><a href='article_list.php?stock=".$data[0]."'>".$data[1]." (".$data[0].")</a></li>\n";
    		fwrite($fhw, $str);
    		}
    	}
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        //for ($c=0; $c < $num; $c++) {
        //    echo $data[$c] . "<br />\n";
        //}
    }
 

fclose($handle);
fclose($fhw);
fclose($fp);

?>