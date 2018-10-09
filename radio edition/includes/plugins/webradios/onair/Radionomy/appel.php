<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$stream = htmlspecialchars( htmlentities( strip_tags( $_GET['stream'] ) ) );
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
$xml = simplexml_load_file( "http://api.radionomy.com/currentsong.cfm?radiouid=".$stream."&apikey=Votre_clef_api&type=xml&cover=yes&callmeback=yes&defaultcover=yes&streamurl=yes" );
$cover = $xml->track->cover;
$artists = $xml->track->artists;
$title = $xml->track->title;
$titreencours = utf8_decode( $artists." - ".$title );
if ( $_GET['auther_session'] )
{
    $_SESSION['titreencours_auther_session'] = $titreencours;
}
else
{
    $_SESSION['titreencours'] = $titreencours;
}
?>
