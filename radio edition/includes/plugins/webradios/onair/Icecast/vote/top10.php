<?php
@session_start( );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
require_once( $_SERVER['DOCUMENT_ROOT']."/configuration/mysql_connect.php" );
if ( !( $conn = @mysql_connect( @$mysql_serveur, @$mysql_utilisateur, @$mysql_mot_de_passe ) ) )
{
    exit( mysql_error( ) );
}
if ( !@mysql_select_db( @$mysql_base_de_donnees ) )
{
    exit( mysql_error( ) );
}
$titre = htmlspecialchars( trim( strip_tags( mysql_real_escape_string( urldecode( $_GET['titre'] ) ) ) ) );
$webradio_id = htmlspecialchars( trim( strip_tags( mysql_real_escape_string( urldecode( $_GET['webradio_id'] ) ) ) ) );
$pre_comptage = "select vote_id, vote_titre, vote_idradio, vote_total from radio_webradios_vote WHERE vote_idradio = '".$webradio_id."' and `vote_total` >0 order by vote_total desc  limit 0,10";
$query_comptage = mysql_query( $pre_comptage );
$comptage = mysql_num_rows( $query_comptage );
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody {\r\n\tbackground-color: transparent;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\nbody,td,th {\r\n\tcolor: #FFFFFF;\r\n\tfont-family: Geneva, Arial, Helvetica, sans-serif;\r\n}\r\n-->\r\n\r\n\r\n</style>\r\n\r\n\r\n\r\n\r\n";
echo "<s";
echo "tyle>\r\nform { float:left; }\r\n</style>\r\n\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/ressources/templates/ultimate_rouge/js/jquery/jquery.js\"></script>\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/javascript/jquery.simplemodal.js\"></script>\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/style/stylesheet.css' rel='stylesheet' media='screen' />\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/style/basic.css' rel='stylesheet' media='screen' />\r\n\r\n\r\n";
if ( 0 < $comptage )
{
    $i = 1;
    while ( $infos_titre = mysql_fetch_array( $query_comptage ) )
    {
        echo "\r\n\r\n\r\n";
        echo "<s";
        echo "cript type=\"text/javascript\" src=\"http://";
        echo $_SERVER['HTTP_HOST'];
        echo "/includes/plugins/webradios/onair/Icecast/vote/javascript/init-";
        echo strip_tags( utf8_encode( $infos_titre['vote_id'] ) );
        echo ".js\"></script>\r\n\r\n<div style=\"border-bottom:solid 1px #000000; color:#CCCCCC; padding:1px; font-size:11px; margin-bottom:1px; height:14px;\">\r\n\r\n\r\n<div style=\"width:230px; overflow:hidden; max-width:230px; height:14px;  float:left;\">\r\n";
        echo $i;
        echo " - ";
        echo strip_tags( utf8_encode( stripslashes( $infos_titre['vote_titre'] ) ) );
        echo "</div>\r\n\r\n\r\n<div style=\"float:right; width:42px; text-align:right; height:14px; overflow:hidden;\">\r\n\t\t\t<div id=\"div_vote";
        echo strip_tags( utf8_encode( $infos_titre['vote_id'] ) );
        echo "\">\t\r\n\t\t\t<div id=\"login_response";
        echo ( utf8_encode( $infos_titre['vote_id'] ) );
        echo "\"></div>\r\n\r\n\t\t\t<form class=\"clearfixslide\" method=\"post\" id=\"login\" action=\"javascript:alert('success!');\">\r\n\t\t\t\t\t<input type=\"image\" src=\"http://";
        echo $_SERVER['HTTP_HOST'];
        echo "/ressources/medias/vote/voterpourmini.png\" />\r\n\t\t\t\t\t<input type=\"hidden\" value=\"pour\" name=\"voter\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"action_vote\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"webradio_id\" value=\"";
        echo urlencode( $_GET['webradio_id'] );
        echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"titre\" value=\"";
        echo strip_tags( utf8_encode( $infos_titre['vote_titre'] ) );
        echo "\">\r\n\t\t\t</form>\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t<form class=\"clearfixslide\" method=\"post\" id=\"login\" action=\"javascript:alert('success!');\">\r\n\t\t\t\t\t<input type=\"image\" src=\"http://";
        echo $_SERVER['HTTP_HOST'];
        echo "/ressources/medias/vote/votercontremini.png\" />\r\n\t\t\t\t\t<input type=\"hidden\" value=\"contre\" name=\"voter\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"action\" value=\"action_vote\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"webradio_id\" value=\"";
        echo urlencode( $_GET['webradio_id'] );
        echo "\">\r\n\t\t\t\t\t<input type=\"hidden\" name=\"titre\" value=\"";
        echo strip_tags( utf8_encode( $infos_titre['vote_titre'] ) );
        echo "\">\r\n\t\t\t</form>\r\n\t\t\t</div>\t\r\n</div>\r\n\r\n<div style=\"float:right; float:right; width:50px; text-align:right; margin-right:5px;\">\r\n";
        echo strip_tags( utf8_encode( $infos_titre['vote_total'] ) );
        echo " votes\r\n</div>\r\n\r\n\r\n\r\n\r\n</div>\r\n\r\n\r\n\r\n";
        ++$i;
    }
}
echo "<div style=\"border-bottom:solid 1px #000000; color:#CCCCCC; padding:1px; font-size:11px; margin-bottom:1px; height:14px; overflow:hidden;\">\r\nAucun titre dans le top 10\r\n</div>\r\n\r\n";
?>
