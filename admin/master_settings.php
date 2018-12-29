<?php
   session_start();
   if (!isset($_SESSION['UserName']))
       {
       header("location: login.php");
       }
   else
       {
       require 'common/DBConnect.php';
       require_once 'common/functions.php';
       $result = false;
       global $pdo, $msg;
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>MyVehicles.lk | User Manager</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <?php
         include("common/head.php");
         ?>
      <!--<link rel="stylesheet" href="dist/css/styleOverwrite.css" />-->
      <!-- DataTables -->
      <link rel="stylesheet" href="plugins/DataTable/css/bootstrap.min.css" />
      <link rel="stylesheet" href="plugins/DataTable/css/dataTables.bootstrap.min.css" />
      <!--      <style>
         hide
         {
         display: none;
         }    
         </style>-->
   </head>
   <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
      <div class="wrapper">
         <?php
            include("common/header.php");
            ?>
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <?php
            include("common/leftsidebar.php");
            ?>
         <!-- =============================================== -->
         <div class="content-wrapper">
            <section class="content-header">
               <h1>
                  User Manager
                  <small>Manage all users here</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Master Settings</li>
               </ol>
            </section>
            <section class="content">
               <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                     <!-- Brand -->
                     <div class="box box-primary">
                        <div class="box-header with-border">
                           <h3 class="box-title">Vehicle Brand Manager</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body"  style="max-width: 100%; overflow-x: scroll;">
	                        <div align="right">
		                        <button type="button" id="add_brand" data-toggle="modal" data-target="#brandModal" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span> New Brand</button>
		                     </div>
		                     <br />
		    				<table id="user_data" class="table table-hover table-bordered table-striped">
	                        <thead>
	                           <tr>
	                              <th>Id</th>
	                              <th>Brad Name</th>
	                              
	                              <th>Updated By</th>
	                              <th>Updated Date</th>
	                              <th>Created By</th>
	                              <th>Created Date</th>
	                              <th>Activate</th>
	                              <th>Edit</th>
	                              <th>Delete</th>
	                           </tr>
	                        </thead>
	                        <tfoot>
	                           <tr>
	                              <th>No</th>
	                              <th>User #</th>
	                              <th>User Name</th>
	                              <th>Phone No</th>
	                              <!--<th>User Level Id</th>-->
	                              <th>User Level</th>
	                              <!--<th>User Status Id</th>-->
	                              <th>User Status</th>
	                              <th>Updated By</th>
	                              <th>Updated Date</th>
	                              <th>Created By</th>
	                              <th>Created Date</th>
	                              <th>Activate</th>
	                              <th>Edit</th>
	                              <th>Delete</th>
	                           </tr>
	                        </tfoot>
	                     </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                     </div>
                     <!-- /.box -->
                     <!-- Class Of Vehicle -->
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 class="box-title">Vehicle Class Manager</h3>
                        </div>
                        <div class="box-body">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                     </div>
                     <!-- /.box -->
                     <!-- Colour -->
                     <div class="box box-danger">
                        <div class="box-header with-border">
                           <h3 class="box-title">Vehicle Colour Manager</h3>
                        </div>
                        <div class="box-body">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                     </div>
                     <!-- /.box -->
                     <!-- Fual Type -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Fual Type Manager</h3>
                        </div>
                        <div class="box-body">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
                  <!--/.col (left) -->
                  <!-- right column -->
                  <div class="col-md-6">
                     <!-- Transmission Type -->
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Transmission Type Manager</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                     <!-- Vehicle Condition -->
                     <div class="box box-warning">
                        <div class="box-header with-border">
                           <h3 class="box-title">Vehicle Condition Manager</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                        </div>
                     </div>
                     <!-- /.box -->
                  </div>
                  <!--/.col (right) -->
               </div>
               <!-- /.row -->
            </section>
            <!-- /.content -->
         </div>
         <?php
            include("common/sitefooter.php");
            ?>
         <!-- Control Sidebar -->
         <?php
            include("common/customsidebar.php");
            ?>
         <div class="control-sidebar-bg"></div>
      </div>
      <?php
         include_once('common/DBConnect.php');
         require_once 'common/functions.php';
         $result = false;
         global $msg, $result, $pdo;
         $currentuser   = $_SESSION['UserLevelId'];
         $currentuserid = $_SESSION['UserId'];

         global $msg, $result, $pdo;

         $stmt1 = $pdo->query("SELECT * FROM systemuser WHERE UserLevel != 1 AND UserLevel != 2");
         $stmt1->execute();
         $agent = $stmt1->fetchAll();
         ?>
      <div id="companyModal" class="modal modal-info fade">
      <div class="modal-dialog modal-lg">
         <form method="post" id="company_form" enctype="multipart/form-data">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title"></h4>
                  </center>
               </div>
               <div class="modal-body">
                  <div id="alert" class="alert alert-danger text-center" style="margin-top:20px; display:none;">
                     <button class="close"><span aria-hidden="true">&times;</span></button>
                     <span id="alert_message"></span>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Company Name</label>
                           <input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Enter Company Name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Address Line 1</label>
                           <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                           <label>Address Line 2</label>
                           <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                           <label>Address Line 3</label>
                           <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Enter Address">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Phone No</label>
                           <input type="text" class="form-control" id="PhoneNo" name="PhoneNo" placeholder="Enter Phone No">
                        </div>
                        <div class="form-group">
                           <label>Agent Id</label>
                           <select class="form-control" id="AgentId" name="AgentId">
                              <option>Select Agent</option>
                              <?php
                                 foreach ($agent as $row1):
                                 ?>
                              <option value='<?= $row1["Id"] ?>'><?= $row1["UserName"] ?> ( <?= $row1["UserId"] ?> )</option>
                              n
                              <?php
                                 endforeach;
                                 ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Company Logo</label>
                           <input type="file" class="coverimage form-control" id="image" name="image">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Logo Image</label>
                           <img id="imgs" style="max-width:180px;margin:10px;"class="img-responsive"/>
                        </div>
                     </div>
                  </div>
                  <hr/>
                  <div class="row">
                     <div class="form-group col-md-4">
                        <label>Latitude</label>
                        <input type="text" class="form-control" id="Latitude" name="Latitude" placeholder="Enter Latitude">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Longitude</label>
                        <input type="text" class="form-control" id="Longitude" name="Longitude" placeholder="Enter Longitude">
                     </div>
                  </div>
                  <hr/>
                  <div class="row">
                     <div class="form-group col-md-4">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" id="ContactPerson" name="ContactPerson" placeholder="Enter Contact Person">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Mobile No</label>
                        <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Enter Mobile No">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="text" class="form-control" id="Email" name="Email" placeholder="Enter Email">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <input type="hidden" name="company_id" id="company_id" />
                  <input type="hidden" name="companyNo" id="companyNo" />
                  <input type="hidden" name="operation" id="operation" />
                  <input type="submit" name="action" id="action" class="btn btn-outline" value="Add" />
                  <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
               </div>
         </form>
         </div>
         <script src="plugins/image-preview-jquery/jquery.min.js"></script>
         <script src="plugins/image-preview-jquery/img.js"></script>
      </div>
      <!-- Scripts Area -->
      <?php
         include("common/scripts.php");
         ?>
      <!-- page script -->
      <script type = "text/javascript" language = "javascript" >
         $(document).ready(function () {
             $('#add_button').click(function () {
                 $('#company_form')[0].reset();
                 $('.modal-title').text("Create New Company");
                 $('#action').val("Add");
                 $('#operation').val("Add");
                 $('#alert').hide();
                 $('#imgs').attr("src", "");
             });
         
             var dataTable = $('#company_data').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "order": [],
                 "ajax": {
                     url: "company_fetch.php",
                     type: "POST"
                 },
                 "columnDefs": [{
                     "targets": [0,1, 19, 20, 21],
                     "orderable": false,
                 }, ],
             });
                 
             $(document).on('submit', '#company_form', function (event) {
                 event.preventDefault();
         
                 var CompanyNo = $('#companyNo').val();
                 var CompanyName = $('#CompanyName').val();
                 var AddressLine1 = $('#AddressLine1').val();
                 var AddressLine2 = $('#AddressLine2').val();
                 var AddressLine3 = $('#AddressLine3').val();
                 var PhoneNo = $('#PhoneNo').val();
                 var AgentId = $('#AgentId').val();
                 var ContactPerson = $('#ContactPerson').val();
                 var Mobile = $('#Mobile').val();
                 var Email = $('#Email').val();
                 var Latitude = $('#Latitude').val();
                 var Longitude = $('#Longitude').val();
         
                 $.ajax({
                     url: "company_insert.php",
                     method: 'POST',
                     data: new FormData(this),
                     contentType: false,
                     processData: false,
                     success: function (data) {                    
                         if(data.value == false)
                         {
                             $('#alert').show();
                             $('#alert_message').html(data.msg);
                         }
                         else{
                             $('#alert').show();
                             $('#alert_message').html(data.msg);
                             $('#companyModal').modal('hide');
                             dataTable.ajax.reload();
                         }
                         
                     },
                     error: function (error) {
                         console.log('error', error);
                     }
                 });
             });
         
             $(document).on('click', '.update', function () {
                 var company_id = $(this).attr("id");
                 $.ajax({
                     url: "company_fetch_single.php",
                     method: "POST",
                     data: {
                         company_id: company_id
                     },
                     dataType: "json",
                     success: function (data) {
                         $('#companyModal').modal('show');
                         $('#companyNo').val(data.CompanyId);
                         $('#CompanyName').val(data.CompanyName);
                         $('#AddressLine1').val(data.AddressLine1);
                         $('#AddressLine2').val(data.AddressLine2);
                         $('#AddressLine3').val(data.AddressLine3);
                         $('#PhoneNo').val(data.PhoneNo);
                         $('#AgentId').val(data.AgentId);
                         $('#Latitude').val(data.Latitude);
                         $('#Longitude').val(data.Longitude);
                         $('#ContactPerson').val(data.ContactPerson);
                         $('#Mobile').val(data.Mobile);
                         $('#Email').val(data.Email);
                         $('#imgs').attr("src", data.imgs);
                         $('#image').val("");
                         
                         $('.modal-title').text("Edit Company");
                         $('#company_id').val(company_id);
                         $('#action').val("Edit");
                         $('#operation').val("Edit");
                         $('#alert').hide();
         
                     },
                     error: function (error) {
                         console.log('error', error);
                     }
                 });
             });
         
             $(document).on('click', '.delete', function () {
                 var company_id = $(this).attr("id");
         
                 $.confirm({
                     title: 'Oops!',
                     content: 'Are you sure you want to delete this Company?',
                     autoClose: 'cancelAction|5000',
                     type: 'red',
                     typeAnimated: true,
                     buttons: {
                         tryAgain: {
                             text: 'Delete Company',
                             btnClass: 'btn-red',
                             action: function () {
                                 $.ajax({
                                     url: "company_delete.php",
                                     method: "POST",
                                     data: {
                                         company_id: company_id
                                     },
                                     success: function (data) {
                                         //$.alert(data);
                                         dataTable.ajax.reload();
                                     }
                                 });
                             }
                         },
                         cancelAction: function () {}
                     }
                 });
             });
         
             $(document).on('click', '.activate', function () {
                 var company_id = $(this).attr("id");
                 var button_value = $(this).attr("value")
                 var display = "";
                 var display_title = "";
                 var color = "";
                 var btn_class = "";
         
                 if (button_value == "Disable") {
                     display = 'Deactivate';
                     display_title = 'Company Deactivatation!';
                     color = 'orange';
                     btn_class = 'btn-orange';
                 } else if (button_value == "Activate") {
                     display = 'Activate';
                     display_title = 'Company Activation!';
                     color = 'green';
                     btn_class = 'btn-green';
                 }
                 $.confirm({
                     title: display_title,
                     content: 'Are you sure you want to ' + display + ' this Company?',
                     autoClose: 'cancelAction|5000',
                     type: color,
                     typeAnimated: true,
                     buttons: {
                         tryAgain: {
                             text: display,
                             btnClass: btn_class,
                             action: function () {
                                 $.ajax({
                                     url: "company_activation.php",
                                     method: "POST",
                                     data: {
                                         company_id: company_id
                                     },
                                     success: function (data) {
                                         //$.alert(data);
                                         dataTable.ajax.reload();
                                     }
                                 });
                             }
                         },
                         cancelAction: function () {}
                     }
                 });
             });
         }); 
      </script>
      <!-- Scripts Area End -->
   </body>
</html>
<?php
   }
   ?>