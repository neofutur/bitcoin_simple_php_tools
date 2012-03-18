<?php

function cachemtGoxRate($fromcurrency="USD")
{
  //decisions, decisions
  $file="./goxrate.txt";
  $current_time = time(); $expire_time = 30; $file_time = filemtime($file);
  if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
    //echo 'returning from cached file';
    return file_get_contents($file);
  }
  else
  {

	//echo $fromcurrency;
	if ( $fromcurrency == "usd" ) $fromcurrency = "USD";
	if ( $fromcurrency == "eur" ) $fromcurrency = "EUR";

        $opts = array(
          'http'=> array(
                'method'=>   "GET",
                'user_agent'=>    "MozillaXYZ/1.0"));
        $context = stream_context_create($opts);
        $json = file_get_contents('https://mtgox.com/api/0/data/ticker.php?Currency='.$fromcurrency, false, $context);
        $jdec = json_decode($json);
        $rate = $jdec->{'ticker'}->{'avg'};
	file_put_contents($file,$rate);
        return $rate;
  }
}

?>
