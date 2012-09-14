<?php

function cachemtBtceRate()
{
	
  $file=dirname(__FILE__) . "/../cache/btcerate.txt";

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
        $json = file_get_contents('https://btc-e.com/api/2/btc_usd/ticker', false, $context);
        $jdec = json_decode($json);
        $rate = $jdec->{'ticker'}->{'avg'};
	file_put_contents($file,$rate);
        return $rate;
  }
}

?>
