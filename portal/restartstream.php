<?php
include("config.php");
include('session.php');
include('streamss.php');

$x = file_get_contents("http://$panel_url/api.php?action=stream&sub=start&stream_ids[]=$chId");

echo $x;
