<?php
function feedheader( $date, $ttl, $format, $title, $link, $description, $self )
{
 $feedheader="";
 $selflink = $self;

 $feedheader  = '<?xml version="1.0" encoding="UTF-8"?>';
 $feedheader .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" >';
// $feedheader .= '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" >';
 $feedheader .= '<channel>';
 $feedheader .= '<atom:link href="'.$selflink.'" rel="self" type="application/rss+xml" />';
 $feedheader .= '<title>'.$title.'</title>';
 $feedheader .= '<link>'.$link.'http://bitcoin.gw.gd</link>';
 $feedheader .= '<description>'.$description.'</description>';
 $feedheader .= '<language>en-us</language>';
 $feedheader .= '<lastBuildDate>'.$date.'</lastBuildDate>';
 $feedheader .= '<generator>bitcoin simple php tools</generator>';
 $feedheader .= '<ttl>'.$ttl.'</ttl>';
 $feedheader .= '<copyright>Copyright (C) 2012 gw.gd</copyright>';

 return $feedheader;
}
function feedfooter()
{
 $feedfooter="";

 $feedfooter .= '</channel>';
 $feedfooter .= '</rss>';

 return $feedfooter;
}

function addfeeditem($title, $link, $description, $timestamp, $ticker )
{
 $donations = "free service provided by http://bitcoin.gw.gd , donations welcome : 1va4sqj5AFnMYicD7JzhDfxauk5w6Uuug";
 $feeditem="";
 $feeditem .= "<item>";
 $feeditem .= "<title>".$title."</title>";
 $feeditem .= "<link>".$link."</link>";
 $feeditem .= "<description>".$description." . ".$donations."</description>";
//<content:encoded><![CDATA[<div><font color="#141414"><span style="font-family: Georgia">Let's see here what we need to do and not do to create good articles for our readers:</span></font><br />
//<br />
//<font color="#141414"><span style="font-family: Georgia">DOs</span></font><ul><li style="">be original, don't copy</li><li style="">write in a personal friendly way</li><li style="">don't use 'big' words, make it all easy to understand</li><li style="">try to teach something, offer something to your readers, don't waste their time</li></ul><font color="#141414"><span style="font-family: Georgia">DONTs</span></font><ul><li style="">don't steal content under ANY circumstance. Do you like something? Link to it.</li><li style="">don't write as if the reader was looking through the Encyclopedia. We hated our school boks with a reason: they were 'arid' and boring</li><li style="">don't write about stuff you don't know, it will make you look stupid</li></ul><font color="#141414"><span style="font-family: Georgia">Let's add to these. What are your own DOs and DONTs when it comes to content?</span></font></div>
//
//]]></content:encoded>
 $feeditem .= '<category domain="http://bitcoin.gw.gd/-Bitcoin-trading-">Bitcoin trading</category>';
 $feeditem .= '<dc:creator>NeoFutur</dc:creator>';
 $feeditem .= '<guid isPermaLink="true">http://p.b.gw.gd/ti/miniticker.php?date='.$timestamp.'</guid>';

 $feeditem .= "</item>";


return $feeditem;
}

function addfeedimage($imageurl, $imagelink, $imagetitle)
{

}

?>
