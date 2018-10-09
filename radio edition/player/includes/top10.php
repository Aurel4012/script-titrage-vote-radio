<?php
echo "<s";
echo "cript language=\"javascript\">\r\n";
if ( $infos_webradio['webradio_titre_encours_fichier_texte'] )
{
    echo "\r\n/* Titre + vote */\r\n$(document).ready(function() {\r\n$(\"#top10\").load(\"http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/titrage_independant/vote/top10.php?webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#top10').animate(\"slow\").load('http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/titrage_independant/vote/top10.php?webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n});\r\n\r\n";
}
else
{
    echo "\r\n/* Titre + vote */\r\n$(document).ready(function() {\r\n$(\"#top10\").load(\"http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/vote/top10.php?webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#top10').animate(\"slow\").load('http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/vote/top10.php?webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n});\r\n\r\n\r\n";
}
echo "\r\n</script>\r\n<div id=\"top10\"><img src=\"images/Loading.gif\" width=\"16\" height=\"16\" alt=\"Chargement\" /></div>";
?>
