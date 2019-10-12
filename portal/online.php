<?php

   include("config.php");
   include('session.php');
   include('header.php');
   include('function.php');
?>


 
  

    <table id="myTable" class="table table-striped ">
    <thead>
    <tr>
     <th scope="col">No</th>
     <th scope="col">Username</th>
     <th scope="col">Server</th>
     <th scope="col">Stream Name</th>
     <th scope="col">User Agent</th>
     <th scope="col">IP</th>
     <th scope="col">Country</th>
     <th scope="col">Restreamer</th>
     <th scope="col">Uptime</th>
        

    </tr>
    </thead>
    <?php
          $sql = "SELECT a.user_agent, a.user_ip, a.date_start, a.geoip_country_code, b.username, b.is_restreamer, c.server_name, d.stream_display_name FROM user_activity_now a left join users b on a.user_id=b.id left join streaming_servers c on a.server_id=c.id left join streams d on a.stream_id=d.id   ORDER BY a.date_start ASC ";
          
          $result = mysqli_query($db,$sql);
          if ($result->num_rows > 0) {
                $i=0;
              // output data of each row
              while($row = $result->fetch_assoc()) {
                 
                   $i++;
                  $userAgent= substr($row["user_agent"], 0, 30);
                  $userIp=$row["user_ip"];
                  $startSince=$row["date_start"];
                  $geoip=$row["geoip_country_code"];
                  $username=$row["username"];
                 if ($row["is_restreamer"] ==1){
                    $isRestreamer=  '<td data-sort="2" data-order="2"><i  class="fa fa-check-circle"></i></td>' ;
                  }else{
                    $isRestreamer=  '<td  data-sort="1" data-order="1"><i  class="fa fa-times-circle"></i></td>';
                  }
                  $serverName=$row["server_name"];
                  $streamName=$row["stream_display_name"];
                

 
  
  
                  $edit="edit";
                  echo "<tr><td> " . $i. "</td><td >". $username. "</td><td >". $serverName. "</td><td>".$streamName. "</td><td>" .$userAgent. "</td><td>". GeoIp($userIp). "</td><td>". $geoip. "</td>". $isRestreamer. "<td>". uptime($startSince). "</td></tr>";
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
