<?php
header( "Content-Type: text/xml;charset=utf-8" );
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port_mount = htmlspecialchars( htmlentities( strip_tags( $_GET['port_mount'] ) ) );
echo "\r\n<Radios>\r\n<radio radio=\"";
echo $ip;
echo "\" port_mount=\"";
echo $port_mount;
echo "\"/> \r\n<radio LCDTextColour=\"1CB5FF\" LCDBackgroundColour=\"444444\" PanelColor=\"222222\" ElementColor=\"666666\"/>\r\n</Radios>";
?>
