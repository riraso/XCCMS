<?php

include("config.php");
include('session.php');
include('header.php');
$mac =  $_POST["mac"];
$macenc=base64_encode($mac);

$resellerid =$_POST["reseller"];
$bouquest = $_POST['bouquet'];
$bouquet_ids = $_POST['bouquet'];
$expire_datemonth = $_POST['duration'];
$is_trial=0;
if($_POST["trial"] ==1){ $trial=1;}
$ExpDate=$_POST['ExpDate'];
$expire_date=strtotime("$ExpDate");
$max_connections = 1;
$AdminNote=$_POST["AdminNote"];
$ResNote=$_POST["ResNote"];
###############################################################################
$post_data = array( 'user_data' => array(
  'mac' => $mac,
  'exp_date' => $expire_date,
  'bouquet' => json_encode( $bouquet_ids ),
  'member_id' => $owner,
  'admin_notes'=> $AdminNote,
  'reseller_notes'=> $ResNote,
  'is_trial'=> $is_trial));
 
$opts = array( 'http' => array(
    'method' => 'POST',
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'content' => http_build_query( $post_data ) ) );
    
$context = stream_context_create( $opts );

$api_result = json_decode( file_get_contents( $panel_url . "api.php?action=stb&sub=create", false, $context ) );

$sql="SELECT b.id FROM mag_devices a left join users b on b.id=a.user_id  where a.mac='$macenc'";
$result = mysqli_query($db,$sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $userID=$row[id];
            }
          }
 header("Location: mag.php?userid=$userID&action=modify");
die();  
?>
  
  

