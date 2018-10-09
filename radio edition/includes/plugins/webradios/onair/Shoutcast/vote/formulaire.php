<?php
@ob_start( );
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
require( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/Shoutcast/appel.php" );
if ( $_GET['auther_session'] )
{
    $titre = $_SESSION['auther_session'];
}
else
{
    $titre = $_SESSION['titreencours'];
}
echo "\r\n";
if ( $_GET['playerwindows'] )
{
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #FFFFFF;\r\n}\r\nbody {\r\n\tbackground-color: #111111;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n</style>\r\n";
}
echo "\r\n\r\n\r\n";
echo "<s";
echo "pan >";
echo $titre;
echo "</span><br />\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/ressources/templates/ultimate_rouge/js/jquery/jquery.js\"></script>\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Shoutcast/vote/javascript/jquery.simplemodal.js\"></script>\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Shoutcast/vote/javascript/init.js\"></script>\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Shoutcast/vote/style/stylesheet.css' rel='stylesheet' media='screen' />\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Shoutcast/vote/style/basic.css' rel='stylesheet' media='screen' />\r\n\r\n";
echo "<s";
echo "tyle>\r\nform { float:left; }\r\n</style>\r\n\r\n\t\t\t<div id=\"action_vote\">\t\r\n\t\t\t<div id=\"login_response\"></div>\r\n\r\n\t\t\t<form class=\"clearfixslide\" method=\"post\" id=\"login\" action=\"javascript:alert('success!');\">\r\n\t\t\t\t\t<input type=\"image\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/ressources/medias/vote/voterpour.png\" />\r\n\t\t\t\t\t<input type=\"hidden\" value=\"pour\" name=\"voter\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"action_vote\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"webradio_id\" value=\"";
echo urlencode( $_GET['webradio_id'] );
echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"titre\" value=\"";
echo htmlentities( $titre );
echo "\">\r\n\t\t\t</form>\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t<form class=\"clearfixslide\" method=\"post\" id=\"login\" action=\"javascript:alert('success!');\">\r\n\t\t\t\t\t<input type=\"image\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/ressources/medias/vote/votercontre.png\" />\r\n\t\t\t\t\t<input type=\"hidden\" value=\"contre\" name=\"voter\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"action_vote\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"webradio_id\" value=\"";
echo urlencode( $_GET['webradio_id'] );
echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"titre\" value=\"";
echo htmlentities( $titre );
echo "\">\r\n\t\t\t</form>\r\n</div>\t\r\n";
?>
