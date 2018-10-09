<?php
header( "content-type: application/x-javascript" );
$vote_id = htmlspecialchars( trim( strip_tags( urldecode( $_GET['vote_id'] ) ) ) );
echo "// Preload Images\r\nimg1 = new Image(16, 16);  \r\nimg1.src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/images/spinner.gif\";\r\n\r\nimg2 = new Image(220, 19);  \r\nimg2.src=\"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/images/ajax-loader.gif\";\r\n\r\n// When DOM is ready\r\n$(document).ready(function(){\r\n\r\n// Launch MODAL BOX if the Login Link is clicked\r\n$(\"#login_link\").click(function(){\r\n$('#login_form').modal();\r\n});\r\n\r\n$(\"#login_link_menu\").click(function(){\r\n$('#login_form').modal();\r\n});\r\n\r\n// When the form is submitted\r\n$(\"#div_vote";
echo $vote_id;
echo " > form\").submit(function(){  \r\n\r\n// Hide 'Submit' Button\r\n$('#submit').hide();\r\n\r\n// Show Gif Spinning Rotator\r\n$('#ajax_loading').show();\r\n\r\n// 'this' refers to the current submitted form  \r\nvar str = $(this).serialize();  \r\n\r\n// -- Start AJAX Call --\r\n\r\n$.ajax({  \r\n    type: \"POST\",\r\n    url: \"http://";
echo $_SERVER['HTTP_HOST'];
echo "/includes/plugins/webradios/onair/Icecast/vote/vote.php\",  // Send the login info to this page\r\n    data: str,  \r\n    success: function(msg){  \r\n   \r\n$(\"#div_vote";
echo $vote_id;
echo "\").ajaxComplete(function(event, request, settings){  \r\n \r\n // Show 'Submit' Button\r\n$('#submit').show();\r\n\r\n// Hide Gif Spinning Rotator\r\n$('#ajax_loading').hide();  \r\n\r\n if(msg == 'OK') // LOGIN OK?\r\n {  \r\n var login_response = 'Merci !';\r\n\r\n$('a.modalCloseImg').hide();  \r\n\r\n$('#simplemodal-container').css(\"width\",\"500px\");\r\n$('#simplemodal-container').css(\"height\",\"120px\");\r\n \r\n $(this).html(log";
echo "in_response); // Refers to 'mpperdu'\r\n\r\n// After 3 seconds redirect the \r\nsetTimeout('affichermessage()', 3000); \r\n }  \r\n else // ERROR?\r\n {  \r\n var login_response = msg;\r\n $('#login_response";
echo $vote_id;
echo "').html(login_response);\r\n }  \r\n      \r\n });  \r\n   \r\n }  \r\n   \r\n  });  \r\n  \r\n// -- End AJAX Call --\r\n\r\nreturn false;\r\n\r\n}); // end submit event\r\n\r\n});\r\n\r\n";
?>
