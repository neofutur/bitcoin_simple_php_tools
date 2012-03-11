<?php

function mtGoxRate($fromcurrency="USD")
{
        $opts = array(
          'http'=> array(
                'method'=>   "GET",
                'user_agent'=>    "MozillaXYZ/1.0"));
        $context = stream_context_create($opts);
        $json = file_get_contents('https://mtgox.com/api/0/data/ticker.php?Currency='.$fromcurrency, false, $context);
        $jdec = json_decode($json);
        $rate = $jdec->{'ticker'}->{'avg'};
        return $rate;
}

?>
