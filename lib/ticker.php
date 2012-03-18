<?php
function getBitcoinPrice( $type="html", $geo="line", $currency="USD" ) 
{
	$returndata="";
	// Fetch the current rate from MtGox
	$ch = curl_init('https://mtgox.com/api/0/data/ticker.php?Currency='.$currency);
	curl_setopt($ch, CURLOPT_REFERER, 'Mozilla/5.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
	curl_setopt($ch, CURLOPT_USERAGENT, "CakeScript/0.1");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$mtgoxjson = curl_exec($ch);
	curl_close($ch);
              
	// Decode from an object to array
	$output_mtgox = json_decode($mtgoxjson);
	$output_mtgox_1 = get_object_vars($output_mtgox);
	$mtgox_array = get_object_vars($output_mtgox_1['ticker']);
        $last=round ( $mtgox_array['last'], 3);
        $low =round ( $mtgox_array['low'], 3);
        $high=round ( $mtgox_array['high'], 3);
        $vol =round ( $mtgox_array['vol'], 3);
        $avg = round ( $mtgox_array['avg'], 3 );

	if ( $type == "html" )
	{
	 $returndata="<ul><li><strong>Last:</strong>&nbsp;&nbsp;".$last."</li><li><strong>High:</strong>&nbsp;".$high."</li><li><strong>Low:</strong>&nbsp;&nbsp;".$low."</li><li><strong>Avg:</strong>&nbsp;&nbsp;&nbsp;".$avg."</li><li><strong>Vol:</strong>&nbsp;&nbsp;&nbsp;&nbsp;".$vol."</li></ul>";	
	}
	else if ( $type == "text" )
	{
	 //echo $geo;
	 if ( $geo == "line" )
	 	$returndata="LAST: ".$last." HIGH: ".$high." LOW: ".$low." AVG: ".$avg." VOL: ".$vol." ";
	 else if ( $geo == "vertical" )
	 	 $returndata="LAST: ".$last."\nHIGH: ".$high."\nLOW : ".$low."\nAVG : ".$avg."\nVOL : ".$vol;
	}
	return $returndata;
	 
}
 
?>
