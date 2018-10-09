<?php
ini_set('max_execution_time', 0);

function my_dump($tmp) {
  echo '<pre>';
  print_r($tmp) ;
  // die();
  echo "</pre>";
}

function get_radionomy_cache($radio, $format='json')
{
	global $config;
	if(@file_exists($config[$radio]['cache']) && @filemtime($config[$radio]['cache']) > $config['expire']){ //si cache inferieur prend le xml
     // echo 'expire false';
      $historique = file_get_contents($config[$radio]['cache']);
      $simpleXml = simplexml_load_string($historique);
	}else{//si cache expire regenere le xml
    // echo 'expire true';
      $context = stream_context_create(array('http' => array('timeout' => 50)));
      touch($cache);
      $xml = @file_get_contents($config['radionomy']['api_url'].'?radiouid='.$config[$radio]['uid'].'&apikey='.$config[$radio]['api_key'].'&amount='.$config['nb_titres'].'&type=xml&cover=yes',0, $context);
      if($xml)
       @file_put_contents($config[$radio]['cache'], $xml);
      $historique = file_get_contents($config[$radio]['cache']);
      $simpleXml = simplexml_load_string($historique);
    }
    return ($format == 'json') ? json_encode($simpleXml) : $simpleXml;
}

function get_clean_radionomy_cache($radio)
{
	$tmp = json_decode(get_radionomy_cache($radio));
	foreach ($tmp->track as $t) {
		// si artists non défini, on le prend dans le title
		if(is_object($t->artists)) {
			$t->artists = explode('-', $t->title)[1];
			$t->title = explode('-', $t->title)[0];
		}
		// si cover non défini, on le prend dans le title
		if(!empty(is_object($t->cover))) {
		    $t->cover = 'http://wordpress.surfradio.fr/wp-content/uploads/2018/01/no-cover.jpg';
		}
	}
	return $tmp;
}

function get_last_fm_track ($title, $artist){
	global $config;
	$title = url_slug($title); // Transforme le Titre en slug
	$artist = url_slug($artist); // Transforme l'Artiste en slug

	$query = $config['last_fm']['api_url']."?method=track.getInfo&api_key=".$config['last_fm']['api_key']."&artist=".$artist."&track=".$title."&format=json&lang=fr" ; // Construction de la requête
	$obj = jsonQuery($query); // Récupération résultats de la requête
	if($obj->error==6) {
		$query = $config['last_fm']['api_url']."?method=track.getInfo&api_key=".$config['last_fm']['api_key']."&artist=".$title."&track=".$artist."&format=json" ; // Construction de la requête avec Titre et Artiste inversés
		$obj = jsonQuery($query);
		if($obj->error==6) {
			return false;
		}
	}
    
   	return $obj;
	
}

// function url_slug($str) { // Traite une chaine de caractères en slug (car. spéciaux)
//   $str = strtolower($str);
//   $str = str_replace('+', '%2B', $str);
//   $str = str_replace(',', '%2C', $str);
//   $str = str_replace('$', '%24', $str);
//   $str = str_replace('@', '%40', $str);
//   $str = str_replace('=', '%3D', $str);
//   $str = str_replace(':', '%3A', $str);
//   $str = str_replace('#', '%23', $str);
//   $str = str_replace('&', '%26', $str);
//   $str = str_replace('|', '%7C', $str);
//   $str = str_replace('\'', '%27', $str);
//   $str = str_replace('\\', '%5C', $str);
//   $str = str_replace('/', '%2F', $str);
//   $str = str_replace('[', '%5B', $str);
//   $str = str_replace(']', '%5D', $str);
//   $str = str_replace('{', '%7B', $str);
//   $str = str_replace('}', '%7D', $str);
//   $str = str_replace('`', '%60', $str);
//   $str = str_replace(' ', '%20', $str);

//   return $str ;
// }

// // Effectue une requête, récupère et renvoie le résultat retourné en JSON
// function jsonQuery($query){ 
//       $ch = curl_init();
//       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//       // curl_setopt($ch,  CURLOPT_TIMEOUT_MS, 8000); //timeout in seconds
//       curl_setopt($ch, CURLOPT_URL, $query);
//       $result = curl_exec($ch);
//       curl_close($ch);
//       $resultats = json_decode($result ,true);

//       return $resultats;
//    }

