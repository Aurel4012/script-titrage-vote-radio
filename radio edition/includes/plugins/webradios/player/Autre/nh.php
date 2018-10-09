<?php
$radio = $Var_24['currentradiourl'];
echo $radio;
$port = $_POST['currentradioport'];
echo $port;
$open = fsockopen( $radio, $port );
if ( $open )
{
    fputs( $open, "GET /7.html HTTP/1.1\nUser-Agent:Mozilla\n\n" );
    $read = fread( $open, 1000 );
    $text = explode( "content-type:text/html", $read );
    $text = explode( ",", $text[1] );
}
else
{
    $er = "Connection denied!";
}
$RadioDetails = "{$text['6']}";
$Radioart = "&Radioart=";
$Radioart .= $RadioDetails;
include( "shoutcast_class.php" );
$display_array = array( "Stream URL" );
$radio = new Radio( "{$radio}:{$port}" );
$data_array = $radio->getServerInfo( $display_array );
$HISTORY = $radio->getHistoryTable( "/played.html" );
$RadioH = "&RadioH=";
$RadioH .= $HISTORY;
echo $RadioH;
echo $Radioart;
?>
