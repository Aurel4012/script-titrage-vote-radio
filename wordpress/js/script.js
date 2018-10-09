(function ( $, window, document, undefined ) {
	$( document ).ready(function() {
		// $("#jp_jplayer_0").bind($.jPlayer.event.ready, function(event) {
		//  	console.log('ready');
		//  });

		// 	    $("#jp_jplayer_0").bind($.jPlayer.event.play, function(event) {
		// 	    	console.log('play');
		// 	    });

		// $("#jp_jplayer_0").bind($.jPlayer.event.pause, function(event) {
		// 	console.log('pause');
		// });

		// 	    var auto_refresh = setInterval(
		// 	      function ()
		// 	      {
		// 	        $('.ajax_current_title').load('./fluxsurf.php');
		// 	      }, 14000); // rafraichis toutes les 12000 millisecondes
		var auto_refresh = setInterval(
			function ()
			{
				var radio = jQuery('#jp_audio_0').attr('src');
				$.ajax({
					type: 'POST',
					url: ' http://localhost/surfradio/wp-content/themes/remix-child/fluxsurf.php',
					data: 'radio=' + radio,
					dataType: 'html',
					success: function(retour){
						jQuery('.ajax_current_title').text(retour);
					},
					error: function(objet,status,erreur){
						jQuery('.ajax_current_title').text('Erreur lors de la récupération des meta-datas');
					}
				});
			}, 14000); // rafraichissement toutes les 14000 millisecondes
	});


})( jQuery, window, document );