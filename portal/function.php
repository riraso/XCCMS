<?php
include("config.php");
function uptime($dateStart){
    $dteNow = time();
    $diff = round(abs($dteNow - $dateStart));
    $seconds = $diff % 60;
    if($seconds < 10 ){
                    $seconds= "0".$seconds ;
                  }
                  $hours   = floor($diff / 3600); 
                  $diff = $diff - $hours*3600; 
                  $minutes = floor($diff / 60);
                  if($minutes < 10 ){
                $minutes= "0".$minutes ;
                  }
                  $uptime=$hours.":".$minutes.":".$seconds."s";
                  return $uptime;
}
function GeoIp($IP){
  $IpLocation= "<a target='_blank' href='https://whatismyipaddress.com/ip/".$IP."'>".$IP."</a>";
  return $IpLocation;
}
function M3u($username,$password,$panel_url){
 
  $m3uUrl="<a target='_blank' href='".$panel_url."/get.php?username=".$username."&password=". $password ."&type=m3u&output=ts'><i class='fa fa-download'></i></a>";
  return $m3uUrl;
}
?>
