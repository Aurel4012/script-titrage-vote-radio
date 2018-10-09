<?php


$config = array(
   'radionomy' => array(
   		'api_url'  => 'http://api.radionomy.com/tracklist.cfm'
   	),
   'last_fm'   => array(
   		'api_url'  => 'http://ws.audioscrobbler.com/2.0/',
   		'api_key'  => 'votre api_key',
   	),
   'surf radio 80'      => array(
	   		'uid'     => '9b891be7-d120-4baf-a832-3d07fb48ae3d',
	   		'api_key' => 'votre api_key',
	   		'cache'   => 'cache_80.xml',
	   	),
   'surf radio hit'      => array(
	   		'uid'     => 'c6db5f22-eced-4536-9bb6-590d28b9cb0b',
	   		'api_key' => 'votre api_key',
	   		'cache'   => 'cache_surf.xml',
	   	),
   'surf radio clubbing'      => array(
	   		'uid'     => 'b00e5767-8e5b-4162-bcd7-255cc97dd76d',
	   		'api_key' => 'votre api_key',
	   		'cache'   => 'cache_club.xml',
	   	),
   'nb_titres'	   => 12,
   'expire'		   => time() - 310, //310 = 5mn
);
// var_dump($config);