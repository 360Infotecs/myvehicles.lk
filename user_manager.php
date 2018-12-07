<?php
session_start();
if (!isset($_SESSION['UserName'])) {
    header("location: login.php");
} else {

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
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
 </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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

        <!-- Main content -->
        <section class="content">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="max-width: 100%; overflow-x: scroll;">
                <button id="addnew" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</button>
                <div id="alert" class="alert alert-info text-center" style="margin-top:20px; display:none;">
            	<button class="close"><span aria-hidden="true">&times;</span></button>
                <span id="alert_message"></span>
            </div>
                  <table id="usertable2" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
						<th>User Id</th>
						<th>User Name</th>
						<th>Phone No</th>
						<th>User Level Id</th>
						<th>User Level</th>
						<th>User Status Id</th>
						<th>User Status</th>
						<th>Updated By</th>
						<th>Updated Date</th>
						<th>Created By</th>
						<th>Created Date</th>
						<th>Edit</th>
						<th>Delete</th>
                      </tr>
                    </thead>
                    
                    <tbody id="tbody"></tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
						<th>User Id</th>
						<th>User Name</th>
						<th>Phone No</th>
						<th>User Level Id</th>
						<th>User Level</th>
						<th>User Status Id</th>
						<th>User Status</th>
						<th>Updated By</th>
						<th>Updated Date</th>
						<th>Created By</th>
						<th>Created Date</th>
						<th>Edit</th>
						<th>Delete</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          <!-- Default box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
    include("common/sitefooter.php");
?>

      <!-- Control Sidebar -->
      <?php
    include("common/customsidebar.php");
?>
     <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <?php include('user_modal.php'); ?>
<!-- Scripts Area -->
<?php
    include("common/scripts.php");
?>
<!-- page script -->
    <script>
      $(function () {
        $("#usertable").DataTable();
        $('#usertable2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script src="dist/js/user_manager.js"></script>
<!-- Scripts Area End -->
  </body>
</html>
<?php
}
?>