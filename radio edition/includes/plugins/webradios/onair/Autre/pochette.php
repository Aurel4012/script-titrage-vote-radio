<?php
function get_page( $base, $page )
{
    return file_get_contents( $base.$page );
}

@session_start( );
header( "Content-Type: text/html; charset=iso-8859-1" );
@ini_set( "display_errors", "Off" );
error_reporting( 0 );
$titre = chop( $_SESSION['titreencours'] );
$titre = ltrim( $titre );
$titre = ereg_replace( " ", "-", $titre );
$width = htmlspecialchars( htmlentities( strip_tags( $_GET['width'] ) ) );
$height = htmlspecialchars( htmlentities( strip_tags( $_GET['height'] ) ) );
$req = strtr( $titre, "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜ¯àâãäåçèéêëìíîï©£òóôõöùúûü~ÿ ", "AAAAAACEEEEIIIIOOOOOUUUUYaaaaaceeeeiiiioooooouuuuyyy-" );
$contenu = get_page( $base );
if ( eregi( "<span class=\"ic\">(.*)/></a></span>", $contenu, $title ) )
{
    if ( eregi( "src=\"(.*)\"", $title[1], $title2 ) )
    {
        $chaine3 = $title2[1];
        $str = $title2[1];
        $sansext = explode( ".jpg", $str, 2 );
        $src = $sansext[0].".jpg";
        echo "<img src=\"".$src."\" width=\"".$width."\" height=\"".$height."\">";
        exit( );
    }
    else
    {
        echo "<img src=\"http://".$_SERVER['HTTP_HOST']."/includes/plugins/webradios/onair/Shoutcast/nopochette.jpg\" alt=\"".$titreencours."\"  title=\"".$titreencours."\" width=\"".$width."\" height=\"".$height."\">";
        exit( );
    }
}
else
{
    echo $Tmp_105;
    exit( );
}
?>
