<?php
include("config.php");
include('session.php');
include('template.php');
include('header.php');
?>

<form action="restartaferaddstream.php" class="col-sm-10 "  method="post" enctype="multipart/form-data" >
<div class="form-group row">
   
   <label class="col-sm-2 col-form-label" for="importtype">import type:</label>
   <div class="col-sm-10">
   <select class="custom-select " id="importtype" name="importtype">
     <option value="Manually" selected>Manually</option>
     <option value="m3ufile">From M3u file</option>
   </select>
   </div>
</div>
  <div class="form-group row" id="streamnameM">
    <label for="StreamName" class="col-sm-2 col-form-label">Stream Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="StreamName" name="StreamName" placeholder="">
    </div>
  </div>
  
  <div class="form-group row" id="Manually" >
    <label for="SourceUrl" class="col-sm-2 col-form-label">Source Url:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="SourceUrl" name="SourceUrl"  placeholder="">
    </div>
  </div>
  <div class="form-group row" id="m3ufile" style="display:none">
    <label class="col-sm-2 col-form-label" for="importm3u">Import m3u:</label>
    <div class="col-sm-10">
    <input type="file" name="uploaded_file">
    </div>
  </div>
  <div class="form-group row" id="StreamIconm" >
    <label for="StreamIcon" class="col-sm-2 col-form-label">Stream Icon:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="StreamIcon" name="StreamIcon" placeholder="">
    </div>
  </div>
  <div class="form-group row">
   
      <label class="col-sm-2 col-form-label" for="Categoryid">Category:</label>
      <div class="col-sm-10">
      <select class="custom-select " id="Categoryid" name="Categoryid">
        <?php
        $catagories = "SELECT * FROM `stream_categories`";
        $result = mysqli_query($db,$catagories);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='". $row[id]."' selected>". $row[category_name]."</option>";
            }
        }
        ?>
      </select>
      </div>
   </div>
  <div class="form-group row">
    <div class="col-sm-2">On Demand</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="Ondemand" name="Ondemand">
        <label class="form-check-label" for="Ondemand">
          Enable Ondemand
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="probesize ondemand" class="col-sm-2 col-form-label">probesize ondemand:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="probesize ondemand" name="probesize" placeholder="" value='12800'>
    </div>
  </div>
  <div class="form-group row">
   
   <label class="col-sm-2 col-form-label" for="Serverid">Server :</label>
   <div class="col-sm-10">
   <select class="custom-select " id="Serverid" name="Serverid">
   <?php
        $servers = "SELECT * FROM `streaming_servers`";
        $result = mysqli_query($db,$servers);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='". $row[id]."' selected>". $row[server_name]."</option>";
            }
        }
        ?>
   </select>
   </div>
</div>
  <div class="form-group row">
   
      <label class="col-sm-2 col-form-label" for="transcodeprofileid">transcode profile:</label>
      <div class="col-sm-10">
      <select class="custom-select " id="transcodeprofileid" name="transcodeprofileid">
      <?php
        $transcoding = "SELECT * FROM `transcoding_profiles`";
        $result = mysqli_query($db,$transcoding);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='". $row[profile_id]."' selected>". $row[profile_name]."</option>";
            }
        }
        ?>
      </select>
      </div>
   </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" value="upload">Add Stream</button>
    </div>
  </div>
</form>


<script>
var Privileges = jQuery('#importtype');
var select = this.value;
Privileges.change(function () {
    if ($(this).val() == 'Manually') {
        $('#Manually').show();
        $('#m3ufile').hide();
    }
    else{
      $('#m3ufile').show();
      $('#Manually').hide();
      $('#StreamIconm').hide();
      $('#streamnameM').hide();
    } 
});
</script>

<?php include('footer.php');?>