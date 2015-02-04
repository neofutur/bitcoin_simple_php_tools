<?php


require_once ( dirname(__FILE__) . "/../lib/feedtools.php");

header("Content-Type: application/rss+xml; charset=ISO-8859-1");

// feed parameters delay, format, image
$delay=30; $format="short";$image=false;

if ( isset( $_GET ) )
 if ( isset ( $_GET['format'] ) )
   if ( $_GET['format'] == "short" or $_GET['format'] == "fullticker" )
      $format = $_GET['format'];

// get rates


// feed date
//const string RFC822 = "D, d M y H:i:s O" ;

$date= date('r');
$ttl=30;
$timestamp = time();
$link="http://p.b.gw.gd/ti/miniticker.php?date=$timestamp";

// input rss header


//if ( $image == true )
//addfeedimage(imageurl, imagelink,imagetitle)
//echo $format;

$link="http://bitcoin.gw.gd";
$title="bitcoin price feed";
$description="RSS feed providing the latest bitcoin price, from btc-e API, provided by http://bitcoin.gw.gd";
$self="http://p.b.gw.gd/pf/bitcoin_btceprice_feed.php";
$rssfeed = feedheader( $date, $ttl, $format, $title, $link,$description, $self);
// add data / RSS items
if ( $format == "short" )
{
 require_once ( dirname(__FILE__) . "/../lib/cachebtcerate.php");
 $ticker=cacheBtceRate("last");
 $title=$ticker;
 //$link .= "&amp;format=short";
 $description="bitcoin price at date ". $date. " ";
}
if ( $format == "fullticker" )
{
 require_once ( dirname(__FILE__) . "/../lib/cachebtceticker.php");
 $ticker= cachegetBtcePrice("text","vertical" );
 $title=$ticker;
 $link .= "&amp;format=fullticker";
 $description="bitcoin price at date ". $date. " ";
}


$rssfeed .= addfeeditem($title, $link, $description,$timestamp, $ticker);

// add RSS footer
$rssfeed .= feedfooter();

// echo the full RSS feed
echo $rssfeed;

?>
