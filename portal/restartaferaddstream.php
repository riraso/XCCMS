<?php
include("config.php");
include('session.php');
include('header.php');

$streamname=$_POST['StreamName'];
$SourceUrl=$_POST['SourceUrl'];
$StreamIcon=$_POST['StreamIcon'];
$Ondemand=$_POST['Ondemand'];
$probesize=$_POST['probesize'];
$transcodeprofileid=$_POST['transcodeprofileid'];
$Categoryid=$_POST['Categoryid'];
$Serverid=$_POST['Serverid'];



 if ($Ondemand = on){
    $Ondemand=0;
 }else{
    $Ondemand=1;
 }
 
if ($SourceUrl !==''){
    $newStreamSource=str_replace("/", "\/", $SourceUrl);
    $SourceUrlJSON=json_encode($newStreamSource);
    $precheck = "SELECT * FROM `streams` where stream_display_name='$streamname'";
    $result = mysqli_query($db, $precheck);

    if (mysqli_num_rows($result)==0) {
        $sql = "INSERT INTO streams SET id = null, type=1, category_id=$Categoryid, stream_display_name='$streamname', stream_source='[$SourceUrlJSON]',stream_icon='$StreamIcon',auto_restart=0,transcode_profile_id=$transcodeprofileid,probesize_ondemand='$probesize',delay_minutes=0";
        $result = mysqli_query($db, $sql);
        if ($result === true) {
            $last_id = $db->insert_id;
            $sql = "INSERT INTO streams_sys SET server_stream_id = null, stream_id=$last_id, server_id=$Serverid, stream_status=1, on_demand=$Ondemand";
  
            $restartStream = file_get_contents("http://$panel_url/api.php?action=stream&sub=start&stream_ids[]=$last_id");
            $result = mysqli_query($db, $sql);
            echo "<div class='alert alert-success'><strong>Success! </strong>" . $streamname. "added</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }else {
            echo "<div class='alert alert-warning'><strong>Error! </strong>" . $streamname. " already exist</div> " ;
        }
}
 $path = "upload/";
 $filename=basename( $_FILES['uploaded_file']['name']);
 $path = $path . basename( $_FILES['uploaded_file']['name']);
 if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
 
 } else{
     echo "There was an error uploading the file, please try again!";
 }

 $lines = file_get_contents("upload/$filename");
 if ($lines) {
     $m3uarr = explode("\n", $lines);


     for ($i=1;$i<sizeof($m3uarr);$i++) {
         $isstreamname=substr($m3uarr[$i], 0, 7);
  
         if ($isstreamname==="#EXTINF") {
             $streamname=substr($m3uarr[$i], 11);
    
             $j =$i+1;
             $SourceUrl=$m3uarr[$j];
        
             $newStreamSource=str_replace("/", "\/", $SourceUrl);
             $SourceUrlJSON=json_encode($newStreamSource);
             $precheck = "SELECT * FROM `streams` where stream_display_name='$streamname'";
             $result = mysqli_query($db, $precheck);
      
             if (mysqli_num_rows($result)==0) {
                 $sql = "INSERT INTO streams SET id = null, type=1, category_id=$Categoryid, stream_display_name='$streamname', stream_source='[$SourceUrlJSON]',stream_icon='$StreamIcon',auto_restart=0,transcode_profile_id=$transcodeprofileid,probesize_ondemand='$probesize',delay_minutes=0";
                 $result = mysqli_query($db, $sql);
                 if ($result === true) {
                     $last_id = $db->insert_id;
                     $sql = "INSERT INTO streams_sys SET server_stream_id = null, stream_id=$last_id, server_id=$Serverid, stream_status=1, on_demand=$Ondemand";
           
                     $restartStream = file_get_contents("http://$panel_url/api.php?action=stream&sub=start&stream_ids[]=$last_id");
                     $result = mysqli_query($db, $sql);
                     echo "<div class='d-block'><div class='alert alert-success col-sm-10'><strong>Success! </strong>" . $streamname. "added</div></div>";
                 } else {
                     echo "Error: " . $sql . "<br>" . $db->error;
                 }
             } else {
                 echo "<div class='d-block'><div class='alert alert-warning col-sm-10'><strong>Error! </strong>" . $streamname. " already exist</div></div> " ;
             }
         }
     }
     unlink("upload/$filename");
 }




?>
<?php include('footer.php');?>