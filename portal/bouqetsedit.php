<?php

include("config.php");
include('session.php');


$bqchannelsupdated=$_POST['bqchannels'];

$bqchannelsupdated=json_encode($bqchannelsupdated);
$bq_Id=$_POST['bqId'];
echo $bq_Id;
$sql1 =  "UPDATE `bouquets` SET `bouquet_channels`='$bqchannelsupdated' WHERE `id`=$bq_Id";
$result = mysqli_query($db, $sql1);
$EditBq = "bouqetsdetail.php?bq_Id=$bq_Id";
header("Location: $EditBq");
die();

   ?>