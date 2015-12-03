<?php
/**
 * Use CURL For PHP implement  yar client.
 *
 */


//create request body
$body = '{"i":123123,"m":"test","p":[]}';

//Create Yar Header protocol,about pack rule,more see:http://php.net/manual/zh/function.pack.php

$format = "I1S1I1I1C32C32I1";   // 82bit

$pack = pack($format,123123,0,1626136448,0,
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','','','','','','','','','',
    '','', strlen($body)
);

//Create Package Protocol
$format = "a8";     //8 bit
$packager_pack = pack($format,'JSON');

$protocol_data = $pack.$packager_pack.$body;

$uri = "http://127.0.0.1/server.php";
$ch = curl_init ();
curl_setopt ( $ch, CURLOPT_URL, $uri );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $protocol_data );
$return = curl_exec ( $ch );


$content = substr($return,82 + 8,strlen($return));

$content = json_decode($content,true);


if($content['e']){      //Exception

    throw new Exception($content['e']);

}

if($content['o']){      //Output

    echo $content['o'];

}

$data = $content['r'];          //Return

var_dump($content);


