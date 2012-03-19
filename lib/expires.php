<?php

function setExpires( $expires = 30 ) 
{
 $exp= "Expires: ";
 $time1=time()+$expires;
 $date=gmdate("D, d M Y H:i:s",$time1);
 //echo $date;
 header($exp.$date." GMT" );

}
?>
