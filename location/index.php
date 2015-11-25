<?php
include("SxGeo.php");
 $SxGeo = new SxGeo();
 $ip="178.172.146.77";
 $city = $SxGeo->get($ip);

print_r( $city);
