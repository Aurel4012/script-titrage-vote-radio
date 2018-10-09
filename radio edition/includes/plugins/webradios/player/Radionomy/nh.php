<?php
echo "<meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\">\r\n";
$radio = $_POST['currentradiourl'];
echo $radio;
$port = $_POST['currentradioport'];
echo $port;
include( "radio_class.php" );
echo $RadioDetails;
$radio = new Radio( "{$radio}:{$port}" );
$data_array = $radio->getServerInfo( $display_array );
$T = $data_array[4];
$RadioT = "&RadioT=";
$RadioT .= $T;
$RG = $data_array[6];
$Var_936 = "&RadioG=";
$RadioG .= $RG;
$RSN = $data_array[8];
$RadioSNG = "&RadioSNG=";
$RadioSNG .= $RSN;
echo $RadioT;
echo $RadioG;
echo $RadioSNG;
?>
