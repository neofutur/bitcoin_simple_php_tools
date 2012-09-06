<?php

require_once ( dirname(__FILE__) . "/../lib/cachemtgoxrate.php");
require_once ( dirname(__FILE__) . "/../lib/feedtools.php");

header("Content-Type: application/rss+xml; charset=ISO-8859-1");

// feed parameters , currency, delay, format, image
$currency="USD"; $delay=30; $format="short";$image=false;

// get rates

$ticker=cachemtGoxRate($fromcurrency="USD");

// feed date
//const string RFC822 = "D, d M y H:i:s O" ;

$date= date('r');
$ttl=30;
$timestamp = time();
// input rss header

$rssfeed = feedheader( $date, $ttl);

//if ( $image == true )
//addfeedimage(imageurl, imagelink,imagetitle)

// add data / RSS items
$title="bitcoin price ".$date." "; $link="http://p.b.gw.gd/ti/miniticker.php?date=$timestamp"; $description="bitcoin price at date ". $date. " ";

$rssfeed .= addfeeditem($title, $link, $description,$timestamp);

// add RSS footer
$rssfeed .= feedfooter();

// echo the full RSS feed
echo $rssfeed;

?>
