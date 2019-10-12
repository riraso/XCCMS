<?php
include("config.php");
include('session.php');
include('template.php');
include('header.php');
include('function.php');
$userID =$_GET['userid'];
$action=$_GET['action'];


$sql = "SELECT b.id, a.mag_id, a.user_id, b.member_id, b.exp_date, b.admin_enabled, b.enabled, b.admin_notes, b.reseller_notes,  b.max_connections, b.is_trial, a.mac, c.id, c.username  as reseller  FROM mag_devices a left join users b on b.id=a.user_id left join reg_users c on b.member_id=c.id WHERE a.user_id = $userID";
  
$result = mysqli_query($db,$sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $mac=base64_decode($row["mac"]);
        $password=$row["password"];
        $expDateNull= $row['exp_date'];
        $expDate=date('Y-m-d', $row['exp_date']);
        $adminNotes=$row["admin_notes"];
        $resNotes=$row["reseller_notes"];
        $bouquet=$row["bouquet"];
        $bouquetarr = explode(",", substr($bouquet, 1, -1));
        $maxConnections=$row["max_connections"];
        $isRestreamer=$row["is_restreamer"];
        $allowedIpsarr=json_decode($row["allowed_ips"]);
        $allowedIps = implode(", ", $allowedIpsarr);
        $allowedUaarr=json_decode($row["allowed_ua"]);
        $allowedUa = implode(", ", $allowedUaarr);
        $isTrial=$row["is_trial"];
        $bypassUa=$row["bypass_ua"];
    }
}
if ($action== 'modify') {
    ?>

<div class="alert alert-success" role="alert">
  MAC Device Updated!
</div>
<?php
} ;?>
<form action="aftereditmag.php" class="col-sm-10 "  method="post" enctype="multipart/form-data" >

  <div class="form-group row" id="UserId">
    <label for="UserId" class="col-sm-2 col-form-label">User ID:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" readonly id="UserId" name="UserId"  value="<?php echo $userID; ?>" placeholder="">
  
    </div>
  </div>
  <div class="form-group row" id="mac">
    <label for="mac" class="col-sm-2 col-form-label">MAC Address:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" readonly id="mac" name="mac"  value="<?php echo $mac; ?>" placeholder="">
  
    </div>
  </div>
  
  <div class="form-group row">
   
      <label class="col-sm-2 col-form-label" for="reseller">Assign To a Member:</label>
      <div class="col-sm-10">
      <select class="custom-select " id="reseller"  name="reseller">
        <?php
        $catagories = "SELECT * FROM `reg_users`";
        $result = mysqli_query($db,$catagories);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resSec='';
                if($login_sessionId == $row[id]){
                   $resSec="selected";
                }
                echo "<option value='". $row[id]."'  $resSec>". $row[username]."</option>";
            }
        }
        ?>
      </select>
      </div>
   </div>
   <div class="form-group row">
    <div class="col-sm-2">Trial Line</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="trial" name="trial" <?php if($isTrial == 1){ echo "checked";} ?> >
      </div>
    </div>
  </div>
   
  <div class="form-group row">
    <div class="col-sm-2">Unlimited</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="expDateNull" name="expDateNull" <?php if($expDateNull == null){ echo "checked";} ?> >
      </div>
    </div>
  </div>
  <div class="form-group row" id="ExpDate">
    <label for="PassWord" class="col-sm-2 col-form-label">Expire Date :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ExpDate" name="ExpDate"  value="<?php echo $expDate; ?>" placeholder="">
    </div>
  </div>
  <div class="form-group row" id="AdminNote">
    <label for="AdminNote" class="col-sm-2 col-form-label">Admin Note :</label>
    <div class="col-sm-10">
    <textarea class="form-control"  id="AdminNote" name="AdminNote" rows="3"><?php echo  $adminNotes  ;?></textarea>
    </div>
  </div>
  <div class="form-group row" id="ResNote">
    <label for="ResNote" class="col-sm-2 col-form-label">Reseller Note :</label>
    <div class="col-sm-10">
    <textarea class="form-control"  id="ResNote" name="ResNote" rows="3"><?php echo   $resNotes ;?></textarea>
    </div>
  </div>
  <div class="form-group row" style="height:250px;">
   
   <label class="col-sm-2 col-form-label" for="bouquet">Bouquet:</label>
   <div class="col-sm-10">
   <select multiple class="form-control h-100" id="bouquet"  name="bouquet[]">
     <?php
     $catagories = "SELECT * FROM `bouquets`";
     $result = mysqli_query($db,$catagories);
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $bouqSec='';
             if(in_array($row[id],  $bouquetarr)){
                $bouqSec="selected";
             }
             echo "<option value='". $row[id]."'  $bouqSec>". $row[bouquet_name]."</option>";
         }
     }
     ?>
   </select>
   </div>
</div>

 

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" value="upload">Edit MAC</button>
    </div>
  </div>
</form>



<?php include('footer.php'); ?>