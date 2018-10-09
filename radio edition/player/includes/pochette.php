<?php
echo "<!-- Pochette -->\r\n";
echo "<s";
echo "cript language=\"javascript\">\r\n";
if ( $infos_webradio['webradio_pochette_url'] )
{
    echo "\t\t\t\t $(document).ready(function() {\r\n\t\t\t\t\t $(\"#pochette\").load(\"../includes/plugins/webradios/onair/titrage_independant/pochette.php?width=130&height=130&fichier=";
    echo $infos_webradio['webradio_pochette_url'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&auther_session=1\");\r\n\t\t\t\t   var refreshId = setInterval(function() {\r\n\t\t\t\t\t $(\"#pochette\").load(\"../includes/plugins/webradios/onair/titrage_independant/pochette.php?width=130&height=130&fichier=";
    echo $infos_webradio['webradio_pochette_url'];
    echo "&webradio_id=";
    echo $infos_webradio['webradio_id'];
    echo "&auther_session=1\");\r\n\t\t\t\t   }, 12000);\r\n\t\t\t\t});\r\n";
}
else if ( $infos_webradio['webradio_url_xml_ctkoi'] )
{
    echo "\t\t\t\t $(document).ready(function() {\r\n\t\t\t\t\t $(\"#pochette\").load(\"../includes/plugins/ctkoi/";
    echo strtolower( $infos_webradio['webradio_url_xml_ctkoi'] );
    echo "/pochette.php?webradio_id=";
    echo strtolower( $infos_webradio['webradio_id'] );
    echo "&width=131\");\r\n\t\t\t\t   var refreshId = setInterval(function() {\r\n\t\t\t\t\t $(\"#pochette\").load(\"../includes/plugins/ctkoi/";
    echo strtolower( $Var_432['webradio_url_xml_ctkoi'] );
    echo "/pochette.php?webradio_id=";
    echo strtolower( $infos_webradio['webradio_id'] );
    echo "&width=131\");\r\n\t\t\t\t   }, 12000);\r\n\t\t\t\t});\r\n";
}
else
{
    echo "\t\r\n/* Pochettes */\r\n$(document).ready(function() {\r\n$(\"#pochette\").load(\"http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/pochette.php?ip=";
    echo $infos_webradio['webradio_serveur_ip'];
    echo "&port=";
    echo $infos_webradio['webradio_serveur_port'];
    echo "&width=130&height=130&stream=";
    echo $infos_webradio['webradio_serveur_icecast_strem_numero'];
    echo "\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#pochette').animate(\"slow\").load('http://";
    echo $_SERVER['HTTP_HOST'];
    echo "/includes/plugins/webradios/onair/";
    echo $infos_webradio['webradio_typeserveur'];
    echo "/pochette.php?ip=";
    echo $infos_webradio['webradio_serveur_ip'];
    echo "&port=";
    echo $infos_webradio['webradio_serveur_port'];
    echo "&width=130&height=130&stream=";
    echo $infos_webradio['webradio_serveur_icecast_strem_numero'];
    echo "').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n});\r\n\r\n";
}
echo "</script>\r\n<!-- Pochette -->\r\n<div id=\"pochette\"><img src=\"images/Loading.gif\" width=\"16\" height=\"16\" alt=\"Chargement\" /></div>   ";
?>
