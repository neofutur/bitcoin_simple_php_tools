<?php
require_once ( dirname(__FILE__) . "/../lib/ticker.php");

$typeticker = "html";

if ( isset( $_GET ) )
 if ( isset ( $_GET['type'] ) )
  if ( $_GET['type'] == "html" or $_GET['type'] == "text" )
   $typeticker = $_GET['type'];

echo getBitcoinPrice( $typeticker,"EUR");

?>
