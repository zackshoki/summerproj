<?php
function spotifyGetRequest($token, $url, $formatted_fields)
{
    $spotify_curl = curl_init();

    $spotify_curl_options = [
        CURLOPT_URL => $url."?".$formatted_fields,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE

    ];

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data_json = curl_exec($spotify_curl);
    $data = json_decode($data_json, true);
    return $data; 
    
}
// acoustic brains/music brainz
$musicURL = 'https://musicbrainz.org/ws/2/';
$acousticURL = 'https://acousticbrainz.org/api/v1/';

function isrcToMBID($isrc) { // isrc is a universally identifying code for a specific song recording, mbid is this-api specific idenifying code for the same recording
    global $musicURL; 
    $curl = curl_init(); 

    $curl_options = [
        CURLOPT_URL => $musicURL."isrc/$isrc",
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'User-Agent: Sprintify/1.0 ( zackshoki@gmail.com )'
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE
    ];
    curl_setopt_array($curl, $curl_options);
    $mbid =  curl_exec($curl);
    echo $mbid; //this is not an mbid. what is it?
    // return $mbid;
}
function fetchTrackData($mbids) {
    global $acousticURL;
    $curl = curl_init(); 

    $curl_options = [
        CURLOPT_URL => $acousticURL."low-level?map_classes='true'&recording_ids=".$mbids,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE
    ];
    curl_setopt_array($curl, $curl_options);
    $data_json = curl_exec($curl);
    echo $data_json;
    $data = json_decode($data_json, true);

    return $data;
}
?>