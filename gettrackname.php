<?php
include("variables.php");

$token=$_GET["token"];
$spotify_uri=$_GET["yazi2"];


$seach_p=explode(":", $spotify_uri);
$spotify_uri=$seach_p[2];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/tracks/".$spotify_uri);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Authorization: Bearer ".$token;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$json=json_decode($result,true);

echo $json["album"]["artists"][0]["name"]." - ";
echo $json["name"];

?>