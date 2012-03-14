<?php

require_once ( dirname(__FILE__) . "/../lib/mtgoxrate.php");
require_once ( dirname(__FILE__) . "/../lib/price_to_currency_from_btc.php");


if ( $_GET  )
{
 if ( isset( $_GET['b'] ) )
 {$frombtcprice = $_GET['b']; 
  if ( is_numeric( $frombtcprice ) ) 
  {
   $from=$frombtcprice;
   $message="";
  }
  else $message = "badprice1";
 }
 else if ( isset( $_GET['btcprice'] ) )
 {$frombtcprice = $_GET['btcprice'];
  if ( is_numeric( $frombtcprice ) )
  {
   $from=$frombtcprice;
   $message="";
  }
  else $message = "badprice2";
 }
 if ( isset ($_GET['c'] ) )
 {
  $tocurrency = $_GET['c'];
  //echo $tocurrency;
  if ( $tocurrency == "usd" ) $to =$tocurrency;
  if ( $tocurrency == "eur" ) $to =$tocurrency;
 }
 else if ( isset ($_GET['currency']) )
 {
  $tocurrency = $_GET['currency'];
  if ( $tocurrency == "eur" OR $tocurrency == "usd" )
  {
   $to =  $tocurrency;
   $message="";
  }
  else $message = "badcurrency2";
 }
 else $message = "badprice3";
}
if ( !isset( $from ) )
{
 $from=0 ;
 $message = "badprice";
}


if ( $message == "" && isset ( $to ) && isset ( $from ) )
  $message = price_to_currency_from_btc( $to, $from );
//price_to_currency_from_btc
//echo $message;

$im = @imagecreate(460, 100)
    or die("Cannot Initialize new GD image stream");

header("Content-type: image/png");
$image = imagecreatefrompng("background-130x26.png");
$background_color = imagecolorallocate($image, 231, 247, 215);
$text_color = imagecolorallocate($image, 0, 255, 0);
//$text_color2 = imagecolorallocate($image, 0, 0, 225);
//$shado_color = imagecolorallocate($image, 178,178,178);
imagestring($image, 3, 5, 5, $message, $text_color);
imagepng($image);
imagedestroy($image);
?>
