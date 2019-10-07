<?php
include("config.php");
include('session.php');

$streamId=$_GET['streamId'];
$StreamSourceN=array();
for ($i=0;$i<5;$i++) {
    if($_GET["StreamSourceNN$i"] !=null)
        $StreamSourceN[]=$_GET["StreamSourceNN$i"]; 
    }


$newStreamSourceArrJ=str_replace("/","\/",$StreamSourceN,$i);
$myJSON=json_encode($newStreamSourceArrJ);

$updateStream="UPDATE `streams` SET `stream_source`='$myJSON' WHERE `id`=$streamId";
$update = mysqli_query($db,$updateStream);

$restartStream = file_get_contents("http://$panel_url/api.php?action=stream&sub=start&stream_ids[]=$streamId");


?>
<html>
   
   <head>
      <title>Welcome </title>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   </head>
   
   <body>
   <div class="container">
    <ul class="nav navbar-expand-lg navbar-light bg-secondary">
    <li class="nav-item">
            <a class="nav-link  text-white" href="welcome.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  text-white" href="add.html">ADD LINE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="addmag.html">ADD MAG</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="modify.html">EDIT LINE</a>
        </li>

    </ul>
    <div class="row">
        <div class="col-6 ">
           <span class="pl-2 text-primary">Welcome <?php echo $login_session; ?>, you have <?php echo $login_sessionCredits; ?> credit</span> 
            
        </div>
        <div class="col-6 float-right" >
           
            <a href="logout.php" class="float-right pr-3">Sign Out</a>
        </div>
    </div>
    <div class="alert alert-success">
  <strong>Success!</strong> Stream Updated!
</div>
    
    <div>
 
          <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
   </body>
   
</html>