<?php
include("variables.php");
$code=$_GET["code"];


echo $auth_code= base64_encode($client_id.":".$client_secret);//base64 encoded client_id:client_secret

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=".$code."&redirect_uri=".$your_redirect_uri);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Authorization: Basic ".$auth_code;
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$sonuc=$result;

$jsondecodela=json_decode($sonuc,true);
print_r($jsondecodela);
echo "<br>";
echo "acc:".$jsondecodela["access_token"];
echo "<br><a href='index.php?token=".$jsondecodela["access_token"]."'>token oluştu devam için tıklayınız."."<a>";


?>
