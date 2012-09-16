<?php

function cacheBitstampTrades($fromcurrency="USD", $grouptrades=false, $since, $timedelta )
{
  //echo $fromcurrency;
 if ( $fromcurrency == "usd" ) $fromcurrency = "USD";
 if ( $fromcurrency == "eur" ) $fromcurrency = "EUR";
	
  //decisions, decisions
 $file=dirname(__FILE__) . "/../cache/bitstamptrades_".$fromcurrency.".txt";
 $current_time = time(); $expire_time = 30;
 

 if(file_exists($file) ) $file_time = filemtime($file);
 if(file_exists($file) && ($current_time - $expire_time < $file_time)) 
 {
  //echo 'returning from cached file';
  $trade_array = unserialize( file_get_contents($file ) );
  //var_dump($trade_array); exit;
 }
 else
 {
  //touch( $file );

  //echo $sincetime; exit;
  $opts = array(
   'http'=> array(
   'method'=>   "GET",
   'user_agent'=>    "MozillaXYZ/1.0"));
  $context = stream_context_create($opts);
  $url_api = 'https://www.bitstamp.net/api/transactions?timedelta='.$timedelta;
  //echo $url_api;exit;
  $json = file_get_contents($url_api, false, $context);
  $trade_array = json_decode($json);
  if ( $grouptrades == true ) $trade_array = grouptrades($trade_array);
  //$fileContents = '<?php $trade_array = '. var_export($trade_array, true) ."; ?".">";
  $fileContents = serialize($trade_array);
  file_put_contents($file, $fileContents );
  //file_put_contents($file, var_export($trade_array, true));
 }
 return $trade_array;
}

function grouptrades($trade_array)
{

}

function __set_state(array $array) {
 foreach($array as $k => $v) {
 echo("$k ==> $v <br/>");
 }
}

?>
