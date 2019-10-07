<?php

   include("config.php");
   include('session.php');
   include('header.php');
   $chID=$_GET['ch_id'];

   
  
   ?>



    <?php
    
    $sql = "SELECT a.id, a.category_id, a.stream_display_name, a.stream_source, b.server_id, c.server_name, b.stream_status from streams a left join streams_sys b on a.id=b.stream_id left join streaming_servers c on b.server_id=c.id WHERE a.id=$chID ";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $currentTimeinSeconds =$row["exp_date"];
           
            
            $stream_name = $row["stream_display_name"];
            $streamSource=json_decode($row["stream_source"], true);
            $edit="edit";
            $chId=$row['id'];
            $rebootApi="restartstream.php?ch_id=$chId";
            $EditStream="streamssedit.php?ch_id=$chId";
        }
    }
?>
     
     <form  action="restartstreamafteredit.php" method="GET" class="col-10">

     <div class="form-group row">
        <label for="StreamName" class="col-2 col-form-label">Stream ID</label>
        <div class="col-10">
          <input class="form-control" readonly type="text" value=" <?php echo $chID; ?>" id="StreamId" name='streamId'>
        </div>
    </div>
            
     <div class="form-group row">
        <label for="StreamName" class="col-2 col-form-label">Stream Name</label>
        <div class="col-10">
          <input class="form-control" type="text" value=" <?php echo $stream_name; ?>" id="StreamName">
        </div>
    </div>
<div class="form-group row">
  <label for="StreamSource" class="col-2 col-form-label">Source URL</label>


 <div class="col-10">
 <?php
  for ($i=0;$i<sizeof($streamSource);$i++) {
      echo "<input class='form-control' type='text' value='$streamSource[$i]' id='StreamSource' name='StreamSourceNN$i'>";
  }
   ?>
  </div>
 

   
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

   

 
    <script type='text/javascript'>
function doSomething() {
    
    alert( <?php $rebootApi ?> );
    return false;
}
</script>
<script>
// Basic example

</script>
    <script>
        $('#select_all').click(function() {
            $('#countries option').prop('selected', true);
        });
        $('#unselect_all').click(function() {
            $('#countries option').prop('selected', false);
        });
    </script>
    <script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
   <?php include('footer.php');?>