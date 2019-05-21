<?php
$current_year = date('Y');
$year_array = array();
$max_year = $current_year - 10;
for($i = $max_year; $i <= $current_year; $i++){
    $year_array[$i] = $i;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mini Car Inventory System</title>
  <!--<link rel="shortcut icon" type="image/x-icon" href="resources/images/favicon.ico">-->
  <link rel="shortcut icon" type="image/x-icon" href="http://localhost/test_project/application/resources/images/favicon.ico">
  <link rel="stylesheet" href="http://localhost/test_project/application/resources/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="http://localhost/test_project/application/resources/css/font-awesome.css" type="text/css" />
  <link rel="stylesheet" href="http://localhost/test_project/application/resources/css/custom.css" type="text/css" />
  
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="page-header">
        <h4>Car Model Details</h4>
        <form id="myform" name="myform" action="<?php echo base_url();?>LoginController/saveModel" method="post" class="form" role="form" onsubmit="return getValidation();">
          <div class="form-container form1">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = 'model_name_class'>
              <input type="text" class="form-control" placeholder="model name" id = 'model_name_id' name="model_name_id">
              <div class="help-block" id = 'model_name_error'></div>
            </div>
          </div>
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = "select_manufact_class">
                  <select class="form-control" id = 'select_manufact' name = 'select_manufact'>
                    <option value="">Select Manufacturer</option>
                  </select>
                  <div class="help-block" id = 'select_manufact_error'></div>
                  </div>
          </div>
            </div>
          </div><br>
          <div class="form-container form1">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = 'model_color_class'>
              <input type="text" class="form-control" placeholder="model color" id = 'model_color_id' name="model_color_id">
              <div class="help-block" id = 'model_color_error'></div>
            </div>
          </div>
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = "select_manufact_year_class">
                  <select class="form-control" id = 'select_manufact_year' name = 'select_manufact_year'>
                    <option value="">Select Manufacturer Year</option>
                    <?php 
                    if(!empty($year_array))
                    {
                      foreach ($year_array as $key => $value) {
                     ?>
                        <option value="<?php echo $value;?>"><?php echo $value;?></option> 
                      <?php
                      }
                    }
                    ?>
                  </select>
                  <div class="help-block" id = 'select_manufact_year_error'></div>
                  </div>
          </div>
            </div>
          </div><br>
          <div class="form-container form1">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = 'model_reg_class'>
              <input type="text" class="form-control" placeholder="Registration Number" id = 'model_reg_id' name="model_reg_id">
              <div class="help-block" id = 'model_reg_error'></div>
            </div>
          </div>
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = 'model_note_class'>
              <input type="text" class="form-control" placeholder="Note" id = 'model_note_id' name="model_note_id">
              <div class="help-block" id = 'model_note_error'></div>
            </div>
          </div>
            </div>
         <div class="row">
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group">
               <input type="file" class="form-control" id="files" name="files" multiple/>
            </div>
          </div><br><br>
         
        </div>
        <div class="row">
           <div id="upload_images"></div>
        </div><br>
        <div class="row">
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group">
               <input type="submit" class="btn btn-primary sm-btn" id="form1btn" value="submit">
               <input type="button" class="btn btn-warning sm-btn" id="listbtn" value="List">
            </div>
          </div>
        </div>
          </div>

        </form>

      </div>
  </div>
</div>
</body>
<!-- jQuery -->
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/jquery.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/bootstrap.file-input.js"></script>
  <script type="text/javascript" src="http://localhost/test_project/application/resources/js/custom.js"></script>
  <script type="text/javascript">
    function getValidation()
    {
      var rt_type = true;
      /*model name*/
      document.getElementById('model_name_error').innerHTML = '';
      document.getElementById("model_name_class").classList.remove("has-error");

      if (document.getElementById('model_name_id').value.trim() == "") {
        document.getElementById('model_name_error').innerHTML = 'Please enter Model name.';
        document.getElementById("model_name_class").classList.add("has-error");
        rt_type = false;
      }
      else{
        var reg = /^[0-9a-zA-Z]+$/;
        if (!reg.test(document.getElementById('model_name_id').value.trim())) {
          document.getElementById('model_name_error').innerHTML = 'Please enter valid Model name.';
          document.getElementById("model_name_class").classList.add("has-error");
          rt_type = false;
        }
      }

      /*select year */
      $("#select_manufact_year_error").html('');
      $("#select_manufact_year_class").removeClass("has-error");
      
       if($.trim($("#select_manufact_year").val()) == "")
           {
             $("#select_manufact_year_error").html('Please select Year');
             $("#select_manufact_year_class").addClass("has-error");
             rt_type = false;
           }

      /*for manufacture model*/
      $("#select_manufact_error").html('');
      $("#select_manufact_class").removeClass("has-error");

       if($.trim($("#select_manufact").val()) == "")
           {
             $("#select_manufact_error").html('Please select Manufacturer');
             $("#select_manufact_class").addClass("has-error");
             rt_type = false;
           }
           
      /*for model note*/
      document.getElementById('model_note_error').innerHTML = '';
      document.getElementById("model_note_class").classList.remove("has-error");

      if (document.getElementById('model_note_id').value.trim() == "") {
        document.getElementById('model_note_error').innerHTML = 'Please enter Note.';
        document.getElementById("model_note_class").classList.add("has-error");
        rt_type = false;
      }
      else{
        var reg = /^[0-9a-zA-Z]+$/;
        if (!reg.test(document.getElementById('model_note_id').value.trim())) {
          document.getElementById('model_note_error').innerHTML = 'Please enter valid Note.';
          document.getElementById("model_note_class").classList.add("has-error");
          rt_type = false;
        }
      }

      /*for model color */
      document.getElementById('model_color_error').innerHTML = '';
      document.getElementById("model_color_class").classList.remove("has-error");

      if (document.getElementById('model_color_id').value.trim() == "") {
        document.getElementById('model_color_error').innerHTML = 'Please enter color.';
        document.getElementById("model_color_class").classList.add("has-error");
        rt_type = false;
      }
      else{
        var reg = /^[a-zA-Z]+$/;
        if (!reg.test(document.getElementById('model_color_id').value.trim())) {
          document.getElementById('model_color_error').innerHTML = 'Please enter valid color.';
          document.getElementById("model_color_class").classList.add("has-error");
          rt_type = false;
        }
      }
         
      /*for registration number */
      document.getElementById('model_reg_error').innerHTML = '';
      document.getElementById("model_reg_class").classList.remove("has-error");

      if (document.getElementById('model_reg_id').value.trim() == "") {
        document.getElementById('model_reg_error').innerHTML = 'Please enter Registartion Number.';
        document.getElementById("model_reg_class").classList.add("has-error");
        rt_type = false;
      }
      else{
        var reg = /^[0-9a-zA-Z]+$/;
        if (!reg.test(document.getElementById('model_reg_id').value.trim())) {
          document.getElementById('model_reg_error').innerHTML = 'Please enter valid Registartion Number.';
          document.getElementById("model_reg_class").classList.add("has-error");
          rt_type = false;
        }
      }
           
      return rt_type;
    }
    $(document).ready(function () {

       document.getElementById('listbtn').onclick = function() {
          var form = document.getElementById('myform');
          form.action = "<?php echo base_url();?>LoginController/showList";
          form.submit();
          }

        $.ajax({
          url: "<?php echo base_url();?>LoginController/getManufacturer",  
          type: "POST",
          dataType: "json",
          success: function(data) {
            var dhtml = "<option value=''>Select Manufacturer</option>";
             $.each(data, function (ind, vl) {
                
                dhtml += "<option value='" + vl.ID + "'>" + vl.NAME + "</option>"
                 
                
              });
             $("#select_manufact").html(dhtml);
            }
          })

        /*file upload function */
        $("#files").change(function(){

          var files = $('#files')[0].files;
          var error = '';
          var form_data = new FormData();
          for (var count = 0; count < files.length; count++) {
              var name = files[count].name;
              var extenstion = name.split('.').pop().toLowerCase();
              if(jQuery.inArray(extenstion,['gif','png','jpg','jepg']) == -1)
              {
                error += "Invalid"+count+"Image File"
              }
              else
              {
                form_data.append("files[]",files[count]);
              }
          }
          if(error == "")
          {
              $.ajax({
              url: "<?php echo base_url();?>LoginController/multipleUploadImage",  
              type: "POST",
              data: form_data,
              contentType:false,
              cache:false,
              processData:false,
              beforeSend:function()
              {
                $('#upload_images').html("<lable>Uploading.....</lable>");
              },
              success: function(data) {
                  $('#upload_images').html(data);
                   $('#files').value('');
                }
              })
          }
          else
          {
              alert(error);
          }

        });

    });
  </script>
