 <?php
session_start();
require 'common/admin.php';
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
      <title><?php echo $Title1.$Title2.$Title3 ?> | Vehicle Manager</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <?php
    include("common/head.php");
?>
     <!-- DataTables -->
      <link rel="stylesheet" href="plugins/DataTable/css/bootstrap.min.css" />
      <link rel="stylesheet" href="plugins/DataTable/css/dataTables.bootstrap.min.css" />
     <!-- <style>
         hide
         {
         display: none;
         }    
      </style>-->
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
                  <li class="active">Company Manager</li>
               </ol>
            </section>

            <section class="content">
               <div class="box">
                  <div class="box-header">
                     <!--    <h3 class="box-title">Users</h3>-->
                  </div>

                  <div class="box-body" style="max-width: 100%; overflow-x: scroll;">
                     <div align="right">
                        <button type="button" id="add_button" data-toggle="modal" data-target="#companyModal" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-plus"></span> New Company</button>
                     </div>
                     <br />
                     <?php display_msg($msg, $result); ?>
                    <!--<div id="alert" class="alert alert-info text-center" style="margin-top:20px; display:none;">
                        <button class="close"><span aria-hidden="true">&times;</span></button>
                        <span id="alert_message"></span>
                     </div>-->
                     <table id="post_data" class="table table-hover table-bordered table-striped">
                        <thead>
                           <tr>
                                <th>Id</th>
								<th>Post No</th>
								<th>Post Title</th>
								<th>Brand</th>
								<th>Vehicle Class</th>
								<th>Vehicle Condition</th>
								<th>Colour</th>
								<th>Fuel Type</th>
								<th>Transmission Type</th>
								<th>Model Year</th>
								<th>Company ID</th>
								<th>Company</th>
								<th>Agent ID </th>
								<th>Sub Agent</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                                <th>Id</th>
								<th>Post No</th>
								<th>Post Title</th>
								<th>Brand</th>
								<th>Vehicle Class</th>
								<th>Vehicle Condition</th>
								<th>Colour</th>
								<th>Fuel Type</th>
								<th>Transmission Type</th>
								<th>Model Year</th>
								<th>Company ID</th>
								<th>Company</th>
								<th>Agent ID </th>
								<th>Sub Agent</th>
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
   /* $query         = 'SELECT * FROM userlevel ';
    
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
    $data = $stmt->fetchAll();*/
    
	global $msg, $result, $pdo;
    $stmt = $pdo->query("SELECT * FROM classofvehicle");
    $stmt->execute();
    $class = $stmt->fetchAll();
    
    $stmt1 = $pdo->query("SELECT * FROM vehiclecondition");
    $stmt1->execute();
    $condition = $stmt1->fetchAll();
    
    $stmt2 = $pdo->query("SELECT * FROM brand");
    $stmt2->execute();
    $brand = $stmt2->fetchAll();
    
    $stmt3 = $pdo->query("SELECT * FROM fualtype");
    $stmt3->execute();
    $fualtype = $stmt3->fetchAll();
    
 /*   $stmt3 = $pdo->query("SELECT * FROM systemuser WHERE UserLevel != 1 AND UserLevel != 2");
    $stmt3->execute();
    $agent = $stmt1->fetchAll();*/
    

    
