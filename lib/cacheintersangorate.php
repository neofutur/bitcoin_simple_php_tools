<?php

function cacheIntersangoRate($fromcurrency="USD", $type="avg" )
{
  //echo $fromcurrency;
  if ( $fromcurrency == "usd" ) $fromcurrency = "USD";
  if ( $fromcurrency == "eur" ) $fromcurrency = "EUR";
	
  //decisions, decisions
  $file=dirname(__FILE__) . "/../cache/intersangorate_".$fromcurrency.".txt";

//echo $file;
  $current_time = time(); $expire_time = 30;
  if(file_exists($file) ) $file_time = filemtime($file);
  if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
    //echo 'returning from cached file';
    return file_get_contents($file);
  }
  else
  {
        touch( $file );

        $opts = array(
          'http'=> array(
                'method'=>   "GET",
                'user_agent'=>    "MozillaXYZ/1.0"));
        $context = stream_context_create($opts);
        $json = file_get_contents('https://intersango.com/api/ticker.php', false, $context);
        $jdec = json_decode($json);
	//var_dump($jdec->{'3'});
	if ( $type == "avg" ) $rate = $jdec->{'3'}->{'avg'};
	if ( $type == "last_local" ) $rate = $jdec->{'3'}->{'last_local'};
	if ( $type == "last" ) $rate = $jdec->{'3'}->{'last'};
	file_put_contents($file,$rate);
        return $rate;
  }
}

?>
