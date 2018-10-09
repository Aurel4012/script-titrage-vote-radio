<?php
echo "<s";
echo "cript>\r\n\t\t\r\n\r\n/* Pochettes */\r\n$(document).ready(function() {\r\n$(\"#emission_en_cours\").load(\"../includes/plugins/emissions/en_ce_moment.php?popup=1\");\r\n\r\n\r\n$.ajaxSetup({ cache: false });\r\nvar refreshId = setInterval(function()\r\n{\r\n$('#emission_en_cours').animate(\"slow\").load('../includes/plugins/emissions/en_ce_moment.php?popup=1').animate(\"slow\");\r\n}, 15000);\r\n$.ajaxSetup({ cache: false });\r\n\r\n})";
echo ";\r\n\r\n\t\r\n</script>\t\t\t\r\n<div id=\"emission_en_cours\"></div>";
?>
