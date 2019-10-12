
<?php
include("config.php");
include('session.php');
include('header.php');
$userID =$_POST['UserId'];
$mac=$_POST['mac'];
$reseller=$_POST['reseller'];
$trial=$_POST['trial'];


$ExpDate=$_POST['ExpDate'];
$ExpDateencode=strtotime("$ExpDate");
$AdminNote=$_POST['AdminNote'];
$ResNote=$_POST['ResNote'];
$bouquet="[" . implode(",",$_POST['bouquet'])."]" ; 

$expDateNull=$_POST['expDateNull'];
if($trial ==null){ $trial=0;}

if($expDateNull == 1){ 
    $updateline="UPDATE `users` SET `member_id`='$reseller',`exp_date`= null,`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`is_trial`=$trial,`bouquet`='$bouquet' WHERE `id`=$userID ";
    }else{
    $updateline="UPDATE `users` SET `member_id`='$reseller',`exp_date`='$ExpDateencode',`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`is_trial`=$trial,`bouquet`='$bouquet' WHERE `id`=$userID ";  
    }$result = mysqli_query($db,$updateline);

    header("Location: mag.php?userid=$userID&action=modify");
die();
    
 
  
  

