<?php
define('API_KEY', '3cd469d64fe23ec0f0d9e3c0b30d6d0a:1:67462734');
define('API_URL', 'http://api.nytimes.com/svc/search/v1/article');
$n = 10;
$i = 0;
{
  $start = $i * $n;
  print "$start\n";
  
  $params = array(
    'api-key' => API_KEY,
    'query' => 'des_facet:[SCIENCE AND TECHNOLOGY]',
    'offset' => $i,
    'fields' => 'byline,body,date,title,url,des_facet',
    );
  
  $data = json_decode(file_get_contents(API_URL . '/article?' . http_build_query($params)));
  foreach ($data->results as $item)
    file_put_contents(sprintf('articles/%s.js', md5($item->url)), json_encode($item)); 
  
  sleep(1);
} //while ($start < $total && ++$i);