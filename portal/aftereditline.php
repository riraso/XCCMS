
<?php
include("config.php");
include('session.php');
include('header.php');
$userID =$_POST['UserId'];
$username=$_POST['UserName'];
$password=$_POST['PassWord'];
$reseller=$_POST['reseller'];
$trial=$_POST['trial'];
$AllowedIPs="[" .$_POST['AllowedIPs']."]" ;
$AllowedDevice="[" .$_POST['AllowedDevice']."]" ;
$Restreamer=$_POST['Restreamer'];
$maxConnections=$_POST['maxConnections'];
$ExpDate=$_POST['ExpDate'];
$ExpDateencode=strtotime("$ExpDate");
$AdminNote=$_POST['AdminNote'];
$ResNote=$_POST['ResNote'];
$bouquet="[" . implode(",",$_POST['bouquet'])."]" ; 
$Bypass=$_POST['Bypass'];
$expDateNull=$_POST['expDateNull'];
if($trial ==null){ $trial=0;}
if($Restreamer ==null){ $Restreamer=0;}
if($trial ==null){ $trial=0;}
if($Bypass ==null){ $Bypass=0;}
if($expDateNull == 1){ 
    $updateline="UPDATE `users` SET `member_id`='$reseller',`username`='$username',`password`='$password',`exp_date`= null,`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`max_connections`=$maxConnections,`is_restreamer`=$Restreamer,`is_trial`=$trial,`bypass_ua`=$Bypass,`bouquet`='$bouquet',`allowed_ips`= '$AllowedIPs',  `allowed_ua`='$AllowedDevice' WHERE `id`=$userID ";
    }else{
        $updateline="UPDATE `users` SET `member_id`='$reseller',`username`='$username',`password`='$password',`exp_date`='$ExpDateencode',`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`max_connections`=$maxConnections,`is_restreamer`=$Restreamer,`is_trial`=$trial,`bypass_ua`=$Bypass, `bouquet`='$bouquet', `allowed_ips`= '$AllowedIPs',  `allowed_ua`='$AllowedDevice'  WHERE `id`=$userID ";  
    }$result = mysqli_query($db,$updateline);

    header("Location: line.php?userid=$userID&action=modify");
die();
    
 
  
  

