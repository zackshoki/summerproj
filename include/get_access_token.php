<?php

$redirect_uri = 'http://[::1]:8888/index.php';

$client_id = 'e222be8a405045a79868de716b5aef44';   // look down
$client_secret = 'd48a28f221264ee8bfe3ad63c33006be'; // these should definitely be stored differently, maybe in the db? 

$refresh_token; // must store in db

function getToken() // no user authorization, uses client credentials
{
    global $client_id;
    global $client_secret;

    $formatted_client_credentials = "grant_type=client_credentials&client_id=$client_id&client_secret=$client_secret";
    $url = "https://accounts.spotify.com/api/token";
    $spotify_token_curl = curl_init();

    $curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded'
        ],
        CURLOPT_POSTFIELDS => $formatted_client_credentials
    ];
    curl_setopt_array($spotify_token_curl, $curl_options);
    $recieved_data = curl_exec($spotify_token_curl);
    $token_array = json_decode($recieved_data, true);
    $token = $token_array['access_token'];
    return $token;
}
function requestUserAuthorization() { // for user authorization
// idk what the state parameter should be??
    global $client_id; // probably should be stored in a different way? maybe should be a parameter in this function and stored in the db?
    global $redirect_uri;
    $scopes = 'ugc-image-upload%20user-modify-playback-state%20playlist-read-private%20playlist-read-collaborative%20playlist-modify-private%20playlist-modify-public%20user-top-read%20user-read-recently-played%20user-library-modify%20user-library-read%20user-read-email%20user-read-private';
    global $state;

    $url = "https://accounts.spotify.com/authorize?client_id=$client_id&response_type=code&redirect_uri=$redirect_uri&scope=$scopes&show_dialog=true&state=$state";

    header("Location: $url");
}

function requestAccessToken($code, $givenState) {
    global $state, $redirect_uri, $client_id, $client_secret, $refresh_token; 
    if (false) { // this should be a state checker, but i cannot figure out how to do it right, so we will just pretend that the state's are equal
        // ref do something! error restart
        echo "ERROR state does not match given state";
        // header("Location: login.php");
    } else {
    $url = "https://accounts.spotify.com/api/token?";
    $requestAccessTokenCurl = curl_init(); 
    $postBody = "grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri";

    $curl_options = [
        CURLOPT_URL => $url.$postBody,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "Authorization: Basic ".base64_encode($client_id.":".$client_secret)
        ],
        // CURLOPT_POSTFIELDS => $postBody this was making everything tweak i think
    ];
    curl_setopt_array($requestAccessTokenCurl, $curl_options);
    $data = curl_exec($requestAccessTokenCurl);
    $formatted_data = json_decode($data, true);
    if (!isset($formatted_data['error'])) {
        $token = $formatted_data['access_token'];
        $refresh_token = $formatted_data['refresh_token'];
        setcookie("spotify_token", $token, time() + $formatted_data['expires_in'], "/", "", true, true); // update the false to true once we have https instead of http
        return $token;
    } else {
        header("Location: login.php");
    }
}
}

function requestRefreshToken($refresh_token) {

    global $state, $redirect_uri, $client_id, $client_secret, $refresh_token; 
    
    $url = "https://accounts.spotify.com/api/token?";
    $requestRefreshTokenCurl = curl_init(); 
    $postBody = "grant_type=refresh_token&refresh_token=$refresh_token";

    $curl_options = [
        CURLOPT_URL => $url.$postBody,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "Authorization: Basic ".base64_encode($client_id.":".$client_secret)
        ],
    ];

    curl_setopt_array($requestRefreshTokenCurl, $curl_options);
    $data = curl_exec($requestRefreshTokenCurl);
    $formatted_data = json_decode($data, true);
    if (!isset($formatted_data['error'])) {
        $token = $formatted_data['access_token'];
        if (isset($formatted_data['refresh_token'])) {$refresh_token = $formatted_data['refresh_token'];}
        setcookie("spotify_token", $token, time() + $formatted_data['expires_in'], "/", "", true, true);
        return $token;
    } else {
        header("Location: login.php");
    }

}
function storeRefreshToken() {
    global $refresh_token; 
    $refresh_token; // eventually query the db to store it
}
function getRefreshToken() {
    global $refresh_token;
    $refresh_token; // eventually query the db to get it 
}
?>