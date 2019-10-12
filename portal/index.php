<?php

   include("config.php");
   include('session.php');
   include('header.php');
  
?>


 
  

    <table class="table table-striped ">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Server Name</th>
        <th scope="col">Ram</th>
        <th scope="col">CPU</th>
        <th scope="col">Netword Output</th>
        <th scope="col">Netword Input</th>
        <th scope="col">Active Streams</th>
        <th scope="col">Uptime</th>
        <th scope="col">edit</th>

    </tr>
    </thead>
    <?php
          $sql = "SELECT * FROM streaming_servers ORDER BY `streaming_servers`.`id`";
          
          $result = mysqli_query($db,$sql);
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                 
               
                  $serverHardware=json_decode($row["server_hardware"], true);
                  $networkSpeed=$serverHardware["network_speed"];
                  $watchdog=json_decode($row["watchdog_data"], true);
                  $uptime=$watchdog["uptime"];
                  $memory=substr($watchdog["total_mem_used_percent"], 0, 4);
                  $cpu=$watchdog["cpu_avg"];
                  $streamNr=$watchdog["total_running_streams"];
                  $byteSent=$watchdog["bytes_sent"]  ;
                  $byteReceive=$watchdog["bytes_received"] ;

                  $edit="edit";
                  echo "<tr><td> " . $row["id"]. "</td><td >". $row["server_name"]. "</td><td><div class='progress bg-secondary'>
                  <div class='progress-bar progress-bar-striped progress-bar-animated bg-info' role='progressbar' style='width:" .$memory."%;' aria-valuenow='" .$memory."' aria-valuemin='0' aria-valuemax='100'>" .$memory."%</div>
                </div></td><td><div class='progress bg-secondary'>
                <div class='progress-bar progress-bar-striped progress-bar-animated ' role='progressbar' style='width:" .$cpu."%;' aria-valuenow='" .$cpu."' aria-valuemin='0' aria-valuemax='100'>" .$cpu."%</div>
              </div></td><td>". $byteReceive. "MB</td><td>". $byteSent. "MB</td><td>". $streamNr. "</td><td>". $uptime. "</td><td><a href='modify.php'>Modify</a> </td></tr>";
              }
          } else {
              echo "0 results";
          }
    ?>
</tbody>
</table>
</div>
    


    
    
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
