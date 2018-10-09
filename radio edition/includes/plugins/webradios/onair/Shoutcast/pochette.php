<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting(  );
require( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/Shoutcast/appel.php" );
}
if ( $_GET['auther_session'] )
{
    $title = $_SESSION['titreencours_auther_session'];
}
else
{
    $title = $_SESSION['titreencours'];
}
$titre = chop( $title );
$titre = ltrim( $titre );
$titre = ereg_replace( " ", "-", $titre );
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
echo "\r\n";
if ( $_GET['playerwindows'] )
{
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #FFFFFF;\r\n}\r\nbody {\r\n\tbackground-color: #111111;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n</style>\r\n";
}
echo "\r\n";
$titre = strtr( $Var_1224, "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜ¯àâãäåçèéêëìíîï©£òóôõöùúûü~ÿ ", "AAAAAACEEEEIIIIOOOOOUUUUYaaaaaceeeeiiiioooooouuuuyyy-" );
echo "<img src=\"http://".$_SERVER['HTTP_HOST']."/includes/plugins/webradios/onair/Shoutcast/nopochette.jpg\" alt=\"".$titreencours."\" title=\"".$titreencours."\" width=\"".$width."\" height=\"".$height."\">";
?>
