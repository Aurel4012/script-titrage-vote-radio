<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
include( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/Icecast/appel.php" );
$titre = $titreencours;
echo "<s";
echo "pan >";
echo $titre;
echo "</span>";
?>
