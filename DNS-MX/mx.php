<?php

    $hostname = "ovh.com";
    if(dns_get_mx($hostname, $mxhosts, $weights)) {

        foreach($mxhosts as $key => $host) {

            echo "Hostname: $host (Weight: {$weights[$key]}) <br>";
            $ip = gethostbyname($host);
            echo "IP " . $ip . "\n<br>";
            echo "IP " . gethostbyaddr($ip) . "\n<br>";

        }

    } else {

        echo "Could not find any MX records for $hostname\n";

    }

?>
