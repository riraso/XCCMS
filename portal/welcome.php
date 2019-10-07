<?php

   include("config.php");
   include('session.php');
   include('header.php');
  
?>


 
  

    <table class="table table-striped ">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">UserName</th>
        <th scope="col">Password</th>
        <th scope="col">Note</th>
        <th scope="col">Expire date</th>
        <th scope="col">edit</th>

    </tr>
    </thead>
    <?php
          $sql = "SELECT `id`, `member_id`, `username`, `password`, `exp_date`, `admin_enabled`, `enabled`, `admin_notes`, `reseller_notes`, `bouquet`, `max_connections`, `is_restreamer`, `allowed_ips`, `allowed_ua`, `is_trial`, `created_at`, `created_by`, `pair_id`, `is_mag`, `is_e2`, `force_server_id`, `is_isplock`, `isp_desc`, `forced_country`, `is_stalker`, `bypass_ua`, `as_number`, `play_token` FROM `users` WHERE `member_id`=$login_sessionId;";
          
          $result = mysqli_query($db,$sql);
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $currentTimeinSeconds =$row["exp_date"];
                  $username = substr($row["username"], 0, 25);

                  $edit="edit";
                  echo "<tr><td> " . $row["id"]. "</td><td >". $username. "</td><td>" . $row["password"]. "</td><td>". $row["reseller_notes"]. "</td><td style='width:  12%'>". date('Y-m-d', $currentTimeinSeconds). "</td><td><a href='modify.php'>Modify</a> </td></tr>";
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
