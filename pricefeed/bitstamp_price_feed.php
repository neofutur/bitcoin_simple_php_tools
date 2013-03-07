<?php


require_once ( dirname(__FILE__) . "/../lib/feedtools.php");

header("Content-Type: application/rss+xml; charset=ISO-8859-1");

// feed parameters , currency, delay, format, image
$currency="USD"; $delay=30; $format="short";$image=false;

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
$exchangename=" bitstamp ";
$exchangelink="https://bitstamp.net";

// input rss header


//if ( $image == true )
//addfeedimage(imageurl, imagelink,imagetitle)
//echo $format;

$link="http://bitcoin.gw.gd";
$title="bitcoin price feed";
$description="RSS feed providing the latest bitcoin price, from ".$exchangename." API, provided by http://bitcoin.gw.gd";
$self="http://p.b.gw.gd/pf/bitstamp_price_feed.php";
$rssfeed = feedheader( $date, $ttl, $format, $title, $link,$description, $self);
// add data / RSS items
if ( $format == "short" )
{
 require_once ( dirname(__FILE__) . "/../lib/cachebitstamprate.php");
 $ticker=cacheBitstampRate($fromcurrency="USD", "last");
 $title=$ticker;
 //$link .= "&amp;format=short";
 $description="bitcoin price at date ". $date. " ";
}
if ( $format == "fullticker" )
{
 require_once ( dirname(__FILE__) . "/../lib/cacheticker.php");
 $ticker= cachegetBitcoinPrice("text","vertical" );
 $title=$ticker;
 //$link .= "&amp;format=fullticker";
 $description="bitcoin price at date ". $date. " ";
}


$rssfeed .= addfeeditem($title, $link, $description,$timestamp, $ticker);

// add RSS footer
$rssfeed .= feedfooter();

// echo the full RSS feed
echo $rssfeed;

?>
