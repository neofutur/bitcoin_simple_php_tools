<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>Public Bitcoin PHP tools Information server</title>
<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="neoPHPtools v 0.1 [13]" />
<link rel="alternate" type="application/rss+xml" title="Syndicate the whole site" href="http://bitcoin.gw.gd/spip.php?page=backend" />

</head>
<body>
<?php include("header.php");
require_once ( dirname(__FILE__) . "/lib/cacheticker.php");
?>

<h2>RSS feeds</h2>
<table>
<tr> <td> Bitcoin Ticker RSS feed, short format ( from mtgox, cached 30 seconds ) </td>
<td> <a href="http://p.b.gw.gd/pricefeed/bitcoin_price_feed.php?format=short">short bitcoin ticker</a> </td> </tr>
<tr> <td> Bitcoin Ticker RSS feed, long format ( from mtgox, cached 30 seconds ) </td>
<td> <a href="http://p.b.gw.gd/pricefeed/bitcoin_price_feed.php?format=fullticker">full bitcoin ticker</a> </td> </tr>
<tr> <td> Bitcoin Trades RSS feed ( all trades from mtgox, ungrouped, cached 30 seconds ) </td>
<td> <a href="http://p.b.gw.gd/tf/bitcoin_trade_feed.php">bitcoin trades</a> </td> </tr>
<tr> <td> Bitcoin Trades RSS feed ( all trades from mtgox, grouped, cached 30 seconds ) </td>
<td> Coming soon </td> </tr>
<tr> <td> Bitcoin Latest News RSS feed ( all latest breaking news concerning bitcoin </td>
<td> <a href="http://bitcoin.gw.gd/spip.php?page=backend&amp;id_rubrique=1">Bitcoin News</a> </td> </tr>
</table>
<h2> Image tools </h2>
<table>
<tr> <td>imageticker ( horizontal ), cached 30 seconds )</td><td><img src="http://p.b.gw.gd/it/it.php" alt="Bitcoin ticker" /></td><td><a href="http://p.b.gw.gd/it/it.png">Bitcoin ticker</a></td></tr>
<tr> <td>imageticker ( vertical ), cached 30 seconds )</td><td><img src="http://p.b.gw.gd/it/iv.php" alt="Bitcoin ticker" /></td><td><a href="http://p.b.gw.gd/it/iv.png">Bitcoin ticker</a></td></tr>
<tr> <td>Convert FIAT to BTC price</td><td><img src="http://p.b.gw.gd/ip/b.php?u=1" alt="1 usd converted to btc" />&nbsp;&nbsp;<img src="http://p.b.gw.gd/ip/b.php?u=33" alt="33 usd converted to btc" /></td><td><a href="http://p.b.gw.gd/ip/b.php?usdprice=200">convert price to btc </a></td></tr>
<tr> <td>Convert BTC to FIAT price</td><td><img src="http://p.b.gw.gd/ip/p.php?b=1&amp;c=usd" alt="1 btc converted to USD" />&nbsp;&nbsp;<img src="http://p.b.gw.gd/ip/p.php?b=2&amp;c=eur" alt="2 btc converted to EUR" /></td><td><a href="http://p.b.gw.gd/ip/p.php?b=1&amp;c=usd">convert btc to FIAT price</a></td></tr>

</table>
<h2> Text and HTML tools</h2>
<table>
<tr> <td>EUR ticker in HTML format</td><td><?php require "tickers/ticker_eur_btc.php" ?></td><td><a href="http://p.b.gw.gd/ti/ticker_eur_btc.php">HTML BTC/EUR ticker</a> </td></tr>
<tr> <td>USD ticker in HTML format</td><td><?php require "tickers/ticker_usd_btc.php" ?></td><td><a href="http://p.b.gw.gd/ti/ticker_usd_btc.php">HTML BTC/USD ticker</a> </td></tr>
<tr> <td>EUR ticker in TEXT format</td><td><?php echo cachegetBitcoinPrice( "text", "line", "EUR" ); ?></td><td><a href="http://p.b.gw.gd/ti/ticker_eur_btc.php?type=text">TEXT BTC/EUR ticker</a> </td></tr>
<tr> <td>USD ticker in TEXT format</td><td><?php echo cachegetBitcoinPrice( "text", "line", "USD" ); ?></td><td><a href="http://p.b.gw.gd/ti/ticker_usd_btc.php">TEXT BTC/USD ticker</a> </td></tr>
</table>

<?php include("footer.php"); ?>
</body>
</html>

