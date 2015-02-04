<?php
require_once(dirname(__FILE__) . "/mtgoxrate.php" );

function  btcprice_from_currency( $fromcurrency, $fromprice )
{
 $round=3;

 $mtgoxrate = cachemtGoxRate($fromcurrency);
 $btcprice  = $fromprice / $mtgoxrate;

 $btcprice = round( $btcprice, $round, PHP_ROUND_HALF_UP );
 $messageline = $fromprice." ".$fromcurrency." = ".$btcprice." BTC ";
 return $messageline;
}

?>
