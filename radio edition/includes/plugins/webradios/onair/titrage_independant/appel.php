<?php
@session_start( );
header( "Content-Type: text/html; charset=UTF-8" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$uri = $_SERVER['HTTP_HOST']."";
$sans_http = str_replace( "http://", "", $uri );
$fichier = htmlspecialchars( htmlentities( strip_tags( urldecode( $_GET['fichier'] ) ) ) );
$fichier = file( $fichier );
$total = count( $fichier );
$i = 0;
while ( $i < $total )
{
    $donnees .= strip_tags( $fichier[$i] );
    ++$i;
}
$titreencours = utf8_encode( $donnees );
if ( $_GET['auther_session'] )
{
    $_SESSION['titreencours_auther_session'] = $titreencours;
}
else
{
    $_SESSION['titreencours'] = $titreencours;
}
?>