function get_lastfm_infos($artist, $morceau,$track,$radio_current){
	global $config;
      ///ici je definit les infos de radionomy ou de lastfm 
      if ($artist){ // On vérifie que l'Artiste existe dans la BDD de l'API
         $artist = url_slug($artist); // Transforme l'Artiste' en slug
         $query = $config['last_fm']['api_url']."?method=artist.getinfo&artist=".$artist."&api_key=".$config['last_fm']['api_key']."&format=json&lang=fr"; // Construction de la requête
         $artistInfo = jsonQuery($query); // Récupération résultats de la requête
         if ($artistInfo->error==6){ // Erreur ?
            return false;
         }
         
        $ret = [];
        $ret['current_radio'] = $radio_current;
                if (empty($morceau['track']['name'])){//ajouter pour prendre radionomy si rien lastfm
          $ret['title_song'] = $track->title;
          }else{
          $ret['title_song'] = $morceau['track']['name'];// prend titre last fm
          }
        $ret['title_cat'] = $morceau['track']['toptags']['tag'][0]['name'];// categorie musical titre
        if(empty($morceau['track']['album']['image'][3]['#text'])) {
        $ret['title_cover'] = $track->cover;//si rien last fm on appel celle de radionomy
        }else{
         $ret['title_cover'] = $morceau['track']['album']['image'][3]['#text'];//cover track lfm
        }
        if (empty($morceau['track']['name'])){//ajouter pour prendre radionomy si rien lastfm
          $ret['artist'] = $track->artists;
          }else{
          $ret['artist']    = $artistInfo['artist']['name'];
          }
        $ret['artist_cover'] = $artistInfo['artist']['image'][3]['#text'];//cover artiste lfm
        $ret['artist_similaire'] = $artistInfo['artist']['similar']['artist'][0]['name']; // artiste similaire LFM
        $ret['artist_bio_resume'] = $artistInfo['artist']['bio']['summary']; // artiste bio resume LFM
        $ret['artist_bio_full'] = $artistInfo['artist']['bio']['content']; // artiste bio full LFM
        $ret['artist_cat'] = $artistInfo['artist']['tags']['tag'][0]['name']; // artiste category full LFM
        return $ret;
         // my_dump ($ret);
      }
      else{ // Artiste inconnu dans la BDD
         return false;
      }
   }

function get_radionomy_infos($track){
    $ret = [];
    $ret['title_song'] = $track->title;// prend titre radionomy
    $ret['title_cat'] = '';// categorie musical titre radionomy
    $ret['title_cover'] = $track->cover;//cover track radionomy
    $ret['artist']    = $track->artists; //artiste radionomy
    $ret['artist_cover'] = '';//cover artiste radionomy
    $ret['artist_similaire'] = ''; // artiste similaire radionomy
    $ret['artist_bio_resume'] = ''; // artiste bio resume radionomy
    $ret['artist_bio_full'] = ''; // artiste bio full radionomy
    $ret['artist_cat'] = ''; // artiste category full radionomy
    return $ret;
}

function initiales($word){ // recupere les initiale pour l'abcédaire
        $word = strtoupper($word);
        $nb_word = str_word_count($word);
        $word = explode(' ', $word);
        $tagletterword = [];
             for ($i=0; $i <  $nb_word; $i++) { 
               $letter_word = $word[$i];
               array_push($tagletterword, $letter_word[0]);
             }
             return $tagletterword;
} // fin abcédaire


function create_tag($word, $radio){ // creer les tag artiste song

        $word = strtoupper($word);   
        $nb_word = str_word_count($word);
        $word = explode(' ', $word);
        $tagword = [];
             for ($i=0; $i <  $nb_word; $i++) { 
               array_push($tagword, $word[$i]);
             }
             array_push($tagword, $radio);
             return $tagword;
}

