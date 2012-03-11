<?php

require_once ( dirname(__FILE__) . "/../lib/mtgoxrate.php");
require_once ( dirname(__FILE__) . "/../lib/btcprice_from_currency.php");

if ( $_GET  )
{
 if ( isset( $_GET['usdprice'] ) )
 {
  $fromprice = $_GET['usdprice'];
  if ( is_numeric( $fromprice ) )
  {
   $fromcurrency = "USD";
   $message="";
  }
  else $message = "badprice";
 }
 if ( isset ($_GET['eurprice'] ) )
 {
  $fromprice = $_GET['eurprice'];
  if ( is_numeric( $fromprice ) )
  {
   $fromcurrency = "EUR";
   $message="";
  }
  else $message = "badprice";
 }
}
else $message = "badprice";

if ( !isset( $fromprice ) ) $fromprice=0 ;

if ( $message != "badprice" )
  $message = btcprice_from_currency( $fromcurrency, $fromprice );
 
echo $message;

?>