?>
      <div id="companyModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<form method="post" id="post_form" enctype="multipart/form-data">
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
						<div class="box-group" id="accordion">
							<div class="panel box box-primary">
								<div class="box-header with-border">
									<h4 class="box-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
										BASIC VEHICLE INFO
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="box-body">
										<div class="col-md-8">
											<div class="form-group">
												<label>Vehicles Title</label>
												<input class="form-control" id="VehiclesTitle" name="VehiclesTitle" type="text" placeholder="Enter Vehicles Title">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Vehicle Class</label>
												<select class="form-control" id="VehicleClass" name="VehicleClass">
													<option value="-1">Select</option>
													<?php foreach ($class as $row1):?>
													<option value='<?= $row1["Id"] ?>'><?= $row1["Name"] ?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>										
										<div class="col-md-3">
											<div class="form-group">
												<label>Vehicle Condition</label>
												<select class="form-control" id="VehicleCondition" name="VehicleCondition">
													<option value="-1">Select</option>
													<?php foreach ($condition as $row1):?>
													<option value='<?= $row1["Id"] ?>'><?= $row1["Name"] ?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Brand</label>
												<select class="form-control" id="Brand" name="Brand">
													<option value="-1">Select Brand</option>
													<?php foreach ($brand as $row1):?>
													<option value='<?= $row1["Id"] ?>'><?= $row1["Name"] ?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Price</label>
												<input class="form-control" id="Price" name="Price" type="text" placeholder="Enter Price">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Negotiable</label>
												<select class="form-control" id="Negotiable" name="Negotiable">
													<option value="0">Yes</option>
													<option value="1">No</option>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Decription</label>
												<textarea class="form-control" rows="4" id="Decription" name="Decription" placeholder="Type Vehicle Description (Maximun 500 Characters)"></textarea>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Model Year</label>
												<select class="form-control" id="Model" name="Model">
													<option value="-1">Select Model</option>
													<?php $currently_selected = date('Y'); 
													  $earliest_year = $currently_selected-30; 
													  $latest_year = date('Y'); 
													  foreach ( range( $latest_year, $earliest_year ) as $i ) {
													    echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
													  }
													?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>No. of Owners</label>
												<select class="form-control" id="Model" name="Model">
													<option value="1">-------</option>
													<?php $currently_selected = date('Y'); 
													  $earliest_year = $currently_selected-30; 
													  $latest_year = date('Y'); 
													  foreach ( range( 1, 10 ) as $i ) {
													    echo '<option value="'.$i.'">'.$i.'</option>';
													  }
													?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Fuel Type</label>
												<select class="form-control" id="Brand" name="Brand">
													<option value="-1">Select Fuel Type</option>
													<?php foreach ($fualtype as $row2):?>
													<option value='<?= $row2["Id"] ?>'><?= $row2["Name"] ?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>KMs Driven</label>
												<input type="text" class="form-control" id="kmsDriven" name="kmsDriven" placeholder="Enter Kilometers Driven"/> 
											</div>
										</div> 
									</div>
								</div>
							</div>
							<div class="panel box box-danger">
								<div class="box-header with-border">
									<h4 class="box-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
										TECHNICAL SPECIFICATION
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="box-body">
										<div class="form-group col-md-4">
										  <label class="control-label">Engine Type</label>
										  <input class="form-control white_bg" id="engien" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Engine Description</label>
										  <input class="form-control white_bg" id="engien-description" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">No. of Cylinders</label>
										  <input class="form-control white_bg" id="cylinders" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Mileage-City</label>
										  <input class="form-control white_bg" id="mileage" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Mileage-Highway</label>
										  <input class="form-control white_bg" id="mileage-h" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Fuel Tank Capacity</label>
										  <input class="form-control white_bg" id="capacity" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Seating Capacity</label>
										  <input class="form-control white_bg" id="s-capacity" type="text">
										</div>
										<div class="form-group col-md-4">
										  <label class="control-label">Transmission Type</label>
										  <input class="form-control white_bg" id="Transmission" type="text">
										</div> 
									</div>
								</div>
							</div>
							<div class="panel box box-success">
								<div class="box-header with-border">
									<h4 class="box-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
										ACCESSORIES
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="box-body">
									  <div class="form-group col-md-4">
						                <input id="air_conditioner" type="checkbox">
						                <label for="air_conditioner">Air Conditioner</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="door" type="checkbox">
						                <label for="door">Power Door Locks</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="antiLock" type="checkbox">
						                <label for="antiLock">AntiLock Braking System</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="brake" type="checkbox">
						                <label for="brake">Brake Assist</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="steering" type="checkbox">
						                <label for="steering">Power Steering</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="airbag" type="checkbox">
						                <label for="airbag">Driver Airbag</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="windows" type="checkbox">
						                <label for="windows">Power Windows</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="passenger_airbag" type="checkbox">
						                <label for="passenger_airbag">Passenger Airbag</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="player" type="checkbox">
						                <label for="player">CD Player</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="sensor" type="checkbox">
						                <label for="sensor">Crash Sensor</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="seats" type="checkbox">
						                <label for="seats">Leather Seats</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="engine_warning" type="checkbox">
						                <label for="engine_warning">Engine Check Warning</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="locking" type="checkbox">
						                <label for="locking">Central Locking</label>
						              </div>
						              <div class="form-group col-md-4">
						                <input id="headlamps" type="checkbox">
						                <label for="headlamps">Automatic Headlamps</label>
						              </div> 
									</div>
								</div>
							</div>
							<div class="panel box box-info">
								<div class="box-header with-border">
									<h4 class="box-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="true">
										CONTECT INFO
										</a>
									</h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
									<div class="box-body">
										<div class="form-group col-md-4">
											<label>Mobile No</label>
											<input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Enter Mobile No">
										</div>
						
										<div class="form-group col-md-4">
											<label>Agent Id</label>
											<select class="form-control" id="AgentId" name="AgentId">
												<option>Select Agent</option>
												<?php foreach ($agent as $row1):?>
												<option value='<?= $row1["Id"] ?>'><?= $row1["UserName"] ?> ( <?= $row1["UserId"] ?> )</option>
												<?php endforeach;?>
											</select>
										</div> 
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="company_id" id="company_id" />
						<input type="hidden" name="companyNo" id="companyNo" />
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

		var dataTable = $('#post_data').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "post_fetch.php",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0],
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