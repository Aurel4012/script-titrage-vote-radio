<?php
//a mettre pour interdire l'acces direct
// if (php_sapi_name() != "cli") {
//    die('Forbiden!');
//    exit();
// } else{
//    die('ok');
//    exit();
// }
require_once ('../../../wp-load.php');
require_once ('config.inc.php');
require_once ('utils.inc.php');
$radio_current = 'surf radio 80';//la radio definit
// $file = fopen('data_json.json', 'w+');
//         fclose ($file);
$bdd_data = [];
$data_radio = get_clean_radionomy_cache($radio_current);

foreach ($data_radio->track as $track) {
	$rq_artist = get_page_by_title( $track->artists, OBJECT, 'artists' );
	if ($rq_artist){//si titre existe bdd wordpress
		$artist_bdd_id = $rq_artist->ID; //on recupere l'id de l'artiste pour le titre
	}
	$rq_track = get_page_by_title( $track->title, OBJECT, 'songs' );
	if ($rq_track){//si titre existe bdd wordpress
		update_track($rq_track->ID);//incremente le nb de lecture
	}
    
	if(!$rq){//si titre existe pas bdd wordpress
		$morceau = get_last_fm_track($track->title, $track->artists);
		if($morceau) {
			$infos = get_lastfm_infos($track->artists, $morceau, $track, $radio_current);
			if (isset($infos)){
				$morceau = $infos;
			}
		}else{
			// infos radionomy
			$infos = get_radionomy_infos($track);
		}

		// insertion de la track dans bdd
		
		array_push($bdd_data, $infos);
		// json_data_create($infos);
		// insert_track($infos);
		
	}
						
}
    my_dump($bdd_data);
  foreach ($bdd_data as $infos) {//on refait un for each pour pas ateindre la limite de temps
			 if (!isset($artist_bdd_id)){//si artist defini insert que le titre		
			 		 insert_track($infos, $artist_bdd_id);
					 }else{//insert titre et artiste
 		             insert_artist_and_track($infos);
 	                 }
 }