function insert_track($infos, $artist_bdd_id)// au cas ou nouveau titre d'un artiste existant
{
                /// creation post song

                  //creation titre en bdd
                  // Create post object titre
                          $postSong = array(
          'post_title'      => $infos['title_song'],
          'post_content'    => $infos['artist'].' - '.$infos['title_song'].':<br><div class="song_cover"><img class="alignnone size-medium wp-image-1398" src="'.$infos['title_cover'].'" alt="'.$infos['title_song'].'" /></div>',
          'post_type'       => 'songs',
          'post_status'     => 'publish',
          'post_category' => array( $infos['current_radio'] ),
          'comment_status' => '',
          'tags_input'      => create_tag($infos['title_song'].' '.$infos['artist'], $infos['current_radio']),//les tags de song
          
        );
                    // $meta_value = array( 
                    //           'song' => array ( trim($post_song_id)),
                    //        );

          $postClassement = array($infos['title_cat'], $infos['current_radio']);
          $postSongid = wp_insert_post( $postSong );
          wp_set_object_terms($postSongid, $postClassement, 'songs_cat');
                                      
                     //insertion meta avec id de l'artiste trim obligatoire car syntaxe eronné en bdd
                              $meta_value = array( 
                              'cover'        => '1',
                              'player_cover' => true,
                              'autoplay'     => false,
                              'repeat'    => false,
                              'song' => array ( trim($post_song_id)),
                              'player'    => 'custom_player',// pour pas mettre le player sinon rx_player
                              'artist' => array (trim($artist_bdd_id)),//id artiste deja exitant
                              'tracks'       => array(
                           array(
                              'type'         => 'mp3',
                              'title'        => wp_filter_nohtml_kses($infos['title_song']),
                              'mp3'       => wp_filter_nohtml_kses( '' ),
                              'poster'    => wp_filter_nohtml_kses( '' ),
                              'artist'    => $infos['artist'],
                              'lyric'        => wp_filter_nohtml_kses( '' ),
                              'buy_icon_a'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_a'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_a'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_b'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_b'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_b'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_c'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_c'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_c'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_d'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_d'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_d'   => wp_filter_nohtml_kses( '' ),
                              'buy_custom'   => '',
                           )
                        )
                              
                           );

                     update_post_meta($postSongid,'cd_meta', $meta_value);
                     update_post_meta($postSongid,'cd_plays', array(1));//met à 1 la lecture    
        // Add Featured Image to Post ajoute une cover au post song
        $image_url        = $infos['title_cover']; // Define the image URL here
        $image_name       = $infos['title_cover'];
        $upload_dir       = wp_upload_dir(); // Set upload folder
        $image_data       = file_get_contents($image_url); // Get image data
        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
        $filename         = basename( $unique_file_name ); // Create image file name

        // Check folder permission and define file location
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        // Create the image  file on the server
        file_put_contents( $file, $image_data );

        // Check image file type
        $wp_filetype = wp_check_filetype( $filename, null );

        // Set attachment data
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Create the attachment
        $attach_id = wp_insert_attachment( $attachment, $file, $postSongid );

        // Include image.php
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id, $attach_data );

        // And finally assign featured image to post
        set_post_thumbnail( $postSongid, $attach_id );
}// fin fonction insert_track

