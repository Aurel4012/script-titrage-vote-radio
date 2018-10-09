<?php
header( "Content-Type: text/xml;charset=utf-8" );
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port = htmlspecialchars( htmlentities( strip_tags( $_GET['port'] ) ) );
echo "<Radios>\r\n<radio  radio=\"";
echo $ip;
echo "\" port=\"";
echo $port;
echo "\"/>\r\n</Radios>";
?>
