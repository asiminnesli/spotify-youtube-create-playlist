<?php
include("variables.php");

$token=$_GET["token"];
$seach=$_GET["yazi"];


$seach_p=explode("|", $seach);
$seach=$seach_p[1];


$words=str_replace("[Official Video]", "", $seach);
$words_array=explode(" ", $words);
$arama="";
for($a=0;$a<sizeof($words_array);$a++){
	if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $words_array[$a])){
				$arama .= $words_array[$a]." ";
	}


}

$arama=urlencode($arama);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=".$arama."&type=track,artist");
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

echo $json["tracks"]["items"][0]["uri"];

?>