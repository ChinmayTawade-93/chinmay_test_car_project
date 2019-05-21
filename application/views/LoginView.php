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
        <h4>Add Manufacturer</h4>
        <marquee scrollamount="10" direction="left" behavior="scroll">
           Welcom To  Mini Car Inventory System
          <!--<img src="http://localhost/test_project/application/resources/images/images.png" />-->
        </marquee>
      </div>
      <form id="myform" name="myform" action="<?php echo base_url();?>LoginController/saveManufacture" method="post" class="form" role="form" onsubmit="return getValidation();">
        <div class="form-container form1">
          <h5>Manufacturer Details</h5>
          <div class="row">
            <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group req" id = 'manufacturer_name'>
              <input type="text" class="form-control" placeholder="Manufacturer Details" id = 'manufacturer_name_id' name="manufacturer_name_id">
              <div class="help-block" id = 'manufacturer_name_error'></div>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-sm-6 col-md-5 col-lg-4">
            <div class="form-group">
               <input type="submit" class="btn btn-primary sm-btn" id="form1btn" value="Add">
              <input type="button" class="btn btn-warning sm-btn" id="nextbtn" value="Next">
            </div>
          </div>
        </div>
        </div>
      </form>
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
    $(document).ready(function () {
      document.getElementById('nextbtn').onclick = function() {
          var form = document.getElementById('myform');
          form.action = "<?php echo base_url();?>LoginController/showNextModel";
          form.submit();
          }
    });
    function getValidation()
    {
      var rt_type = true;
      document.getElementById('manufacturer_name_error').innerHTML = '';
      document.getElementById("manufacturer_name").classList.remove("has-error");

      //for company name
      if (document.getElementById('manufacturer_name_id').value.trim() == "") {
        document.getElementById('manufacturer_name_error').innerHTML = 'Please enter Manufacturer name.';
        document.getElementById("manufacturer_name").classList.add("has-error");
        rt_type = false;
      }
      else{
        var reg = /^[0-9a-zA-Z]+$/;
        if (!reg.test(document.getElementById('manufacturer_name_id').value.trim())) {
          document.getElementById('manufacturer_name_error').innerHTML = 'Please enter valid Manufacturer name.';
          document.getElementById("manufacturer_name").classList.add("has-error");
          rt_type = false;
        }
      }
      var name = document.getElementById('manufacturer_name_id').value.trim();
      if(toCheckMaufactureName(name))
      {
        document.getElementById('manufacturer_name_error').innerHTML = 'Manufacturer name is Already Present';
        document.getElementById("manufacturer_name").classList.add("has-error");
        rt_type = false;
      }
      
      return rt_type;
    }
    function toCheckMaufactureName(name)
    {

         var flag = false;

         $.ajax({
            url: "<?php echo base_url();?>LoginController/checkDuplicateManufactureName",  
            data: {m_name:name},
            type: "POST",
            dataType: "json",
            async: false,
            success: function(data) {
              
            if(data == 1)
            {
          
             flag= true;
                    
            }
            
          }
      })
      return flag;

    }
  
  </script>