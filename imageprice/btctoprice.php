<?php

require_once ( dirname(__FILE__) . "/../lib/mtgoxrate.php");
require_once ( dirname(__FILE__) . "/../lib/btcprice_from_currency.php");

if ( $_GET  )
{
 if ( isset( $_GET['u'] ) )
 {$fromprice = $_GET['u']; 
  if ( is_numeric( $fromprice ) ) 
  {$fromcurrency = "USD"; $message=""; }
 }
 else if ( isset( $_GET['usdprice'] ) )
 {$fromprice = $_GET['usdprice'];
  if ( is_numeric( $fromprice ) )
  {
   $fromcurrency = "USD";
   $message="";
  }
  else $message = "badprice";
 }
 else if ( isset ($_GET['e'] ) )
 {$fromprice = $_GET['e'];
  if ( is_numeric( $fromprice ) )
  {
   $fromcurrency = "EUR"; $message="";
  }
 }
 else if ( isset ($_GET['eurprice'] ) )
 {
  $fromprice = $_GET['eurprice'];
  if ( is_numeric( $fromprice ) )
  {
   $fromcurrency = "EUR";
   $message="";
  }
  else $message = "badprice";
 }
 else $message = "badprice";
}
else $message = "badprice";

if ( !isset( $fromprice ) ) $fromprice=0 ;


if ( $message == "" )
  $message = price_to_currency_from_btc( $fromcurrency, $fromprice );
 
//echo $message;

$im = @imagecreate(460, 100)
    or die("Cannot Initialize new GD image stream");

header("Content-type: image/png");
$image = imagecreatefrompng("background2.png");
$background_color = imagecolorallocate($image, 231, 247, 215);
$text_color = imagecolorallocate($image, 255, 0, 0);
//$text_color2 = imagecolorallocate($image, 0, 0, 225);
//$shado_color = imagecolorallocate($image, 178,178,178);
imagestring($image, 3, 5, 5, $message, $text_color);
imagepng($image);
imagedestroy($image);
?>
