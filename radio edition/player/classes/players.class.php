<?php
$webradio_id = htmlspecialchars( mysql_real_escape_string( $_GET['webradio_id'] ) );
$toutes_webradios = mysql_query( "select * from radio_webradios inner join radio_webradios_flux on radio_webradios_flux.flux_webradio_id = radio_webradios.webradio_id where webradio_etat = '1'  order by webradio_position asc " );
$nombre = mysql_num_rows( $toutes_webradios );
$req_webradio = mysql_query( "select * from radio_webradios  inner join radio_webradios_flux on radio_webradios_flux.flux_webradio_id = radio_webradios.webradio_id  where webradio_id = '".$webradio_id."' " );
$infos_webradio = mysql_fetch_array( $req_webradio );
if ( $infos_webradio['webradio_template'] == 2 )
{
    $template = "blanc";
}
else
{
    $template = "noir";
}
if ( $_GET['windows'] == 1 )
{
    $urlactive = "windows";
}
if ( $_GET['flash'] == 1 )
{
    $urlactive = "windows";
}
if ( $_SESSION['identifie'] )
{
    $pre = "SELECT \r\n\t\t\t\t\t\r\n\t\t\t\t\tmembre_id,\r\n\t\t\t\t\tmembre_pseudo,\r\n\t\t\t\t\tmembre_email,\r\n\t\t\t\t\t\r\n\t\t\t\t\tmembre_etat,\r\n\t\t\t\t\tmembre_codevalidationv\r\n\t\t\t\t\t\r\n\t\t\t\t\tFROM `radio_utilisateurs` \r\n\t\t\t\t\tWHERE `membre_pseudo` LIKE '".$_SESSION['identifie']."' \r\n\t\t\t\t\tand `membre_codevalidationv` LIKE '".$_SESSION['membre_codevalidationv']."' \r\n\t\t\t\t\tand membre_etat = '1'";
    if ( !( $query = mysql_query( $pre ) ) )
    {
        exit( mysql_error( ) );
    }
    $nbre_query = mysql_num_rows( $query );
    do
    {
        if ( !( $nbre_query == 1 ) || !( $donnees = mysql_fetch_array( $query ) ) )
        {
            $pre_time = "UPDATE `radio_utilisateurs` SET `lastactivity` = UNIX_TIMESTAMP(NOW()) WHERE `membre_pseudo` LIKE '".htmlspecialchars( trim( strip_tags( $donnees['membre_pseudo'] ) ) )."'  LIMIT 1 ;";
            if ( !( $query_time = mysql_query( $pre_time ) ) )
            {
                exit( mysql_error( ) );
            }
            $mon_profil_mini_membre_id = strip_tags( $donnees['membre_id'] );
            $mon_profil_mini_membre_pseudo = strip_tags( $donnees['membre_pseudo'] );
            $mon_profil_mini_membre_email = strip_tags( $donnees['membre_email'] );
            $mon_profil_mini_membre_etat = strip_tags( $donnees['membre_etat'] );
            $mon_profil_mini_membre_codevalidationv = strip_tags( $donnees['membre_codevalidationv'] );
        }
    } while ( 1 );
}
?>
