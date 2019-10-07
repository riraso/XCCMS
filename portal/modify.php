<?php
include("config.php");
include('session.php');
include('header.php');

$resellerid =$login_session;
$username =  $_POST["name"];
$password = $_POST["password"];
$bouquet_ids = $_POST['boq'];
$expire_datemonth = $_POST['duration'];
$bouquest = $_POST['boq'];
$bouquet_ids = $_POST['boq'];
$is_trial=0;
if ($expire_datemonth=="1") {
    $expire_date = strtotime(' + 30 days');
} elseif ($expire_datemonth=="3") {
    $expire_date = strtotime(' + 90 days');
} elseif ($expire_datemonth=="6") {
    $expire_date = strtotime(' + 183 days');
} elseif ($expire_datemonth=="12") {
    $expire_date = strtotime(' + 365 days');
}
###############################################################################
$post_data = array(
    'username' => $username,
    'password' => $password,
    'user_data' => array(
         'bouquet' => json_encode( $bouquet_ids ),
         'exp_date' => $expire_date,
         ) );

$opts = array( 'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( $post_data ) ) );

$context = stream_context_create( $opts );
$api_result = json_decode( file_get_contents( $panel_url . "api.php?action=user&sub=edit", false, $context ) );

?>

    <div>
    <?php
    
    if ($username !=''){?>
     <div class="alert alert-success" role="alert">
  <strong>USER Modified.</strong>
</div>
<div class="alert alert-info" role="alert">
username: <strong><?php echo $username?></strong><br> Password:<strong><?php echo $password?></strong> <br> Expire date: <?php echo date('Y-m-d', $expire_date) ?> <br>Bouqet Edited!!!
</div>

       
       <?php }?>
       <?php  
if( $amount != 0){
  $api_result =  file_get_contents( $panel_url . "api.php?action=reg_user&sub=credits&amount=$amount&id=$login_sessionId") ;
  if($api_result =true){?>
  <div class="alert alert-warning" role="alert">
 Price:<strong> <?php echo $amount?></strong> 
</div>
   
    <?php }}?>
  
   
    <form action=""  class="col-sm-10" method="post" >
            <div class="form-group m-4">
                <form>
                        <div class="form-group">
                    <div class="row">
                        <input type="text" class="form-control mb-2" placeholder="Username" name="name">
                    </div>
                    <div class="row">
                        <input type="text" class="form-control mb-2" placeholder="Uassword" name="password">
                    </div>
                </div>
                    <div class="form-group">
                            <label for="duration">Extended</label>
                            <select class="form-control" id="duration" name="duration">
                                <option value="0">No Change</option>
                                <option value="1">1 Months</option>
                                <option value="3">3 Months</option>
                                <option value="6">6 Months</option>
                                <option value="9">9 Months</option>
                                <option value="12">12 Months</option>
                            </select>
                        </div>
                    <input type="button" id="select_all" class="btn btn-warning mb-2" name="select_all" value="Select All">
                    <input type="button" id="unselect_all" class="btn btn-danger mb-2" name="unselect_all" value="UNSelect All">
                    <div class="row" style="height: 600px">

                        <select class="custom-select mb-2" id="countries" name="boq[]" multiple>
                        <?php
        $bouquetsq= "SELECT * FROM `bouquets`";
        $result = mysqli_query($db,$bouquetsq);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='". $row[id]."' selected>". $row[bouquet_name]."</option>";
            }
        }
        ?>
                         
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </form>
    <script>
        $('#select_all').click(function() {
            $('#countries option').prop('selected', true);
        });
        $('#unselect_all').click(function() {
            $('#countries option').prop('selected', false);
        });
    </script>
   <?php

include('footer.php');

?>
