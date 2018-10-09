<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
include( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/titrage_independant/appel.php" );
$titre = $titreencours;
if ( $_GET['auther_session'] )
{
    $titre = $_SESSION['titreencours_auther_session'];
}
else
{
    $titre = $_SESSION['titreencours'];
}
echo "\r\n\r\n";
echo "<s";
echo "pan >";
echo $titre;
echo "</span>";
?>
