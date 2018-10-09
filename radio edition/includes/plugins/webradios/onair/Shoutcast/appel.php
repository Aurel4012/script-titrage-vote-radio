<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$ip = htmlspecialchars( htmlentities( strip_tags( $_GET['ip'] ) ) );
$port = htmlspecialchars( htmlentities( strip_tags( $_GET['port'] ) ) );
$width = htmlspecialchars( htmlentities( strip_tags(  ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
$fp = @fsockopen( @$ip, @$port, @$errno, @$errstr, 30 );
if ( !$fp )
{
    $stat = "down";
    echo "{$errstr} ({$errno})<br />\n";
}
else
{
    $stat = "onair";
}
if ( $stat != "down" )
{
    fputs( $fp, "GET /7.html HTTP/1.0\r\nUser-Agent: Radio Edition Radio script (Mozilla Compatible)\r\n\r\n" );
    while ( !feof( $fp ) )
    {
        $donnes .= fgets( $fp, 1000 );
    }
    fclose( $fp );
    $donnes = ereg_replace( ".*<body>", "", $donnes );
    $donnes = ereg_replace( "</body>.*", ",", $donnes );
    $virgul = explode( ",", $donnes );
    $servstat = $virgul[0];
    $status = $virgul[1];
    if ( $status == "0" )
    {
        $status_ = "off";
        echo "Radio hors ligne\n";
    }
    else
    {
        $status_ = "on";
        $maxauditeurs = $virgul[3];
        $auditeurs = $virgul[4];
        $bitrate = $virgul[5];
        $titre = $virgul[6];
    }
}
$titre_ = chop( $titre );
$infos = explode( "-", $titre_ );
$artiste = chop( $infos[0] );
$titre = chop( $infos[1] );
$titre = ltrim( $titre );
if ( $status != "0" )
{
    $titreencours = $artiste." - ".$titre;
}
else
{
    $titreencours = "Titre non disponible";
}
if ( $_GET['auther_session'] )
{
    $_SESSION['titreencours_auther_session'] = $titreencours;
}
else
{
    $_SESSION['titreencours'] = $titreencours;
}
?>
