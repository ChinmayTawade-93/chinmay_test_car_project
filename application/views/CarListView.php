<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mini Car Inventory System</title>
  <link rel="shortcut icon" type="image/x-icon" href="http://localhost/test_project/application/resources/images/favicon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>


  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Car Model Details</h4>
        </div>
        <div class="modal-body">
          <label>Color</label>:<div id="color_id"></div><br>
          <label>Registration Number</label>:<div id="reg_id"></div><br>
          <label>Car Year</label>:<div id="year_id"></div><br>
          <label>Note</label>:<div id="note_id"></div><br>
          <input type="hidden" name="row_id" id="row_id" value="">
        </div>
        <div class="modal-footer" id="modal_footer_id">
        </div>
      </div>
      
    </div>
  </div>
<div class="wrapper">
    <div class="container">
      <div class="page-header">
        <h4>Car List</h4>
        <div id="car_details"></div>
      </div>
    </div>
  </div>
</body>
</html>
<!-- jQuery -->
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/jquery.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/bootstrap.file-input.js"></script>
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/custom.js"></script>
  <script type="text/javascript">
$(document).ready(function () {
            $.ajax({
                    url:"<?php echo base_url();?>LoginController/getCarListData",
                    method:"POST",
                    success:function(data)
                    {
                        $('#car_details').html(data);
                    }   
                });

            $(document).on("click",".remove-item",function() { 
               var row_id = $(this).attr('id');
               var color_value = $(this).data('color');
               var reg_value = $(this).data('reg');
               var year_value = $(this).data('year');
               var note_value = $(this).data('note');
               document.getElementById("color_id").innerHTML = color_value;
               document.getElementById("reg_id").innerHTML = reg_value;
               document.getElementById("year_id").innerHTML = year_value;
               document.getElementById("note_id").innerHTML = note_value;
               $("#row_id").val(row_id);

               var r= '<input type type="button" class="btn btn-primary delete-item" value="Remove" style="width: 100px;"/>';
               $("#modal_footer_id").html(r);
               $("#myModal").modal();
               
            });

             $(document).on("click",".delete-item",function() {
                 var delete_id = $('#row_id').val();
                  $.ajax({
                    url:"<?php echo base_url();?>LoginController//removeItem",
                    data:{row_id:delete_id},
                    method:"POST",
                    success:function(data)
                    {
                       
                        if(data == 1)
                        {
                           $('#myModal').modal('hide');
                           $('#car_details').load("<?php echo base_url();?>LoginController/load");
                        }
                    }   
                });
                
             });
});
</script>