function insert_artist_and_track($infos)
{
  // var_dump($infos);
     //verif data bdd
            $rq = get_page_by_title( $infos['artist'], OBJECT, 'artists' );
            if(!$rq) {
      //artiste existe pas on le fait car le test à etait fait sur le titre avant.
                     // Create post object artiste
          $postArtist = array(
          'post_title'      => $infos['artist'],
          'post_content'    => $infos['artist'].': <br><div class="artist_cover"><img class="alignnone size-medium wp-image-1398" src="'.$infos['artist_cover'].'" alt="'.$infos['artist'].'" /></div><br>'.$infos['artist_bio_full'],
          'post_type'       => 'artists',
          'post_status'     => 'publish',
          'post_category' => array( $infos['current_radio'] ),
          'comment_status' => '',
          'tags_input'      => create_tag($infos['artist'].' '.$infos['artist_cat'],$infos['current_radio']),//les tags de l'artist et de la radio
          
          );
                    

          $postClassement = array($infos['artist_cat'],$infos['current_radio']);
          $abecedaire = initiales($infos['artist']);
          // var_dump($postArtist);
          $postArtistid = wp_insert_post( $postArtist );
          var_dump($postArtistid.' '.$postArtist);
          $meta_value = array( 
                              'artist' => array ( trim($postArtistid)),
                        );
          wp_set_object_terms($postArtistid, $postClassement, 'artists_cat');
          wp_set_object_terms($postArtistid, $abecedaire, 'artist');
           update_post_meta($postArtistid,'cd_meta', $meta_value);
           update_post_meta($postArtistid,'cd_plays', array(1));//met à 1 la lecture                  
              // Add Featured Image to Post ajoute la cover à l'artist
              if (isset($infos['artist_cover'])){
                $image_url        = $infos['artist_cover'];// Define the image URL here
              }else{
                $image_url        = 'http://wordpress.surfradio.fr/wp-content/uploads/2018/01/no-cover.jpg';
              }
              $image_name       = $infos['artist_cover'];
              $upload_dir       = wp_upload_dir(); // Set upload folder
              $image_data       = file_get_contents($image_url); // Get image data
              $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
              $filename         = basename( $unique_file_name ); // Create image file name

              // Check folder permission and define file location
              if( wp_mkdir_p( $upload_dir['path'] ) ) {
                  $file = $upload_dir['path'] . '/' . $filename;
              } else {
                  $file = $upload_dir['basedir'] . '/' . $filename;
              }

              // Create the image  file on the server
              file_put_contents( $file, $image_data );

              // Check image file type
              $wp_filetype = wp_check_filetype( $filename, null );

              // Set attachment data
              $attachment = array(
                  'post_mime_type' => $wp_filetype['type'],
                  'post_title'     => sanitize_file_name( $filename ),
                  'post_content'   => '',
                  'post_status'    => 'inherit'
              );

              // Create the attachment
              $attach_id = wp_insert_attachment( $attachment, $file, $postArtistid );

              // Include image.php
              require_once(ABSPATH . '/wp-admin/includes/image.php');

              // Define attachment metadata
              $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

              // Assign metadata to attachment
              wp_update_attachment_metadata( $attach_id, $attach_data );

              // And finally assign featured image to post
              set_post_thumbnail( $postArtistid, $attach_id );
         }



               /// creation post song
            
            $rq = get_page_by_title( $infos['title_song'], OBJECT, 'songs' );
                       
               
                  //creation titre en bdd
                  // Create post object titre
                          $postSong = array(
          'post_title'      => $infos['title_song'],
          'post_content'    => $infos['artist'].' - '.$infos['title_song'].':<br><div class="song_cover"><img class="alignnone size-medium wp-image-1398" src="'.$infos['title_cover'].'" alt="'.$infos['title_song'].'" /></div>',
          'post_type'       => 'songs',
          'post_status'     => 'publish',
          'post_category' => array( $infos['current_radio'] ),
          'comment_status' => '',
          'tags_input'      => create_tag($infos['title_song'].' '.$infos['artist'], $infos['current_radio']),//les tags de song
          
        );
                    $meta_value = array( 
                              'song' => array ( trim($post_song_id)),
                           );

          $postClassement = array($infos['title_cat'], $infos['current_radio']);
          $postSongid = wp_insert_post( $postSong );
          wp_set_object_terms($postSongid, $postClassement, 'songs_cat');
                                      
                     //insertion meta avec id de l'artiste trim obligatoire car syntaxe eronné en bdd
                              $meta_value = array( 
                              'cover'        => '1',
                              'player_cover' => true,
                              'autoplay'     => false,
                              'repeat'    => false,
                              'player'    => 'custom_player',// pour pas mettre le player sinon rx_player
                              'artist' => array (trim($postArtistid)),
                              'tracks'       => array(
                           array(
                              'type'         => 'mp3',
                              'title'        => wp_filter_nohtml_kses($infos['title_song']),
                              'mp3'       => wp_filter_nohtml_kses( '' ),
                              'poster'    => wp_filter_nohtml_kses( '' ),
                              'artist'    => $infos['artist'],
                              'lyric'        => wp_filter_nohtml_kses( '' ),
                              'buy_icon_a'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_a'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_a'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_b'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_b'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_b'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_c'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_c'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_c'   => wp_filter_nohtml_kses( '' ),
                              'buy_icon_d'   => wp_filter_nohtml_kses( '' ),
                              'buy_title_d'  => wp_filter_nohtml_kses( '' ),
                              'buy_link_d'   => wp_filter_nohtml_kses( '' ),
                              'buy_custom'   => '',
                           )
                        )
                              
                           );

                     update_post_meta($postSongid,'cd_meta', $meta_value);
                     update_post_meta($postSongid,'cd_plays', array(1));//met à 1 la lecture    
        // Add Featured Image to Post ajoute une cover au post song
        $image_url        = $infos['title_cover']; // Define the image URL here
        $image_name       = $infos['title_cover'];
        $upload_dir       = wp_upload_dir(); // Set upload folder
        $image_data       = file_get_contents($image_url); // Get image data
        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
        $filename         = basename( $unique_file_name ); // Create image file name

        // Check folder permission and define file location
        if( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        // Create the image  file on the server
        file_put_contents( $file, $image_data );

        // Check image file type
        $wp_filetype = wp_check_filetype( $filename, null );

        // Set attachment data
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Create the attachment
        $attach_id = wp_insert_attachment( $attachment, $file, $postSongid );

        // Include image.php
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Define attachment metadata
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

        // Assign metadata to attachment
        wp_update_attachment_metadata( $attach_id, $attach_data );

        // And finally assign featured image to post
        set_post_thumbnail( $postSongid, $attach_id );
}// fin fonction artist_and_track

function update_track($id_track){
$cd_plays = get_post_meta($id_track, $key = 'cd_plays');
$nb_plays =number_format_i18n( (int) $cd_plays);
$nb_plays++;
update_post_meta( $id_track,'cd_plays', $nb_plays);
}// fin fonction update track

function json_data_create($infos){
  $data = [];
  $data = [$infos];
  $file = fopen('data_json.json', 'a+');
  fputs ($file, json_encode($data));
  fclose ($file);
}

// function testtrack(){
//   if(@file_exists('data_json.json')){
//     $data_json = file_get_contents('data_json.json');
//     $simpleJson = simplexml_load_string($data_json);
//   }

//   // var_dump($simpleJson);
//   $tmp = json_decode($simpleJson);
//   foreach ($tmp->title_song as $t) {
    
//   }
//   return $tmp->title_song;
// }