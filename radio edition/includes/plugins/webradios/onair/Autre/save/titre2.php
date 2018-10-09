<?php
$fp = fopen( "titre.txt", "r" );
$ato_titre = fgets( $fp, 255 );
$ato_titre = str_replace( "En ce moment: ", "", $ato_titre );
$ato_titre = str_replace( "En ce moment sur MIXX radio: ", "", $ato_titre );
$ato_titre = str_replace( " (1986)", "", $ato_titre );
$ato_titre = str_replace( " (http://www.mixxradio.fr)", "", $ato_titre );
$ato_titre = str_replace( " (remix 2)", "", $ato_titre );
$ato_titre = str_replace( " (partie1)", "", $ato_titre );
$ato_titre = str_replace( " (partie2)", "", $ato_titre );
$ato_titre = str_replace( " (partie3)", "", $ato_titre );
$ato_titre = str_replace( " (partie4)", "", $ato_titre );
$ato_titre = str_replace( " (0000)", "", $ato_titre );
$ato_titre = str_replace( " (1987)", "", $ato_titre );
$ato_titre = str_replace( " (1988)", "", $ato_titre );
$ato_titre = str_replace( " (1989)", "", $ato_titre );
$ato_titre = str_replace( " (1990)", "", $ato_titre );
$ato_titre = str_replace( " (1991)", "", $ato_titre );
$ato_titre = str_replace( " (1992)", "", $ato_titre );
$ato_titre = str_replace( " (1993)", "", $ato_titre );
$ato_titre = str_replace( " (1994)", "", $ato_titre );
$ato_titre = str_replace( " (1995)", "", $ato_titre );
$ato_titre = str_replace( " (1996)", "", $ato_titre );
$Var_2088 = str_replace( " (1997)", "", $ato_titre );
$ato_titre = str_replace( " (1998)", "", $ato_titre );
$ato_titre = str_replace( " (1999)", "", $ato_titre );
$ato_titre = str_replace( " (2000)", "", $ato_titre );
$ato_titre = str_replace( " (2001)", "", $ato_titre );
$ato_titre = str_replace( " (2002)", "", $ato_titre );
$ato_titre = str_replace( " (2003)", "", $ato_titre );
$ato_titre = str_replace( " (2004)", "", $ato_titre );
$ato_titre = str_replace( " (2005)", "", $ato_titre );
$ato_titre = str_replace( " (2006)", "", $ato_titre );
$ato_titre = str_replace( " (2007)", "", $ato_titre );
$ato_titre = str_replace( " (2008)", "", $ato_titre );
$ato_titre = str_replace(  );
$ato_titre = str_replace( " (maxi)", "", $ato_titre );
$ato_titre = str_replace( " (Bob Sinclar remix)", "", $ato_titre );
$ato_titre = str_replace( "artiste - titre-advert=", "", $ato_titre );
$ato_titre = str_replace( "~", "", $ato_titre );
$ato_titre = str_replace( "&", "and", $ato_titre );
$ato_titre = str_replace( "é", "e", $ato_titre );
$ato_titre = str_replace( "ç", "c", $ato_titre );
$ato_titre = str_replace( "à", "a", $ato_titre );
$ato_titre = str_replace( "è", "e", $ato_titre );
$ato_titre = str_replace( "ü", "u", $ato_titre );
$ato_titre = str_replace( "%", "pourcent", $ato_titre );
$ato_titre = str_replace( "'", "", $ato_titre );
fclose( $fp );
echo "\r\n</font></a></font>\r\n<meta http-equiv=\"Refresh\" content=\"15\" />\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody,td,th {\r\n\tfont-family: Verdana, Arial, Helvetica, sans-serif;\r\n\tfont-size: 10px;\r\n\tcolor: #FFFFFF;\r\n\tfont-weight: bold;\r\n}\r\nbody {\r\n\tbackground-color: #333333;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n.Style3 {font-size: 11px}\r\n.style4 {\r\n\tcolor: #FFFFFF\r\n}\r\n.style5 {color: #FF9900; }\r\n#apDiv1 {\r\n\tposition:absolute;\r\n\tle";
echo "ft:0px;\r\n\ttop:29px;\r\n\twidth:138px;\r\n\theight:118px;\r\n\tz-index:1;\r\n}\r\n-->\r\n</style>\r\n<div id=\"apDiv1\">\r\n  <table width=\"143\" border=\"0\">\r\n    <tr>\r\n      <td colspan=\"2\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"2\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"2\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"2\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"2\">&nbsp;</td>\r\n    </tr>\r\n    <tr>";
echo "\r\n      <td width=\"64\" height=\"41\">&nbsp;</td>\r\n      <td width=\"79\"><div align=\"right\"></div></td>\r\n    </tr>\r\n  </table>\r\n</div>\r\n<CENTER>\r\n<table width=\"147\" border=\"0\" align=\"center\">\r\n  <tr>\r\n    <td width=\"141\"><table width=\"141\" border=\"0\" align=\"left\">\r\n      <tr>\r\n        <td width=\"150\"><table width=\"135\" height=\"120\" border=\"1\" cellspacing=\"0\" bordercolor=\"#666666\">\r\n            <tr>\r\n              <td wi";
echo "dth=\"130\" height=\"100\">";
$ato_titre_min = strtolower( $ato_titre );
$ato_titre_min = htmlentities( $ato_titre_min );
$ato_titre_min = addslashes( $ato_titre_min );
if ( file_exists( "".$ato_titre_min.".jpg" ) )
{
    echo "<img src=\"/".$ato_titre_min.".jpg\" width=\"135\" height=\"135\"></div>";
}
else
{
    echo "<img src=\"pasdispomixxradio.jpg\" width=\"135\" height=\"135\"></div>";
}
echo "";
echo "</td>\r\n            </tr>\r\n        </table></td>\r\n      </tr>\r\n      <tr>\r\n        <td><!-- D&eacute;but du code du texte d&eacute;filant d'Astwinds-->\r\n            <marquee behavior=\"scroll\" direction=\"left\" width=\"100%\" height=\"19\" scrollamount=\"3\" scrolldelay=\"0\" class=\"Scroller Style3 style4\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">\r\n            <font face=\"Verdana\">";
echo "<s";
echo "trong> ";
echo "<s";
echo "pan class=\"style5\">En ce moment sur MIXX radio: </span>\r\n            ";
include( "titre.txt" );
echo "            </strong></font>\r\n            </marquee>\r\n            <!-- Fin du code du texte d&eacute;filant d'Astwinds -->\r\n            </strong></font>\r\n            </marquee>\r\n            <!-- Fin du code du texte d&eacute;filant d'Astwinds -->\r\n        </td>\r\n      </tr>\r\n    </table></td>\r\n  </tr>\r\n</table>\r\n";
?>
