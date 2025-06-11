<?php
function spotifyPostRequest($token, $url)
{
    $spotify_curl = curl_init();

    $spotify_curl_options = [
        CURLOPT_URL => $url, 
        CURLOPT_RETURNTRANSFER => TRUE, 
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_POST => TRUE, 
    ];

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data = curl_exec($spotify_curl);
    return $data;
}
?>