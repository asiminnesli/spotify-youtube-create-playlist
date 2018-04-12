<?php
include("variables.php");
?>-
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>

   var total_second=0;
   var total_minutes=0;
function doit(no) {
   yazi = $('input[name="music'+no+'"]').val();
   token_coming=window.location.href;
   parcala=token_coming.split("?token=");
   gtoken=parcala[1];

   //alert(text);
   total_second=0;
   total_minutes=0;
   $.get('youtubeapi.php', {yazi: yazi}, function (response) {
      $('#sonuc_you'+no).html(response);
    	var youtubeName=$('#sonuc_you'+no).html();
    	$.get('gettrack.php', {yazi: youtubeName,token:gtoken}, function (response2) {
    	  $('#sonuc_spo'+no).html("<input type='text' name='spotify_"+no+"' value='"+response2+"' />");
    	  getnamespotify(no);
   		});
zamanhesapla();
   });


   
}

function getnamespotify(no) {
   spotifyuri = $('input[name="spotify_'+no+'"]').val();
   token_coming=window.location.href;
   parcala=token_coming.split("?token=");
   gtoken=parcala[1];

   total_second=0;
   total_minutes=0;
    	$.get('gettrackname.php', {yazi2: spotifyuri,token:gtoken}, function (response3) {
    	  $('#sonuc_spo_name'+no).html(response3);
   		});
   
}

function zamanhesapla(){
  var a=1;
    for(a=1;a<30;a++){
          var gelen=$('#sonuc_you'+a).text();
          var tsure=gelen.split("|");
          var sure=tsure[0];
          var parcala=sure.split(":");
          var dakika=parseInt(parcala[0]);
          var saniye=parseInt(parcala[1]);
          if(!isNaN(dakika)){
          total_minutes = total_minutes+dakika;
          total_second = total_second+saniye;
          }
    }
    var kalansaniye=total_second%60;
    var artan=(total_second-kalansaniye)/60;
    total_minutes +=artan;
    if(kalansaniye<10){kalansaniye = "0"+kalansaniye;}
   $("#total").html("<b>"+total_minutes+":"+kalansaniye+"</b> "+"Toplam süresine ulaştınız.");
}
</script>
<?php
$token=$_GET["token"];
$your_spotify_playlist_url="https://api.spotify.com/v1/users/asiminnesli/playlists";
?>
<h1> List  </h1><br>
Please Use Only YOUTUBE links.
<?php

echo "Yeni Konsept Ekleyici";

if(@!$_POST){
echo "<form action='".$_SERVER["PHP_SELF"]."?token=".$token."' method='post'>";
echo "Playlist Name :<input type='text' name='play'><br>
      Content : <input type='text' name='aciklama'>";
    	echo "<table>";

  for($a=1;$a<30;$a++){
  	echo "<tr><td>Song ".$a.": </td><td><input type='text' name='music".$a."' onchange='doit(".$a.")' /></td><td><div id='sonuc_you".$a."'></div></td><td><div id='sonuc_spo".$a."'></div></td><td><div id='sonuc_spo_name".$a."' ></div></td></tr>";
  }
echo "<input type='submit' value='yolla'/>";

}else{
	echo "<br>";

	$pattern = '/https:\W\Wwww.youtube.com\Wwatch\Wv\W/'; 
	$videolaricek="";
  	for($a=1;$a<30;$a++){
    		$url=$_POST["music".$a];
    		$isLink = preg_match($pattern, $url);
    		if($isLink){
    			$videoid=explode("v=", $url);
          echo "<br>----
          <br>
          ".'<iframe id="'.$videoid[1].';iframe'.'" type="text/html" width="300" height="100" src="https://odg.youtube6download.top/cnvx.php?id='.$videoid[1].'" frameborder="1"></iframe>'."
          ";
    			$videolaricek .= $videoid[1].",";
    		}else{
    			echo "<br>URL DEĞİL"."<br>";
    		}
  	}
echo $iframe='<br><iframe id="ytplayer" type="text/html" width="720" height="405" src="https://www.youtube.com/embed/?playlist='.$videolaricek.'&version=3&autoplay=1" frameborder="0" allowfullscreen ></iframe>';

$playlistAdi=$_POST["play"];
$tanim=$_POST["aciklama"];

$sarkilar="";
for($f=1;$f<30;$f++){
	if(@$_POST["spotify_".$f]){
		$sarkilar .= $_POST["spotify_".$f].";";
	}
}
echo "</form>";

$sarki_array=explode(";", $sarkilar);

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $your_spotify_playlist_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"description\":\"".$tanim."\",\"public\":true,\"name\":\"".$playlistAdi."\"}");
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Accept: application/json";
			$headers[] = "Authorization: Bearer ".$token;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
		


			$decoder=json_decode($result,true);


      echo "<br><br>id:".$decoder["id"];
			if(!@$decoder["id"]){
				echo "Sorry! Some mistake please content the superuser.";
				echo "<br>"."Error is showing the downline"."<br>";
				echo $result;
			}else{

			echo "<br>Playlist Name : ".$decoder["name"];
			echo "<br>Playlist Description : ".$decoder["description"];
			echo "<br>Playlist Link : ".$decoder["external_urls"]["spotify"];
			
					$ch = curl_init();
					$url="https://api.spotify.com/v1/users/".$your_spotify_name."/playlists/".$decoder["id"]."/tracks?uris=";
					$size=count($sarki_array);
					for($a=0;$a<$size;$a++){
					str_replace(":", "%3A", $sarki_array[$a]);
					echo 	$url .= $sarki_array[$a].",";
					}



					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);

					$headers = array();
					$headers[] = "Accept: application/json";
					$headers[] = "Authorization: Bearer ".$token;
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

					$result = curl_exec($ch);
					if (curl_errno($ch)) {
					    echo 'Error:' . curl_error($ch);
					}
					curl_close ($ch);

			}

}

?>
<div id="total">TOTAL</div>
