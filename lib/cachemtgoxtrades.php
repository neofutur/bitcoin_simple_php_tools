<?php

function cachemtGoxTrades($fromcurrency="USD", $grouptrades=false, $since )
{
  //echo $fromcurrency;
 if ( $fromcurrency == "usd" ) $fromcurrency = "USD";
 if ( $fromcurrency == "eur" ) $fromcurrency = "EUR";
	
  //decisions, decisions
 $file=dirname(__FILE__) . "/../cache/goxtrades_".$fromcurrency.".txt";
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

  //echo $since; exit;
  $opts = array(
   'http'=> array(
   'method'=>   "GET",
   'user_agent'=>    "MozillaXYZ/1.0"));
  $context = stream_context_create($opts);
  $url_api = 'https://mtgox.com/api/1/BTCUSD/trades?since='.$since;
  //echo $url_api;exit;
  $json = file_get_contents($url_api, false, $context);
  if ( $json == FALSE ) return NULL;

  $jdec = json_decode($json);
  //var_dump($jdec); exit;
  $trade_array = $jdec->{'return'};
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
