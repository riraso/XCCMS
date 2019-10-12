
<?php
include("config.php");
include('session.php');
include('header.php');

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
    $addLine="INSERT INTO `users` SET id = null, `member_id`='$reseller',`username`='$username',`password`='$password',`exp_date`=null,`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`max_connections`=$maxConnections,`is_restreamer`=$Restreamer,`is_trial`=$trial,`bypass_ua`=$Bypass, `bouquet`='$bouquet', `allowed_ips`= '$AllowedIPs',  `allowed_ua`='$AllowedDevice' "; 
    }else{
        $addLine="INSERT INTO `users` SET id = null, `member_id`='$reseller',`username`='$username',`password`='$password',`exp_date`='$ExpDateencode',`admin_notes`='$AdminNote',`reseller_notes`='$ResNote',`max_connections`=$maxConnections,`is_restreamer`=$Restreamer,`is_trial`=$trial,`bypass_ua`=$Bypass, `bouquet`='$bouquet', `allowed_ips`= '$AllowedIPs',  `allowed_ua`='$AllowedDevice' ";  
    }$result = mysqli_query($db,$addLine);

    $addFormat="SELECT id FROM users where `username`='$username'";
    $resultsec = mysqli_query($db,$addFormat);
    if ($resultsec->num_rows > 0) {
        // output data of each row
       
        while($row = $resultsec->fetch_assoc()) {
            $userID=$row["id"];
            $addf1="INSERT INTO user_output SET id = null, user_id= $userID, access_output_id=1 "; 
            $resultf1 = mysqli_query($db,$addf1); 
            $addf2="INSERT INTO user_output SET id = null, user_id= $userID, access_output_id=2 "; 
            $resultf2 = mysqli_query($db,$addf2);
            
        }
        }


   header("Location: line.php?userid=$userID&action=modify");
die();
    
 
  
  

