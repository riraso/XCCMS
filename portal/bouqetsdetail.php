<?php

   include("config.php");
   include('session.php');
   include('header.php');
   include('template.php');
   $bq_Id =$_GET['bq_Id'];

  
   ?>

    <?php
               $sql1 =  "SELECT * FROM `bouquets` where id=$bq_Id ";
               $result = mysqli_query($db, $sql1);
               if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                         $bq_ch_Id=json_decode($row['bouquet_channels']);
                         $bq_ch_Id =  implode("','",$bq_ch_Id);
                        
                     }
               }
               $sql2 =  "SELECT * FROM `streams` where id in ('".$bq_ch_Id."') ";
               $result2 = mysqli_query($db, $sql2);
               if ($result2->num_rows > 0) {
                   while ($row = $result2->fetch_assoc()) {
                   
                    $bq_ch_ids[]=$row['id'];
                    $bq_chs[]=$row['stream_display_name'];
                }     
               }
               $sql3 ="SELECT id, stream_display_name FROM `streams` where  type =1 ORDER BY `streams`.`id` DESC";
               $result3 = mysqli_query($db, $sql3);
               if ($result3->num_rows > 0) {
                   while ($row = $result3->fetch_assoc()) {
                   
                    $ch_ids[]=$row['id'];
                    $chs[]=$row['stream_display_name'];
                }     
               }
      
            ?>

    <form action="bouqetsedit.php" method="post">
        <div class="invisible form-group row">
        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $bq_Id;?>" name="bqId">
       
        </div>
        <div style="height:450px;">
            <div class=" form-group row" style="height:400px;">
                <div class="col-sm-5">
        
                    <label for="channelslist">All Channels</label>
        
                    <input class="form-control mr-sm-2" type="search" id="myInput" placeholder="Search" aria-label="Search">
                    <select multiple class="form-control h-75" id="channelslist">
                        <?php
                for ($i=0;$i<sizeof($chs);$i++){?>
                        <option value="<?php echo $ch_ids[$i];?>"><?php echo $chs[$i]; ?></option>
                        <?php }; ?>
        
                    </select>
        
                </div>
                <div class="col-sm-2">
                    <button type="button" id="add" class="btn btn-success btn-block mx-auto">ADD</button>
                    <button type="button" id="remove" class="btn btn-warning btn-block">Remove</button>
                </div>
                <div class="col-sm-5">
                    <label for="bqchannels">Bouqet Channels</label>
                    <input class="form-control mr-sm-2" type="search" id="myInput1" placeholder="Search" aria-label="Search">
                    <select multiple class="form-control h-75" id="bqchannels" name="bqchannels[]">
                        <?php
                for ($i=0;$i<sizeof($bq_chs);$i++){?>
                        <option value="<?php echo $bq_ch_ids[$i];?>"><?php echo $bq_chs[$i]; ?></option>
                        <?php }; ?>
        
                    </select>
                    <input type="button" id="Move Up" class="btn btn-outline-secondary mb-2" name="Move Up" value="Move Up">
                    <input type="button" id="Move Down" class="btn btn-outline-secondary mb-2" name="Move Down"
                        value="Move Down">
                    <input type="button" id="select_all" class="btn btn-outline-secondary mb-2" name="select_all"
                        value="Select All">
                    <input type="button" id="unselect_all" class="btn btn-outline-secondary mb-2 " name="unselect_all"
                        value="UNSelect All">
                </div>
            </div>
    
        </div>
        
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




         
  <script>
$(document).ready(function(){
  $("#channelslist").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#channelslist option").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

<script type='text/javascript'>
function doSomething() {
    
    alert( <?php $rebootApi ?> );
    return false;
}


$('#selectallBqCh').click(function() {
    $('#bqchannels').prop('selected', true);
});
</script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#channelslist *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInput1").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#bqchannels *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    $('#add').click(function() {
        var $options = $("#channelslist > option:selected").clone();
        $('#bqchannels').append($options);
    });
    $('#remove').click(function() {
        var $options = $("#bqchannels > option:selected").remove();
    });
    $(document).ready(function(){
    $('input[type="button"]').click(function(){
        var $op = $('#bqchannels option:selected'),
            $this = $(this);
        if($op.length){
            ($this.val() == 'Move Up') ? 
                $op.first().prev().before($op) : 
                $op.last().next().after($op);
        }
    });
});
$('#submit').click(function() {
            $('#bqchannels option').prop('selected', true);
        });
        $('#select_all').click(function() {
            $('#bqchannels option').prop('selected', true);
        });
        $('#unselect_all').click(function() {
            $('#bqchannels option').prop('selected', false);
        });
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
