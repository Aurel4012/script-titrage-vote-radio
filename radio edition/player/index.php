<?php
@session_start( );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
require_once( $_SERVER['DOCUMENT_ROOT']."/configuration/conf.php" );
require( "classes/players.class.php" );
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\r\n<title>";
echo $infos_webradio['webradio_nom'];
echo " - ";
echo $infos_webradio['webradio_slogan'];
echo "</title>\r\n<link href=\"css/css.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n\r\n";
echo "<s";
echo "<s";
echo "cript type=\"text/javascript\" src=\"js/player.js\"></script>\r\n\r\n";
echo "<s";
echo "tyle>\r\nbody {\r\n\tbackground-image: url(../public/webradios/";
echo $infos_webradio['webradio_fond'];
echo ");\r\n\tbackground-color: ";
echo $infos_webradio['webradio_fond_couleur'];
echo ";\r\n\tbackground-repeat: repeat-x;\r\n}\r\n</style>\r\n\r\n</head>\r\n\r\n<body >\r\n";
echo code_estats;
echo "\r\n";
echo "<s";
echo "cript type=\"text/javascript\">\r\nvar gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");\r\ndocument.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));\r\n</script>\r\n";
echo "<s";
echo "cript type=\"text/javascript\">\r\ntry{\r\nvar pageTracker = _gat._getTracker(\"";
echo tracker_analitic;
echo "}\");\r\npageTracker._trackPageview();\r\n} catch(err) {}\r\n</script>\r\n\r\n\r\n<div id=\"logo\"><img src=\"../public/webradios/";
echo $infos_webradio['webradio_logo'];
echo "\"   /></div>\r\n\r\n\r\n<div class=\"player_flash\">";
include( "./includes/flash.php" );
echo "</div>\r\n\t\r\n<!--2nd set of tabs-->\r\n<div class=\"simpleTabs\">\r\n<ul class=\"tabs\">\r\n\t\t\t<li><a href=\"#tab1\" title=\"";
echo player;
echo "\"><b>";
echo player;
echo "</b>";
echo "<s";
echo "pan></span></a></li>\r\n\t\t\t<li><a href=\"#tab2\" title=\"";
echo txt_topvote;
echo "\"><b>";
echo txt_topvote;
echo "</b>";
echo "<s";
echo "pan></span></a></li>\r\n\t\t\t<li><a href=\"#tab3\" title=\"";
echo actualite;
echo "\"><b>";
echo actualite;
echo "</b>";
echo "<s";
echo "pan></span></a></li>\r\n\t\t\t";
if ( ACTIV_CHAT == "1" )
{
    echo "<li><a href=\"#tab4\" title=\"";
    echo txt_chat;
    echo "\"><b>";
    echo txt_chat;
    echo "</b>";
    echo "<s";
    echo "pan></span></a></li>";
}
echo "</ul>\r\n        \r\n        \r\n<div class=\"tab_container\">\r\n            <div id=\"tab1\" class=\"tab_content\">\r\n                <div class=\"player\">\r\n                    <h1>";
echo $infos_webradio['webradio_nom'];
echo "</h1>\r\n                    <h2>";
echo txt_en_ce_moment_meteo;
echo "</h2>\r\n                    ";
include( "./includes/pochette.php" );
echo "                    ";
include( "./includes/titre.php" );
echo "                    ";
include( "./includes/encemoment.php" );
echo "                </div>\r\n                    \r\n                    \r\n\t\t\t\t";
echo "<s";
echo "cript>\r\n                $(document).ready(function() {\r\n                $(\"#pub300x250\").load(\"../includes/plugins/publicite/publicite.php?idpublicite_emplacement=6\");\r\n                });\r\n                </script>\t\t\r\n                                    \r\n                <div id=\"pub300x250\"></div>\r\n\t\t\t</div>\r\n    \r\n            <div id=\"tab2\" class=\"tab_content\">\r\n                <div class=\"topvote\">\r";
echo "\n                \t<h4>";
echo txt_topvote;
echo "</h4>\r\n                    ";
include( "./includes/top10.php" );
echo "                </div>                    \r\n             </div>\r\n               \r\n             <div id=\"tab3\" class=\"tab_content\">\r\n                <div class=\"actualite\">\r\n                \t<h4>";
echo actualite;
echo "</h4>\r\n                    ";
include( "./includes/actualite.php" );
echo "                </div>                      \r\n             </div>\r\n             \r\n             ";
if ( ACTIV_CHAT == "1" )
{
    echo "             <div id=\"tab4\" class=\"tab_content\">\r\n\t\t\t\t<div class=\"chat\" id=\"divid\">\r\n                \t<iframe name=\"chat\" SRC=\"../includes/plugins/shoutbox/index.php\" scrolling=\"no\" height=\"387\" width=\"100%\" FRAMEBORDER=\"no\"></iframe>\r\n                </div>\r\n             </div>\r\n             ";
}
echo "                       \r\n\t\t</div>\r\n\t</div><!--Enbd of section-->\r\n\t\r\n</body>\r\n</html>\r\n";
?>
