<?php


require_once ( dirname(__FILE__) . "/../lib/feedtools.php");

header("Content-Type: application/rss+xml; charset=ISO-8859-1");

// feed parameters , currency, delay, format, image
$currency="USD"; $delay=30; $format="short";$image=false;

if ( isset( $_GET ) )
 if ( isset ( $_GET['format'] ) )
   if ( $_GET['format'] == "short" or $_GET['format'] == "fullticker" )
      $format = $_GET['format'];

$fromcurrency="USD";

// feed date
//const string RFC822 = "D, d M y H:i:s O" ;
$sincefile=dirname(__FILE__) . "/../cache/lasttradeid_".$fromcurrency.".txt";
$since=file_get_contents($sincefile);
//echo $since; exit;
$tid=$since;

$date= date('r');
$ttl=30;
$timestamp = time();
$link="http://p.b.gw.gd/ti/miniticker.php?date=$timestamp";
$grouptrades=false;

// input rss header


//if ( $image == true )
//addfeedimage(imageurl, imagelink,imagetitle)
//echo $format;
$title="bitcoin trade feed";
$link="http://bitcoin.gw.gd";
$description="RSS feed providing the latest bitcoin trades, from mtgox API, feed updated every 30 seconds, provided by http://bitcoin.gw.gd";
$self="http://p.b.gw.gd/tf/bitcoin_trade_feed.php";
$rssfeed = feedheader( $date, $ttl, $format, $title, $link,$description, $self );

// add data / RSS items
if ( $format == "short" )
{
 require_once ( dirname(__FILE__) . "/../lib/cachemtgoxtrades.php");
 $trades=cachemtGoxTrades($fromcurrency="USD", $grouptrades, $since );
}


//var_dump($trades);exit;
//foreach line
foreach ( $trades as $trade )
{
 $timestamp=$trade->{'date'};
 $datetrade=date("Md H:i:s" );
 $price=$trade->{'price'};
 $amount=$trade->{'amount'};
 $tid=$trade->{'tid'};
 $item=$trade->{'item'};
 $currency=$trade->{'price_currency'};
 $title= $datetrade." mtgox : ". $amount. " " . $item." traded at ".$price." ".$currency;
 $link="http://p.b.gw.gd/ti/miniticker.php?date=$timestamp";
 $link .= "&amp;format=short";
 $description=$datetrade." mtgox ".$tid." : ". $amount. " " . $item." traded at ".$price." ".$currency;
 $rssfeed .= addfeeditem($title, $link, $description,$timestamp, $price );
}
// add RSS footer
$rssfeed .= feedfooter();
//echo $tid;exit;
// update last trade_id
file_put_contents($sincefile, $tid );

// echo the full RSS feed
echo $rssfeed;

?>
