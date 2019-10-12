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
        <th scope="col">Password</th>
        <th scope="col">IP</th>
        <th scope="col">Connection</th>
        <th scope="col">Note</th>
        <th scope="col">Get file</th>
        <th scope="col">Expire date</th>
        <th scope="col">edit</th>

    </tr>
    </thead>
    <?php
     if( $isAdmin){
        $sql = "SELECT a.id, a.member_id, a.username, a.password, a.exp_date, a.admin_enabled, a.enabled, a.admin_notes, a.reseller_notes,  a.max_connections, a.is_restreamer, a.is_trial, b.username  as reseller FROM users a left join reg_users b on a.member_id=b.id";
  
     }else{
        $sql = "SELECT a.id, a.member_id, a.username, a.password, a.exp_date, a.admin_enabled, a.enabled, a.admin_notes, a.reseller_notes,  a.max_connections, a.is_restreamer, a.is_trial, b.username FROM users a left join reg_users b on a.member_id=b.id  WHERE member_id=$login_sessionId;";
        
     }
     $result = mysqli_query($db,$sql);
     if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $currentTimeinSeconds =$row["exp_date"];
                  $username = substr($row["username"], 0, 25);
                  $password=$row["password"];
                  $userId=$row["id"];
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
             

                  $edit="line.php?userid=$userId";
                  
                  echo "<tr><td> " . $row["id"]. "</td><td >". $row["reseller"]. "</td><td>" . $username. "</td><td>". $row["password"]. "</td><td>".$userIp."</td><td>". $activeConnection. "/". $row["max_connections"]."&nbsp;".$watchingStream. "</td><td>". $row["reseller_notes"]. "</td><td>". M3u($row['username'],$row['password'],$panel_url) ."</td><td>". $expiredate. "</td><td><a href='".$edit."'>Modify</a> </td></tr>";
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
