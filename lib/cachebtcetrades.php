<?php

global $since; //for the callback to filter array

function cacheBtceTrades( $grouptrades=false, $since )
{
	
  //decisions, decisions
 $file=dirname(__FILE__) . "/../cache/btcetrades.txt";
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
  $url_api = 'https://btc-e.com/api/2/btc_usd/trades?since='.$since;
  //echo $url_api;exit;
  $json = file_get_contents($url_api, false, $context);
  $trade_array = json_decode($json);
  /*
  object(stdClass)#1 (7) {
  ["date"]=>
  int(1347655706)
  ["price"]=>
  float(11.53)
  ["amount"]=>
  float(0.2)
  ["tid"]=>
  int(254188)
  ["price_currency"]=>
  string(3) "USD"
  ["item"]=>
  string(3) "BTC"
  ["trade_type"]=>
  string(3) "ask"
}
*/
  //var_dump($jdec); exit;
  //$trade_array = $jdec->{'return'};
  $trade_array = array_filter ( $trade_array, "ignore_since" );
  //var_dump($trade_array); exit;
  if ( $grouptrades == true ) $trade_array = grouptrades($trade_array);
  //$fileContents = '<?php $trade_array = '. var_export($trade_array, true) ."; ?".">";
  $fileContents = serialize($trade_array);
  file_put_contents($file, $fileContents );
  //file_put_contents($file, var_export($trade_array, true));
 }
 return $trade_array;
}

function ignore_since($trade_array )
{
 global $since;
 //echo $trade_array->tid; exit;
 if ($trade_array->tid <= $since ) return false;
 else return true;

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
