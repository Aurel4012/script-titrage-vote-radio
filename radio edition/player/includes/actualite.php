<?php
echo "<div class=\"b_actu\">\r\n";
$req = mysql_query( "\r\n\t\tSELECT \r\n\t\tradio_news.id,\r\n\t\tradio_news.titre,\r\n\t\tradio_news.images,\r\n\t\tradio_news.description,\r\n\t\tradio_news.id_cat,\r\n\t\tradio_news.breaking,\r\n\t\t\r\n\t\t\r\n\t\tradio_catnews.id as idc,\r\n\t\tradio_catnews.nom,\r\n\t\tradio_catnews.ordrer\r\n\t\t\r\n\t\tfrom\r\n\t\t\r\n\t\tradio_news\r\n\t\t\r\n\t\tjoin radio_catnews on radio_catnews.id = radio_news.id_cat\r\n\t\t\r\n\t\tORDER BY radio_news.id DESC limit 0,6\r\n" );
$nombre = mysql_num_rows( $req );
if ( $nombre == 0 )
{
    echo "Aucune actualité";
}
while ( $infos_actu = mysql_fetch_array( $req ) )
{
    $uri = "actualite/".formatrewriting( strip_tags( $infos_actu['nom'] ) )."-".formatrewriting( strip_tags( $infos_actu['idc'] ) )."/".formatrewriting( strip_tags( $infos_actu['titre'] ) )."-".formatrewriting( strip_tags( $infos_actu['id'] ) ).".html";
    echo "<div class=\"tour_actu\">\r\n\t<img src=\"../public/news/";
    echo $infos_actu['images'];
    echo "~70\" width=\"70\" height=\"70\" title=\"";
    echo $infos_actu['titre'];
    echo "\" />\r\n\t<a href=\"#\"  onClick=\"window.opener.location.href='../";
    echo $uri;
    echo "';return(true)\" title=\"";
    echo $infos_actu['titre'];
    echo "\">";
    echo $infos_actu['titre'];
    echo "</a>\r\n</div>\r\n";
}
echo "</div>";
?>
