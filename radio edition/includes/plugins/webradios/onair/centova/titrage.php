<?php
function get_page( $base, $page )
{
    return file_get_contents( $base.$page );
}

@session_start( );
@ob_start( );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port = htmlspecialchars( htmlentities( strip_tags( $_GET['port'] ) ) );
$nomflux = htmlentities( strip_tags( $Var_600 ) );
$base = "http://".$ip."/js.php/".$nomflux."/streaminfo/rnd0";
$contenu = get_page( $base );
if ( eregi( "'song': '(.*)','bitrate':", $contenu, $title ) )
{
    $_SESSION['titreencours'] = $title[1];
}
echo $_SESSION['titreencours'];
?>
