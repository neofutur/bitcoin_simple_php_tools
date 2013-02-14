<?php
require_once(dirname(__FILE__) . "/mtgoxrate.php" );

function  price_to_currency_from_btc( $tocurrency, $fromprice )
{
 $round=3;
 $mtgoxrate = cachemtGoxRate($tocurrency);
 $toprice  = $fromprice * $mtgoxrate;

 $toprice = round( $toprice, $round, PHP_ROUND_HALF_UP );
 $messageline = $fromprice." BTC =  ".$toprice." ".$tocurrency;
 return $messageline;
}

?>
