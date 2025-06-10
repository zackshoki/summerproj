<?php
function getToken()
{
    $client_id = 'e222be8a405045a79868de716b5aef44';
    $client_secret = 'd48a28f221264ee8bfe3ad63c33006be';

    $formatted_client_credentials = "grant_type=client_credentials&client_id=$client_id&client_secret=$client_secret";
    $url = "https://accounts.spotify.com/api/token";
    $spotify_token_curl = curl_init();

    $curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
        CURLOPT_POSTFIELDS => $formatted_client_credentials
    ];
    curl_setopt_array($spotify_token_curl, $curl_options);
    $recieved_data = curl_exec($spotify_token_curl);

    echo $recieved_data;
}
?>