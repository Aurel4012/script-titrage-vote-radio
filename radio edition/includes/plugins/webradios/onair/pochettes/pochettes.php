<?php
@session_start( );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
@error_reporting( 0 );
if ( $_GET['playerwindows'] )
{
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #FFFFFF;\r\n}\r\nbody {\r\n\tbackground-color: #111111;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n</style>\r\n";
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
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
$fichier_jpg = $_SERVER['DOCUMENT_ROOT']."/_pochettes/".$titre.".jpg";
$fichier_jpeg = $_SERVER['DOCUMENT_ROOT']."/_pochettes/".$titre.".jpeg";
$fichier_gif = $_SERVER['DOCUMENT_ROOT']."/_pochettes/".$titre.".gif";
$fichier_png = $_SERVER['DOCUMENT_ROOT']."/_pochettes/".$titre.".png";
$fichier_bmp = $_SERVER['DOCUMENT_ROOT']."/_pochettes/".$titre.".bmp";
if ( file_exists( $fichier_jpg ) )
{
    $image = "".$titre.".jpg";
}
else if ( file_exists( $fichier_jpeg ) )
{
    $image = "".$titre.".jpeg";
}
else if ( file_exists( $fichier_gif ) )
{
    $image = "".$titre.".gif";
}
else if ( file_exists( $fichier_png ) )
{
    $image = "".$titre.".png";
}
else if ( file_exists( $fichier_bmp ) )
{
    $image = "".$titre.".bmp";
}
else
{
    $image = "nopochette.jpg";
}
echo "\r\n<img src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/_pochettes/";
echo $image;
echo "~";
echo $width;
echo "\" width=\"";
echo $width;
echo "\" height=\"";
echo $height;
echo "\" alt=\"";
echo $titre;
echo "\" />";
?>
