<?php
require_once ( dirname(__FILE__) . "/../lib/cacheticker.php");

$typeticker = "html";
$geo = "line";
if ( isset( $_GET ) )
 if ( isset ( $_GET['type'] ) )
  if ( $_GET['type'] == "html" or $_GET['type'] == "text" )
   $typeticker = $_GET['type'];

echo cachegetBitcoinPrice( $typeticker, "line", "USD" );

?>
