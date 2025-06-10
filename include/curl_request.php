<?php


$url = "https://api.spotify.com/v1/artists/6vWDO969PvNqNYHIOW5v0m%3Fsi%3DSg61XqNlQX6vdD2e9ofc2g";
$spotify_curl = curl_init();

curl_setopt($spotify_curl, CURLOPT_URL, $url);
curl_setopt($spotify_curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($spotify_curl, CURLOPT_HEADER, 'blah blah');