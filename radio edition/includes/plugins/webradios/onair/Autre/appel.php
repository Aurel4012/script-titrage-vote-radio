<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port = htmlspecialchars( htmlentities( strip_tags( $_GET['port'] ) ) );
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
$fichier = $_SERVER['DOCUMENT_ROOT']."/_cache/".$ip.":".$port.".txt";
$titre = fread( fopen( $fichier, "r" ), filesize( $fichier ) );
$titreencours = $titre;
$_SESSION['titreencours'] = $titreencours;
?>
