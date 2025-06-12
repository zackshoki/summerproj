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
?>