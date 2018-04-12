<?php
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$url=$_GET["yazi"];

$vidkeygetirici=explode("https://www.youtube.com/watch?v=", $url);
if(!@$vidkeygetirici[1]){
	die("invalid url");
}
$vidkey = $vidkeygetirici[1];
$apikey = "AIzaSyAAPh_GqR4QvzSW_DblQ7tlOjFNZVUKJvU" ;
$dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$vidkey&key=$apikey", false, stream_context_create($arrContextOptions));
$title=file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$vidkey&key=$apikey", false, stream_context_create($arrContextOptions));

$VidDuration =json_decode($dur, true);

foreach ($VidDuration['items'] as $vidTime) 
	{
		$VidDuration= $vidTime['contentDetails']['duration'];
	
//19M38S
			$playtime=explode("PT", $VidDuration);
				$minutes=explode("M", $playtime[1]);
				$second=explode("S", $minutes[1]);

				echo "&emsp;".$minutes[0]." : ".$second[0]."|";

	}

echo "&emsp;";
$titlegetir =json_decode($title, true);

foreach ($titlegetir['items'] as $vidTime2) 
	{
		echo $vidTime2['snippet']['title'];
	}

?>