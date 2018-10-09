<?php
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1\">\r\n";
echo "<s";
echo "tyle type=\"text/css\">\r\n<!--\r\nbody table tr td {\r\n\ttext-align: center;\r\n}\r\nbody {\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\nbody table tr td div strong {\r\n\tcolor: #FFF;\r\n}\r\nbody table tr td div {\r\n\tcolor: #FFF;\r\n}\r\nbody table tr td div strong {\r\n\tcolor: #000;\r\n}\r\n-->\r\n</style>\r\n<table width=\"250\" border=\"0\" align=\"center\">\r\n  <tr>\r\n    <td width=\"301\"><div alig";
echo "n=\"center\">\r\n      <table width=\"12\" border=\"1\" align=\"center\" cellspacing=\"1\" bordercolor=\"#333333\">\r\n        <tr>\r\n          <td><div align=\"center\">\r\n            ";
$fp = fopen( "titre2.txt", "r" );
$ato_titre = fgets( $fp, 255 );
fclose( $fp );
$ato_titre = str_replace( " (partie1)", "", $ato_titre );
$ato_titre = str_replace( " (partie1)", "", $ato_titre );
$ato_titre = str_replace( " (partie2)", "", $ato_titre );
$ato_titre = str_replace( " (partie3)", "", $ato_titre );
$ato_titre = str_replace( " (partie4)", "", $ato_titre );
$ato_titre = str_replace( " (2010)", "", $ato_titre );
$ato_titre = str_replace( " (2009)", "", $ato_titre );
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
$ato_titre = str_replace( " (1997)", "", $ato_titre );
$Var_2040 = str_replace( " (1998)", "", $ato_titre );
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
$ato_titre = str_replace( " (maxi)", "", $ato_titre );
$ato_titre = str_replace( " (remix)", "", $ato_titre );
$ato_titre = str_replace( " (remix2)", "", $ato_titre );
$ato_titre = str_replace( " (remix 2)", "", $ato_titre );
$ato_titre = str_replace( " (remix3)", "", $ato_titre );
$ato_titre = str_replace( "&", "and", $ato_titre );
$ato_titre = str_replace( "è", "e", $ato_titre );
$ato_titre = str_replace( "é", "e", $ato_titre );
$ato_titre = str_replace( "à", "a", $ato_titre );
$ato_titre = str_replace( "&eacute;", "e", $ato_titre );
$ato_titre = str_replace( "&ccedil;", "c", $ato_titre );
$ato_titre = str_replace( "&agrave;", "a", $ato_titre );
$ato_titre = str_replace( "&egrave;", "e", $ato_titre );
$ato_titre = str_replace( "'", "", $ato_titre );
echo "            ";
$ato_titre_min = strtolower( $ato_titre );
$ato_titre_min = htmlentities( $ato_titre_min );
$ato_titre_min = addslashes( $ato_titre_min );
if ( file_exists( $ato_titre_min.".jpg" ) )
{
    echo "<img src=\"../pochetteMR/".$ato_titre_min.".jpg\" width=\"140\" height=\"140\"></div>";
}
else
{
    echo "<img src=\"../pochetteMR/pasdispomixxradio.jpg\" width=\"140\" height=\"140\"></div>";
}
echo "";
echo "            </div></td>\r\n          </tr>\r\n      </table>\r\n    </div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align=\"center\">";
echo "<s";
echo "trong>\r\n        ";
include( "titre2.txt" );
echo "    </strong>&nbsp;</div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align=\"justify\"></div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><div align=\"center\"><a href=\"http://www.vm-wl.com/Default.aspx?RefererId=141&amp;BannerId=1&amp;RechArtiste=";
echo file_get_contents( "http://www.mixxradio.fr/pochetteMR/virginscript.php?ip=stream.mixxradio.fr&port=80" );
echo "\" target=\"_blank\"><img src=\"../images/bouton_buy.png\" width=\"200\" height=\"32\" border=\"0\" /></a></div></td>\r\n  </tr>\r\n</table>\r\n</body>\r\n</html>\r\n";
?>
