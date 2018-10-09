<?php
echo "\r\n<!-- Actualisation des titres et pochettes -->\r\n";
echo "<s";
echo "cript>\r\n\r\n\r\n";
if ( $infos_webradio['webradio_titre_encours_fichier_texte'] )
{
    echo "\r\n/* Titre + vote */\r\n$(document).ready(function() {\r\n$(\"#titreencours\").load(\"http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/titrage_independant/vote/formulaire.php?fichier=";
    echo $infos_webradio['webradio_titre_encours_fichier_texte'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#titreencours').animate(\"slow\").load('http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/titrage_independant/vote/formulaire.php?fichier=";
    echo $infos_webradio['webradio_titre_encours_fichier_texte'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n});\r\n\r\n\r\n\r\n";
}
else
{
    echo "/* Titre + vote */\r\n$(document).ready(function() {\r\n$(\"#titreencours\").load(\"http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/vote/formulaire.php?ip=";
    echo $infos_webradio['webradio_serveur_ip'];
    echo "&port=";
    echo $infos_webradio['webradio_serveur_port'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&stream=";
    echo $infos_webradio['webradio_serveur_icecast_strem_numero'];
    echo "\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#titreencours').animate(\"slow\").load('http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/vote/formulaire.php?ip=";
    echo $infos_webradio['webradio_serveur_ip'];
    echo "&port=";
    echo $infos_webradio['webradio_serveur_port'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&stream=";
    echo $infos_webradio['webradio_serveur_icecast_strem_numero'];
    echo "').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n});\r\n";
}
echo "\r\n</script>\t\r\n\r\n\r\n<!-- TITRE EN COURS -->\r\n<div id=\"titreencours\"  ><img src=\"images/Loading.gif\" width=\"16\" height=\"16\" alt=\"Chargement\" /></div>   \r\n";
?>
