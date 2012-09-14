<?php
/*Public API [34m~@~S BTC/USD

Ticker - https://btc-e.com/api/2/btc_usd/ticker
Trades - https://btc-e.com/api/2/btc_usd/trades
Depth - https://btc-e.com/api/2/btc_usd/depth

*/


function cachegetBitcoinPrice_btce( $type="html", $geo="line" ) 
{

  //decisions, decisions
  $file= dirname(__FILE__) . "/../cache/getBitcoinPrice_btce_".$type."_".$geo.".txt";
  
  $current_time = time(); $expire_time = 30;
  if(file_exists($file) )
  { $file_time = filemtime($file); }
  
  if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
    //echo 'returning from cached file';
    return file_get_contents($file);
  }
  else
  {
	$returndata="";
	// Fetch the current rate from MtGox
	$ch = curl_init('https://btc-e.com/api/2/btc_usd/ticker');
	curl_setopt($ch, CURLOPT_REFERER, 'Mozilla/5.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
	curl_setopt($ch, CURLOPT_USERAGENT, "CakeScript/0.1");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$btcejson = curl_exec($ch);
	curl_close($ch);
              
	// Decode from an object to array
	$output_btce = json_decode($btcejson);
	$output_btce_1 = get_object_vars($output_btce);
	$btce_array = get_object_vars($output_btce_1['ticker']);
	//var_dump($btce_array); exit;
	//array(9) 
	// { ["high"]=> float(11.649) ["low"]=> float(11.19) ["avg"]=> float(11.4195) ["vol"]=> float(18566.1) ["vol_cur"]=> float(1630.13) ["last"]=> float(11.642) ["buy"]=> float(11.639) ["sell"]=> float(11.59) ["server_time"]=> int(1347651348) } 

	$last=round ( $btce_array['last'], 3);
	$low =round ( $btce_array['low'], 3);
	$high=round ( $btce_array['high'], 3);
	$vol =round ( $btce_array['vol'], 3);
	$avg = round ( $btce_array['avg'], 3 );
	$ask = round ( $btce_array['sell'], 3 );
	$bid = round ( $btce_array['buy'], 3 );

	//echo $type;
	if ( $type == "html" )
	{
	 $returndata="<ul><li><strong>Last:</strong>&nbsp;&nbsp;".$last."</li><li><strong>High:</strong>&nbsp;".$high."</li><li><strong>Low:</strong>&nbsp;&nbsp;".$low."</li><li><strong>Avg:</strong>&nbsp;&nbsp;&nbsp;".$avg."</li><li><strong>Vol:</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$vol."</li><li><strong>bid:</strong>&nbsp;&nbsp;&nbsp;".$bid."</li><li><strong>ask:</strong>&nbsp;&nbsp;&nbsp;".$ask."</li></ul>";
	 //$returndata="<ul><li><strong>Last:</strong>&nbsp;&nbsp;".$btce_array['last']."</li><li><strong>High:</strong>&nbsp;".$btce_array['high']."</li><li><strong>Low:</strong>&nbsp;&nbsp;".$btce_array['low']."</li><li><strong>Avg:</strong>&nbsp;&nbsp;&nbsp;".$btce_array['avg']."</li><li><strong>Vol:</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$btce_array['vol']."</li></ul>";
	}
	else if ( $type == "text" )
	{
	 //echo $geo;
	 if ( $geo == "line" )
	 	$returndata="LAST: ".$last." HIGH: ".$high." LOW: ".$low." AVG: ".$avg." VOL: ".$vol." BID: ".$bid." ASK: ".$ask." ";
	 else if ( $geo == "vertical" )
	 	 $returndata="LAST: ".$last."\nHIGH: ".$high."\nLOW : ".$low."\nAVG : ".$avg."\nVOL : ".$vol."\nBID: ".$bid."\nASK: ".$ask;
	}
	file_put_contents($file,$returndata);
	return $returndata;
  }	 
}
 
?>
