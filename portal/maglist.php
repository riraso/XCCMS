<?php

   include("config.php");
   include('session.php');
   include('header.php');
   include('function.php');
?>


 
  

    <table id="myTable" class="table table-striped ">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Owner</th>
        <th scope="col">UserName</th>
       
        <th scope="col">IP</th>
        <th scope="col">Connection</th>
        <th scope="col">Note</th>
        <th scope="col">Expire date</th>
        <th scope="col">edit</th>

    </tr>
    </thead>
    <?php
     if( $isAdmin){
        $sql = "SELECT b.id, a.mag_id, a.user_id, b.member_id, b.exp_date, b.admin_enabled, b.enabled, b.admin_notes, b.reseller_notes,  b.max_connections, b.is_trial, a.mac, c.id, c.username  as reseller  FROM mag_devices a left join users b on b.id=a.user_id left join reg_users c on b.member_id=c.id";
  
     }else{
        $sql = "SELECT b.id, a.mag_id, a.user_id, b.member_id, b.exp_date, b.admin_enabled, b.enabled, b.admin_notes, b.reseller_notes,  b.max_connections, b.is_trial, a.mac, c.id, c.username  as reseller  FROM mag_devices a left join users b on b.id=a.user_id left join reg_users c on b.member_id=c.id WHERE member_id=$login_sessionId";
     }
  
     $result = mysqli_query($db,$sql);
     if ($result->num_rows > 0) {
         
              // output data of each row
              while($row = $result->fetch_assoc()) {
                
                  $currentTimeinSeconds =$row["exp_date"];
                  $expiredate= date('Y-m-d', $currentTimeinSeconds);
                  $mac=base64_decode($row["mac"]);
               
                  $userId=$row["user_id"];
                  $sqlOnline = "SELECT  a.user_ip ,a.stream_id , b.stream_display_name FROM user_activity_now a  left join streams b on a.stream_id= b.id WHERE user_id = $userId; ";
                  $resultOnline = mysqli_query($db,$sqlOnline);
                  $activeConnection=$resultOnline->num_rows;
                  $expiredate= date('Y-m-d', $currentTimeinSeconds);
                  if($activeConnection != 0){
                    $username='<span class="text-success">'.$username.'</span>';
                }
                
                if($row[is_trial] == 1){
                    $username='<span class="text-warnning">'.$username.'</span>';
                }
                if($currentTimeinSeconds< time()){
                    $username='<span class="text-danger">'.$username.'</span>';
                }
                $watchingStream="";
                $userIp="";
                while($rowOnline = $resultOnline->fetch_assoc()) {
                    if($activeConnection == 1 ){
                        $watchingStream=$rowOnline[stream_display_name];
                        $userIp=GeoIp($rowOnline[user_ip]);
                    }
                   
                }

                  $edit="mag.php?userid=$userId";
                  
                  echo "<tr><td> " . $row["mag_id"]. "</td><td >". $row["reseller"]. "</td><td>" . $mac. "</td><td>".$userIp."</td><td>". $activeConnection. "/". $row["max_connections"]."&nbsp;".$watchingStream. "</td><td>". $row["reseller_notes"] ."</td><td>". $expiredate. "</td><td><a href='".$edit."'>Modify</a> </td></tr>";
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
