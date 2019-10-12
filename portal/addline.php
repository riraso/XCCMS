<?php
include("config.php");
include('session.php');
include('template.php');
include('header.php');
include('function.php');



if ($action== 'add') {
    ?>

<div class="alert alert-success" role="alert">
  Line Added!
</div>
<?php
} ;?>
<form action="afteraddline.php" class="col-sm-10 "  method="post" enctype="multipart/form-data" >

 
  </div>
  <div class="form-group row" id="username">
    <label for="UserName" class="col-sm-2 col-form-label">User Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="UserName" name="UserName"  value="<?php echo $username; ?>" placeholder="">
  
    </div>
  </div>
  <div class="form-group row" id="password">
    <label for="PassWord" class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="PassWord" name="PassWord"  value="<?php echo $password; ?>" placeholder="">
  
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
   

  <div class="form-group row" id="AllowedIPs " >
    <label for="AllowedIPs " class="col-sm-2 col-form-label">Allowed IPs:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="AllowedIPs" name="AllowedIPs" value="<?php echo $allowedIps; ?>"  placeholder="">
    </div>
  </div>
  <div class="form-group row" id="AllowedDevice" >
    <label for="AllowedDevice" class="col-sm-2 col-form-label">Allowed device:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="AllowedDevice" name="AllowedDevice" value="<?php echo $allowedUa; ?>"  placeholder="">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Restreamer</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="Restreamer" name="Restreamer" <?php if($isRestreamer == 1){ echo "checked";} ?> >
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Bypass Limitation</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="Bypass" name="Bypass" <?php if($bypassUa == 1){ echo "checked";} ?> >
      </div>
    </div>
  </div>
  <div class="form-group row" id="MaxCon" >
    <label for="MaxCon" class="col-sm-2 col-form-label">Max Connection:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="MaxCon" name="maxConnections" value="<?php echo $maxConnections ; ?>" name="MaxCon" placeholder="">
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
      <button type="submit" class="btn btn-primary" value="upload">Edit Line</button>
    </div>
  </div>
</form>



<?php include('footer.php'); ?>