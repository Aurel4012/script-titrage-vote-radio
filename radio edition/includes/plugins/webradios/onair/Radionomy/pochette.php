<?php
session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
@error_reporting( 0 );
if ( @$_GET['playerwindows'] )
{
    @require( $_SERVER['DOCUMENT_ROOT']."/includes/plugins/webradios/onair/Radionomy/appel.php" );
}
@$titre = @chop( @$Var_312['titreencours'] );
@$titre = @ltrim( @$titre );
@$titre = @ereg_replace( " ", "+", @$titre );
@$stream = @htmlspecialchars( @htmlentities( @strip_tags( @$_GET['stream'] ) ) );
@$width = @htmlspecialchars( @htmlentities( @strip_tags( @$_GET['width'] ) ) );
@$height = @htmlspecialchars( @htmlentities( @strip_tags( @$_GET['height'] ) ) );
@$xml = @simplexml_load_file( @"http://api.radionomy.com/currentsong.cfm?radiouid=".@$stream."&type=xml&cover=yes&callmeback=yes&defaultcover=yes&streamurl=yes" );
@$cover = @$xml->track->cover;
@$artists = @$xml->track->artists;
@$title = @$xml->track->title;
if ( @$_GET['playerwindows'] )
{
    echo "<META http-equiv=\"Refresh\" content=\"12\">\r\n";
    echo "<s";
    echo "tyle>body,td,th {\r\n\tfont-family: Arial, Helvetica, sans-serif;\r\n\tfont-size: 11px;\r\n\tcolor: #FFFFFF;\r\n}\r\nbody {\r\n\tbackground-color: #111111;\r\n\tmargin-left: 0px;\r\n\tmargin-top: 0px;\r\n\tmargin-right: 0px;\r\n\tmargin-bottom: 0px;\r\n}\r\n</style>\r\n";
}
echo "<img src=\"";
echo $cover;
echo "\" width=\"";
echo $width;
echo "\" height=\"";
echo $height;
echo "\" alt=\"";
echo $title;
echo " - ";
echo $artists;
echo "\" />\r\n";
?>
