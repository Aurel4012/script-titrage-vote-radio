<?php
require_once ('MusicStoryApi.php');
$ConsumerSecret = 'votre api_key';
 $ConsumerKey = 'votre api_key';

     	$MSAPI = new MusicStoryApi($ConsumerKey, $ConsumerSecret);
        $usersearch = 'daft punk';
         $search = $MSAPI->searchArtist(array('name'=>'daft punk'));
          foreach ($search as $info) {
        $id         = $info->id;
        $title      = $info->name;
        }
     	 // $search = $MSAPI;
     	  echo $id;
     	 my_dump($search);
        // echo $search->id;
         // var_dump($MSAPI->getBiography(is_object($search->id))->header);
         //  $search_bio = $MSAPI->getNews($id)->header;
         // my_dump($search_bio);
//         $search_picture = $MSAPI->getPicture(115916);
// $artist=$MSAPI->searchFacebook(array('artist'=>'daft punk'));
// var_dump($artist);
// $i=1;
// do{
//   $artistes=$genre->getArtists(array('country'=>'France'),$i);
//   foreach($artistes as $artiste){
//     echo "\n".$artiste->name;
//     $j=1;
//     do {
//       $albums=$artiste->getAlbums(array('main'=>'1'),$j);
//       foreach($albums as $album){
//         echo "\n    ".$album->title;
//       }
//       $j++;
//     }while($albums->hasNextPage());
//   }
//   $i++;
// }while($artistes->hasNextPage());
// echo "\n";
function sign_request($request, $consumer_secret, $token_secret = null, $http_method = 'GET') {
	$a = explode('?', $request);
	$host_uri = $a[0];
	$params = isset($a[1])?$a[1]:null;
	$params = explode('&', $params);
	if(isset($params['oauth_signature'])) unset($params['oauth_signature']);
	sort($params);
	ksort($params);
	$encoded_parameters = implode('&',$params);

	$base = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($http_method)));
	$base.= '&';
	$base.= str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($host_uri)));
	$base.= '&';
	$base.= str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($encoded_parameters)));

	$hmac_key = str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($consumer_secret)));
	$hmac_key.= '&';
	$hmac_key.= str_replace('+', ' ', str_replace('%7E', '~', rawurlencode($token_secret)));

	$oauth_signature = base64_encode(hash_hmac('sha1', $base, $hmac_key, true));

	return $request.(strpos($request, '?')?'&':'?').'oauth_signature='.rawurlencode($oauth_signature);
}
// $sign_request = sign_request('http://api.music-story.com/fr/facebook/'.$id , $ConsumerSecret, $ConsumerKey);
// $sign_request = sign_request('http://api.music-story.com/oauth/request_token?oauth_consumer_key='.$ConsumerKey , $ConsumerSecret);
//  my_dump($sign_request);
// $artistzikInfo = jsonQuery(sign_request('http://api.music-story.com/artist/search?name='.url_slug('daft punk') , $ConsumerSecret));
// echo $artistzikInfo;

 $requete = 'https://api.deezer.com/search?q=track:"';
  $query = $requete.url_slug('One More Time').'"';
  $artistDeezerInfo = jsonQuery($query);
  $nb = count($artistDeezerInfo['data']);
  echo $artistDeezerInfo['data']['0']['artist']['name'];
  
    my_dump($artistDeezerInfo['data']);
for ($i=0; $i < $nb; $i++) { 
	if ($artistDeezerInfo['data'][$i]['artist']['name'] === ucwords ('daft punk') ){
	       $preview = $artistDeezerInfo['data'][$i]['preview'];
	      }
}
echo $preview;
  // foreach ($artistDeezerInfo['data'] as $infos) {
  //     if ($infos['name'] == 'Daft Punk' ){
  //      echo $infos['preview'];
  //     }
  // }

function my_dump($tmp) {
  echo '<pre>';
  print_r($tmp) ;
  // die();
  echo "</pre>";
}


function url_slug($str) { // Traite une chaine de caractères en slug (car. spéciaux)
  $str = strtolower($str);
  $str = str_replace('+', '%2B', $str);
  $str = str_replace(',', '%2C', $str);
  $str = str_replace('$', '%24', $str);
  $str = str_replace('@', '%40', $str);
  $str = str_replace('=', '%3D', $str);
  $str = str_replace(':', '%3A', $str);
  $str = str_replace('#', '%23', $str);
  $str = str_replace('&', '%26', $str);
  $str = str_replace('|', '%7C', $str);
  $str = str_replace('\'', '%27', $str);
  $str = str_replace('\\', '%5C', $str);
  $str = str_replace('/', '%2F', $str);
  $str = str_replace('[', '%5B', $str);
  $str = str_replace(']', '%5D', $str);
  $str = str_replace('{', '%7B', $str);
  $str = str_replace('}', '%7D', $str);
  $str = str_replace('`', '%60', $str);
  $str = str_replace(' ', '%20', $str);

  return $str ;
}

// Effectue une requête, récupère et renvoie le résultat retourné en JSON
function jsonQuery($query){ 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch,  CURLOPT_TIMEOUT_MS, 8000); //timeout in seconds
      curl_setopt($ch, CURLOPT_URL, $query);
      $result = curl_exec($ch);
      curl_close($ch);
      $resultats = json_decode($result ,true);

      return $resultats;
   }


?>