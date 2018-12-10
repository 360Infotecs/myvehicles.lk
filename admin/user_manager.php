 <?php
session_start();
if (!isset($_SESSION['UserName'])) {
    header("location: login.php");
} else {
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
     <!-- DataTables -->
      <link rel="stylesheet" href="plugins/DataTable/css/bootstrap.min.css" />
      <link rel="stylesheet" href="plugins/DataTable/css/dataTables.bootstrap.min.css" />
      <style>
         hide
         {
         display: none;
         }    
      </style>
   </head>
   <body class="skin-blue sidebar-mini sidebar-collapse">
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
                  <li class="active">User Manager</li>
               </ol>
            </section>

            <section class="content">
               <div class="box">
                  <div class="box-header">
                     <!--    <h3 class="box-title">Users</h3>-->
                  </div>

                  <div class="box-body" style="max-width: 100%; overflow-x: scroll;">
                     <div align="right">
                        <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span> New User</button>
                     </div>
                     <br />
                     <?php
    display_msg($msg, $result);
?>
                    <!--<div id="alert" class="alert alert-info text-center" style="margin-top:20px; display:none;">
                        <button class="close"><span aria-hidden="true">&times;</span></button>
                        <span id="alert_message"></span>
                     </div>-->
                     <table id="user_data" class="table table-hover table-bordered table-striped">
                        <thead>
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
               </div>
            </section>
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
    $query         = 'SELECT * FROM userlevel ';
    
    //Bind Dropdown
    if ($currentuser === '1') //Super Admin
        {
        $query .= 'WHERE id!=1';
    } else if ($currentuser === '2') //System Admin
        {
        $query .= 'WHERE Id!=1 AND Id!=2';
    } else if ($currentuser === '3') //Level 1 User
        {
        $query .= 'WHERE Id!=1 AND Id!=2 AND Id!=3';
    } else if ($currentuser === '4') //Level 2 User
        {
        $query .= 'WHERE Id=5';
    }
    
    $stmt = $pdo->query($query);
    $stmt->execute();
    $data = $stmt->fetchAll();
    
?>
       <div id="userModal" class="modal modal-info fade">
            <div class="modal-dialog modal-sm">
                <form method="post" id="user_form" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"></h4></center>
                        </div>
                        <div class="modal-body">
                            <div id="alert" class="alert alert-danger text-center" style="margin-top:20px; display:none;">
                                <button class="close"><span aria-hidden="true">&times;</span></button>
                                <span id="alert_message"></span>
                            </div>
                            <div class="form-group">
                               <label>User Name</label>
                               <input type="text" class="form-control" id="username" name="username" placeholder="Enter UserName" onkeyup="checkuser();">
                               <span id="user_status"></span>
                            </div>
                            <div class="form-group">
                               <label>Phone No</label>
                               <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter phone No" onkeyup="checkphone();">
                               <span id="phone_status"></span>
                            </div>
                            <div class="form-group">
                               <label>User Level</label>
                               <select class="form-control" id="userlevel" name="userlevel">
                                  <option value="-1">Select User Level</option>
                                  <?php
    foreach ($data as $row):
?>
                                 <option value='<?= $row["Id"] ?>'><?= $row["Name"] ?></option>
                                  <?php
    endforeach;
?>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="user_id" id="user_id" />
                            <input type="hidden" name="operation" id="operation" />
                            <input type="submit" name="action" id="action" class="btn btn-outline" value="Add" />
                            <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      <!-- Scripts Area -->
      <?php
    include("common/scripts.php");
?>

      <!-- page script -->
<script type = "text/javascript" language = "javascript" >
	$(document).ready(function () {
		$('#add_button').click(function () {
			$('#user_form')[0].reset();
			$('.modal-title').text("Register New User");
			$('#action').val("Add");
			$('#operation').val("Add");
			$('#alert').hide();
		});

		var dataTable = $('#user_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "user_fetch.php",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 10, 11, 12],
				"orderable": false,
			}, ],
		});


		$(document).on('submit', '#user_form', function (event) {
			event.preventDefault();

			var UserLevel = $('#userlevel').val();
			var UserName = $('#username').val();
			var PhoneNo = $('#phoneno').val();

			$.ajax({
				url: "user_insert.php",
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				processData: false,
				success: function (data) {
					if (UserLevel != -1) {
						if (UserName != '' && PhoneNo != '') {
							$('#alert').show();
							$('#alert_message').html(data);
							setTimeout(function () {
								$('#alert').hide();
							}, 3000);
							setTimeout(function () {
								$('#userModal').modal('hide');
							}, 4000);
							dataTable.ajax.reload();
						} else {
							$('#alert').show();
							$('#alert_message').html(data);
						}
					} else {
						$('#alert').show();
						$('#alert_message').html('Please Select A Valid User Level.');
					}
				}
			});
		});

		$(document).on('click', '.update', function () {
			var user_id = $(this).attr("id");
			console.log(10);
			$.ajax({
				url: "user_fetch_single.php",
				method: "POST",
				data: {
					user_id: user_id
				},
				dataType: "json",
				success: function (data) {
					console.log('data', data);
					$('#userModal').modal('show');
					$('#username').val(data.UserName);
					$('#phoneno').val(data.PhoneNo);
					$('#userlevel').val(data.UserLevel);
					$('.modal-title').text("Edit User");
					$('#user_id').val(user_id);
					$('#action').val("Edit");
					$('#operation').val("Edit");
				},
				error: function (error) {
					console.log('error', error);
				}
			});
		});

		$(document).on('click', '.delete', function () {
			var user_id = $(this).attr("id");

			$.confirm({
				title: 'Oops!',
				content: 'Are you sure you want to delete this user?',
				autoClose: 'cancelAction|5000',
				type: 'red',
				typeAnimated: true,
				buttons: {
					tryAgain: {
						text: 'Delete User',
						btnClass: 'btn-red',
						action: function () {
							$.ajax({
								url: "user_delete.php",
								method: "POST",
								data: {
									user_id: user_id
								},
								success: function (data) {
									$.alert(data);
									//alert(data);
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
			var user_id = $(this).attr("id");
			var button_value = $(this).attr("value")
			var display = "";
			var display_title = "";
			var color = "";
			var btn_class = "";

			if (button_value == "Disable") {
				display = 'Deactivate';
				display_title = 'User Deactivatation!';
				color = 'orange';
				btn_class = 'btn-orange';
			} else if (button_value == "Activate") {
				display = 'Activate';
				display_title = 'User Activation!';
				color = 'green';
				btn_class = 'btn-green';
			}
			$.confirm({
				title: display_title,
				content: 'Are you sure you want to ' + display + ' this user?',
				autoClose: 'cancelAction|5000',
				type: color,
				typeAnimated: true,
				buttons: {
					tryAgain: {
						text: display,
						btnClass: btn_class,
						action: function () {
							$.ajax({
								url: "user_activation.php",
								method: "POST",
								data: {
									user_id: user_id
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