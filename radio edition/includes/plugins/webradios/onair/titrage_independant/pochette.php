<?php
@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
if ( $_GET['playerwindows'] )
{
    include( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/titrage_independant/appel.php" );
}
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
if ( $_GET['fichier'] )
{
    $fichier = htmlentities( strip_tags( $_GET['fichier'] ) );
}
else if ( $_GET['auther_session'] )
{
    $titre = $_SESSION['titreencours_auther_session'];
}
else
{
    $titre = $_SESSION['titreencours'];
}
$titre = ltrim( $titre );
$titre = ereg_replace( " ", "-", $titre );
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
echo "\r\n";
if ( $_GET['playerwindows'] )
{
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #";
    echo $couleur_texte;
    echo ";\r\n}\r\nbody {\r\n\tbackground-color: #";
    echo $couleur_fond;
    echo ";\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n</style>\r\n";
}
echo "\r\n";
$contenu_array = file( $fichier );
$contenu_string = implode( "", file( $fichier ) );
print $contenu_string;
?>
