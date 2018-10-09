<?php
function connect_icecast( $host, $port )
{
    $fp = @fsockopen( @$host, @$port, @$errno, @$errstr, 3 );
    if ( !$fp )
    {
        return false;
    }
    fputs( $fp, "GET /status2.xsl".( " HTTP/1.0\r\nUser-Agent: Kiwi Getter (Mozilla Compatible)\r\n\r\n" ) );
    $page = "";
    while ( !feof( $fp ) )
    {
        $page .= fread( $fp, 1000 );
    }
    fclose( $fp );
    return $page;
}

@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port = htmlspecialchars( htmlentities( strip_tags( $_GET['port'] ) ) );
$stream = htmlentities( $Var_576 );
@session_start( );
@ob_start( );
$page = connect_icecast( $ip, $port );
preg_match_all( "`, - ([^,]*)`i", $page, $matches );
$titreencours = $matches[1][$stream];
$_SESSION['titreencours'] = $titreencours;
?>
