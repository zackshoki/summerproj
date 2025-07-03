<?php

$redirect_uri = 'http://[::1]:8888/index.php';

function requestUserAuthorization()
{ // for user authorization
    global $redirect_uri;
    $client_id = getClientId();
    $scopes = 'ugc-image-upload%20user-modify-playback-state%20playlist-read-private%20playlist-read-collaborative%20playlist-modify-private%20playlist-modify-public%20user-top-read%20user-read-recently-played%20user-library-modify%20user-library-read%20user-read-email%20user-read-private';
    global $state;

    $url = "https://accounts.spotify.com/authorize?client_id=$client_id&response_type=code&redirect_uri=$redirect_uri&scope=$scopes&show_dialog=true&state=$state";

    header("Location: $url");
}

function requestAccessToken($code, $givenState)
{
    global $state, $redirect_uri, $refresh_token;
    $client_id = getClientId(); 
    $client_secret = getClientSecret();
    if (false) { // polish later; this should be a state checker, but i cannot figure out how to do it right, so we will just pretend that the state's are equal
        echo "ERROR state does not match given state";
    } else {
        $url = "https://accounts.spotify.com/api/token?";
        $requestAccessTokenCurl = curl_init();
        $postBody = "grant_type=authorization_code&code=$code&redirect_uri=$redirect_uri";

        $curl_options = [
            CURLOPT_URL => $url . $postBody,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => TRUE,
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
            ],
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

function requestRefreshToken($refresh_token)
{

    global $state, $redirect_uri, $client_id, $client_secret, $refresh_token;

    $url = "https://accounts.spotify.com/api/token?";
    $requestRefreshTokenCurl = curl_init();
    $postBody = "grant_type=refresh_token&refresh_token=$refresh_token";

    $curl_options = [
        CURLOPT_URL => $url . $postBody,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POST => TRUE,
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
        ],
    ];

    curl_setopt_array($requestRefreshTokenCurl, $curl_options);
    $data = curl_exec($requestRefreshTokenCurl);
    $formatted_data = json_decode($data, true);
    if (!isset($formatted_data['error'])) {
        $token = $formatted_data['access_token'];
        if (isset($formatted_data['refresh_token'])) {
            $refresh_token = $formatted_data['refresh_token'];
        }
        setcookie("spotify_token", $token, time() + $formatted_data['expires_in'], "/", "", true, true);
        return $token;
    } else {
        header("Location: login.php");
    }
}
function storeRefreshToken()
{
    global $refresh_token;
    $refresh_token; // eventually query the db to store it
}
function getRefreshToken()
{
    global $refresh_token;
    $refresh_token; // eventually query the db to get it 
}
