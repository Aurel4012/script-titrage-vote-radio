<?php
function getDomain( $uri )
{
    $uri = str_replace( "www.", "", $_SERVER['HTTP_HOST'] );
    return $uri;
}

@session_start( );
header( "Content-Type: text/plain charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
include( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/titrage_independant/appel.php" );
if ( $_GET['auther_session'] )
{
    $titre = $_SESSION['titreencours_auther_session'];
}
else
{
    $titre = $_SESSION['titreencours'];
}
if ( $_GET['playerwindows'] )
{
    if ( $_GET['couleur_texte'] )
    {
        $couleur_texte = htmlentities( strip_tags( $_GET['couleur_texte'] ) );
    }
    else
    {
        $couleur_texte = "ffffff";
    }
    if ( $_GET['couleur_fond'] )
    {
        $couleur_fond = htmlentities( strip_tags( $_GET['couleur_fond'] ) );
    }
    else
    {
        $couleur_fond = "111111";
    }
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #";
    echo $couleur_texte;
    echo ";\r\n}\r\nbody {\r\n\tbackground-color: #";
    echo $couleur_fond;
    echo ";\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n\r\n\r\n}\r\n\r\na.acheter_mp3 { display:block; width:101px; height:19px; background:url(\"../images/global.png\") no-repeat; background-position:-0px -1300px; margin:0px; padding:0px; }\r\na.acheter_cd { display:block; width:101px; height:19px; background:url(\"../images/global.png\") no-repeat; background-position:-0px -1321p";
    echo "x;  margin:0px; padding:0px; margin-top:-5px; }\r\n\r\n</style>\r\n";
}
echo "\r\n";
echo "<s";
echo "pan >";
echo $titre;
echo "</span>\r\n\r\n\r\n <br />\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/ressources/templates/ultimate_rouge/js/jquery/jquery.js\"></script>\r\n\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/titrage_independant/vote/javascript/jquery.simplemodal.js\"></script>\r\n";
echo "<s";
echo "cript type=\"text/javascript\" src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/titrage_independant/vote/javascript/init.js\"></script>\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/titrage_independant/vote/style/stylesheet.css' rel='stylesheet' media='screen' />\r\n<link type='text/css' href='http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/titrage_independant/vote/style/basic.css' rel='stylesheet' media='screen' />\r\n\r\n";
echo "<s";
echo "tyle>\r\nform { float:left; }\r\n</style>\r\n\r\n\t\t\t<div id=\"action_vote\">\t\r\n\t\t\t<div id=\"login_response\"></div>\r\n\r\n\t\t\t<form class=\"clearfixslide\" method=\"post\" id=\"login\" action=\"javascript:alert('Patientez svp ...!');\">\r\n\t\t\t\t\t<input type=\"image\" src=\"http://";
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
echo "\">\r\n\t\t\t</form>\r\n            \r\n";
$domaine_sans_www = getdomain( );
require( $_SERVER['DOCUMENT_ROOT']."/configuration/auto_config/modules_activation_".$domaine_sans_www.".php" );
if ( activ_achat_de_titres_fnac )
{
    $texte = $titre;
    $pourfnac = str_replace( " ", "+", $texte );
    $pourfnac = str_replace( "_", "", $texte );
    $pourfnac = preg_replace( "(\r\n|\n|\r)", "", $pourfnac );
    echo "<br /><a href=\"http://ad.zanox.com/ppc/?".activ_achat_de_titres_fnac."&ULP=http://recherche.fnac.com//r/".$pourfnac."?SCat=21!1\" target=\"_blank\" title=\"Acheter ".$titre."\" ><img border=\"0\" src=\"http://".$_SERVER['HTTP_HOST']."/ressources/medias/icones/mp3.png\" alt=\"Acheter\" style=\"margin-bottom:5px;\" /></a><br /><a href=\"http://ad.zanox.com/ppc/?".activ_achat_de_titres_fnac."&ULP=http://recherche.fnac.com//r/".$pourfnac."?SCat=3!1\" target=\"_blank\" title=\"Acheter ".$titre."\" ><img border=\"0\" src=\"http://".$_SERVER['HTTP_HOST']."/ressources/medias/icones/cd.png\" alt=\"Acheter\" /></a>";
}
echo "            \r\n            \r\n</div>\t\r\n";
?>
