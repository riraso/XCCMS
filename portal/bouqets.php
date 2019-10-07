<?php

   include("config.php");
   include('session.php');
   include('header.php');
   $username =$_POST['servers'];
   $ServerIDs = implode(", ", $username);
   $status =$_POST['status'];

   ?>

    <table id="myTable" class="table table-striped table-bordered ">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Ecit</th>
            </tr>
        </thead>
        <tbody>
            <?php
               $sql1 = $sql = "SELECT * FROM `bouquets` ";
               $result = mysqli_query($db, $sql1);
               if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                         $bq_Id=$row['id'];
                         $EditBq = "bouqetsdetail.php?bq_Id=$bq_Id";
                         echo "<tr><td> " . $row["id"]. "</td><td >" . $row["bouquet_name"]. "</td><td><a target='_blank' href=' $EditBq'><i class='fa fa-edit'></i></a> </td></tr>";
  
                }
            }?>
        </tbody>
    </table> 
       
    


 


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
    $('#myTable').DataTable( {
        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]]
    } );
});
</script>
   <?php

include('footer.php');

?>
