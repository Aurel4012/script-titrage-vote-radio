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
session_id( );
session_start( );
header( "Cache-control: private" );
if ( $_POST['action'] )
{
    $titre = htmlspecialchars( trim( strip_tags( $_POST['titre'] ) ) );
    $webradio_id = htmlspecialchars( trim( strip_tags( $_POST['webradio_id'] ) ) );
    $voter = htmlspecialchars( trim( strip_tags( $_POST['voter'] ) ) );
    $ip_adresse_ip = $_SERVER['REMOTE_ADDR'].date( "dmyH" );
    if ( $voter == "pour" )
    {
        $tp = "+";
    }
    if ( $voter == "contre" )
    {
        $tp = "-";
    }
    $nombre_de_vote_trouve = mysql_num_rows( $verification_si_deja_vote );
    if ( $nombre_de_vote_trouve == 0 )
    {
        $pre = "select vote_titre from radio_webradios_vote WHERE `vote_titre` LIKE '".mysql_real_escape_string( $titre )."' and vote_idradio = '".mysql_real_escape_string( $webradio_id )."'";
        $query = mysql_query( $pre );
        $nombre = mysql_num_rows( $query );
        if ( $nombre == 0 )
        {
            if ( !( $insert = mysql_query( "INSERT INTO `radio_webradios_vote` (\r\n\t\t\t\t\t\t\t\t\t\t`vote_id` ,\r\n\t\t\t\t\t\t\t\t\t\t`vote_titre` ,\r\n\t\t\t\t\t\t\t\t\t\t`vote_idradio` ,\r\n\t\t\t\t\t\t\t\t\t\t`vote_total`\r\n\t\t\t\t\t\t\t\t\t\t)\r\n\t\t\t\t\t\t\t\t\t\tVALUES (\r\n\t\t\t\t\t\t\t\t\t\tNULL , '".mysql_real_escape_string( $titre )."', '".$webradio_id."', '".$tp."1');" ) ) )
            {
                exit( mysql_error( ) );
            }
            $dernier = mysql_insert_id( );
            if ( !( $insert_ip = mysql_query( "INSERT INTO `radio_webradios_vote_ip` (\r\n\t\t\t\t\t\t\t\t\t\t`ip_id` ,\r\n\t\t\t\t\t\t\t\t\t\t`ip_id_vote` ,\r\n\t\t\t\t\t\t\t\t\t\t`ip_adresse_ip` \r\n\t\t\t\t\t\t\t\t\t\t)\r\n\t\t\t\t\t\t\t\t\t\tVALUES (\r\n\t\t\t\t\t\t\t\t\t\tNULL , '{$dernier}', '".$ip_adresse_ip."');" ) ) )
            {
                exit( mysql_error( ) );
            }
        }
        else
        {
            $mod = "UPDATE `radio_webradios_vote` SET  vote_total = (vote_total ".$tp." 1) \r\n\t\t\t\t WHERE `vote_titre` LIKE '".mysql_real_escape_string( $titre )."' and vote_idradio = '".mysql_real_escape_string( $webradio_id )."'\r\n\t\t\t\t";
            if ( !( $query_mod = mysql_query( $mod ) ) )
            {
                exit( mysql_error( ) );
            }
            $reprise = mysql_query( "\r\n\t\t\tSELECT \r\n\t\t\t\r\n\t\t\t\r\n\t\t\tradio_webradios_vote.vote_id,\r\n\t\t\tradio_webradios_vote.vote_titre\r\n\t\t\t\r\n\t\t\tfrom radio_webradios_vote\r\n\t\t\t\r\n\t\t\t\r\n\t\t\t\r\n\t\t\tWHERE `vote_titre` LIKE '".$titre."' \r\n\t\t\t\r\n\t\t\t" );
            $info_vote = mysql_fetch_array( $reprise );
            if ( !( $insert_ip = mysql_query( "INSERT INTO `radio_webradios_vote_ip` (\r\n\t\t\t\t\t\t\t\t\t\t`ip_id` ,\r\n\t\t\t\t\t\t\t\t\t\t`ip_id_vote` ,\r\n\t\t\t\t\t\t\t\t\t\t`ip_adresse_ip` \r\n\t\t\t\t\t\t\t\t\t\t)\r\n\t\t\t\t\t\t\t\t\t\tVALUES (\r\n\t\t\t\t\t\t\t\t\t\tNULL , '".$info_vote['vote_id']."', '".$ip_adresse_ip."');" ) ) )
            {
                exit( mysql_error( ) );
            }
        }
        echo "OK";
    }
    else
    {
        $auth_error = "Vous avez d&eacute;j&agrave; vot&eacute; pour ce titre ! ";
        echo $auth_error;
    }
}
?>
