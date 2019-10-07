<?php

   include("config.php");
   include('session.php');
   include('header.php');
   $username =$_POST['servers'];
   $ServerIDs = implode (", ", $username);
   $status =$_POST['status'];  

   ?>

    <form  action="" method="post">
  <div class=" form-group row">
    <div class="col-sm">
    <label for="selectservrs">Server</label>
    <select multiple class="form-control" id="selectservrs" name="servers[]">
    <?php
$sql1 = "SELECT `id`, `server_name` FROM `streaming_servers`"; 
$result = mysqli_query($db,$sql1);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { ?>
     
      <option value="<?php echo $row['id']; ?>"><?php echo $row[server_name]; ?></option>
   

    
    <?php
    }
}

    ?>
     </select>
    </div>
    <div class="col-sm">
    <label for="selectStatus">Status</label>
    <select multiple class="form-control" id="selectStatus" name="status">
    
     
      <option value="1">offline</option>
      <option value="0">online</option>

     </select>
    </div>
   
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>

</div>
</form>

 

    <table id="myTable" class="table table-striped  table-bordered mt-5">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Status</th>
        <th scope="col">Name</th>
        <th scope="col">source</th>
        <th scope="col">server</th>
        <th scope="col">reboot</th>
        <th scope="col">Edit</th>

    </tr>
    </thead>
</tbody>
    <?php
    $sql = "SELECT a.id, a.category_id, a.stream_display_name, a.stream_source, b.server_id, c.server_name, b.stream_status from streams a left join streams_sys b on a.id=b.stream_id left join streaming_servers c on b.server_id=c.id where b.server_id in ($ServerIDs) and a.type=1 and b.on_demand = 0 and b.stream_status=$status " ;
          $result = mysqli_query($db,$sql);
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $currentTimeinSeconds =$row["exp_date"];
                 
                  if( $status == 0){
                    $sStatus= '<span class="text-success">online</span>';
                  }else {
                    $sStatus= '<span class="text-danger">offline</span>';
                  }
                  $username = substr($row["username"], 0, 25);
                  $streamSource=json_decode($row["stream_source"]);
                  $edit="edit";
                  $chId=$row['id'];
                  $rebootApi="restartstream.php?ch_id=$chId";
                  $EditStream="streamssedit.php?ch_id=$chId";
                  
                  echo "<tr><td> " . $row["id"]. "</td><td >". $sStatus. "</td><td>" . $row["stream_display_name"]. "</td><td>". $streamSource[0]. "</td><td style='width:  12%'>". $row["server_name"]. "</td><td><a target='_blank' href='$rebootApi'>reboot</a> </td><td><a target='_blank' href=' $EditStream'>Edit</a> </td></tr>";
              }
          } else {
              echo "0 results";
          }
    ?>
</tbody>
</ table>
</div>

<div>
    
    
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