<?php
$ato_titre = $_GET['titre'];
$fp = fopen( "../_cache/88.191.64.200:80.txt", "w" );
$ato_titre = str_replace( " (partie1)", "", $ato_titre );
$ato_titre = str_replace( " (partie2)", "", $ato_titre );
$ato_titre = str_replace( " (partie3)", "", $ato_titre );
$ato_titre = str_replace( " (partie4)", "", $ato_titre );
$ato_titre = str_replace( "(remix2)", "(remix)", $ato_titre );
$ato_titre = str_replace( "(remix3)", "(remix)", $ato_titre );
$ato_titre = str_replace( "\\'", "'", $ato_titre );
$ato_titre = str_replace( "~", "", $ato_titre );
$ato_titre = str_replace( "&", "and", $ato_titre );
$ato_titre = str_replace( "é", "e", $ato_titre );
$ato_titre = str_replace( "", "c", $ato_titre );
$ato_titre = str_replace( "", "a", $ato_titre );
$ato_titre = str_replace( "è", "e", $ato_titre );
$ato_titre = str_replace( "", "u", $ato_titre );
$ato_titre = str_replace( "%", "pourcent", $ato_titre );
$ato_titre = str_replace( " (maxi)", "", $ato_titre );
$ato_titre = str_replace( "  ", " ", $ato_titre );
fwrite( $fp, $ato_titre );
fclose( $fp );
?>
