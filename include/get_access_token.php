<?php
$state = bin2hex(random_bytes(16 / 2)); // random string 16 digits long
$redirect_uri = 'http://[::1]:8888/index.php';

$client_id = 'e222be8a405045a79868de716b5aef44';   // look down
$client_secret = 'd48a28f221264ee8bfe3ad63c33006be'; // these should definitely be stored differently, maybe in the db? 


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
// scopes needed: ugc-image-upload, user-modify-playback-state, playlist-read-private, playlist-read-collaborative, playlist-modify-private, playlist-modify-public, user-top-read, user-read-recently-played, user-library-modify, user-library-read, user-read-email, user-read-private, user-soa-link, soa-manage-partner,  
// idk what the state parameter should be??
    global $client_id; // probably should be stored in a different way? maybe should be a parameter in this function and stored in the db?
    global $redirect_uri;
    $scopes = 'ugc-image-upload%20user-modify-playback-state%20playlist-read-private%20playlist-read-collaborative%20playlist-modify-private%20playlist-modify-public%20user-top-read%20user-read-recently-played%20user-library-modify%20user-library-read%20user-read-email%20user-read-private';
    global $state;

    $url = "https://accounts.spotify.com/authorize?client_id=$client_id&response_type=code&redirect_uri=$redirect_uri&scope=$scopes&show_dialog=true&state=$state";

    header("Location: $url");
}

function requestAccessToken($code, $givenState) {
    global $state, $redirect_uri, $client_id, $client_secret; 
    if ($state != $givenState) {
        // ref do something! error restart
    }
    $url = "https://accounts.spotify.com/api/token";
    $requestAccessTokenCurl = curl_init(); 
    $postBody = "grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri";

    $curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic $client_id:$client_secret"
        ],
        CURLOPT_POSTFIELDS => $postBody
    ];
    curl_setopt_array($requestAccessTokenCurl, $curl_options);
    $data = curl_exec($requestAccessTokenCurl);
    var_dump($data);

}
?>