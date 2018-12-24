<?php
session_start();
require 'common/DBConnect.php';
$msg    = '';
$result = false;
if (isset($_POST['btnsubmit'])) {
    try {
        $result = insert_user();
        display_form();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    display_form();
}


function GenerateRandomId()
{
    global $res;
    $random_id_length = 7;
    $stamp            = date("ymd");
    $rnd_id           = uniqid(rand(), 1);
    $rnd_id           = strip_tags(stripslashes($rnd_id));
    $rnd_id           = str_replace(".", "", $rnd_id);
    $rnd_id           = strrev(str_replace("/", "", $rnd_id));
    $rnd_id           = substr($rnd_id, 0, $random_id_length);
    return "MVC$stamp$rnd_id";
}


function insert_user()
{
    global $pdo, $msg;
    $AgentId           = $_POST['AgentId'];
    $CompanyName       = $_POST['CompanyName'];
    $AddressLine1      = $_POST['AddressLine1'];
    $AddressLine2      = $_POST['AddressLine2'];
    $AddressLine3      = $_POST['AddressLine3'];
    $ContactPerson     = $_POST['ContactPerson'];
    $PhoneNo           = $_POST['PhoneNo'];
    $Mobile            = $_POST['Mobile'];
    $Email             = $_POST['Email'];
    $Latitude          = $_POST['Latitude'];
    $Longitude         = $_POST['Longitude'];
    $Status            = $_POST['Status'];
    $imagename         = $_FILES['image']['name'];
    $imagedata         = file_get_contents($_FILES['image']['tmp_name']);
    $imagetype         = $_FILES['image']['type'];
    $CompanyId         = GenerateRandomId();
    $statusUpdatedBy   = "Admin"; //from session;
    $statusUpdatedDate = date('Y-m-d H:i:s');
    $createdBy         = "Admin"; //from session
    $createdDate       = date('Y-m-d H:i:s');
    if (substr($imagetype, 0, 5) == "image") {
        // construct SQL insert statement
        $sql_insert = "INSERT INTO `company`(`CompanyId`, `AgentId`, `CompanyName`, 
            `Logo`, `LogoName`, `AddressLine1`, `AddressLine2`, `AddressLine3`, `ContactPerson`, 
            `PhoneNo`, `Mobile`, `Email`, `Latitude`, `Longitude`, `Status`, `StatusUpdatedBy`, 
            `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`) 
             VALUES(" . $pdo->quote($CompanyId) . "," . $pdo->quote($AgentId) . "," . $pdo->quote($CompanyName) . "," . $pdo->quote($imagedata) . "," . $pdo->quote($imagename) . "," . $pdo->quote($AddressLine1) . "," . $pdo->quote($AddressLine2) . "," . $pdo->quote($AddressLine3) . "," . $pdo->quote($ContactPerson) . "," . $pdo->quote($PhoneNo) . "," . $pdo->quote($Mobile) . "," . $pdo->quote($Email) . "," . $pdo->quote($Latitude) . "," . $pdo->quote($Longitude) . "," . $pdo->quote($Status) . "," . $pdo->quote($statusUpdatedBy) . "," . $pdo->quote($statusUpdatedDate) . "," . $pdo->quote($createdBy) . "," . $pdo->quote($createdDate) . ")";
        if ($pdo->exec($sql_insert) === false) {
            $msg = 'Error creating the company.';
            return false;
        } else {
            $msg = "The new company $CompanyName is created";
            return true;
            //display_form();
        }
    } else {
        $msg = "only images are allowed!";
        return false;
    }
}


function display_msg($msg, $type)
{
    $type === true ? $cssClass = "alert-success" : $cssClass = "alert-error";
    if ($msg != '') {
?>
 <div class="alert <?php echo $cssClass;?>">
 <?php echo $msg;?>
 </div>
 <?php
    }
}


function display_form()
{
    global $msg, $result, $pdo;
    $stmt = $pdo->query("SELECT * FROM companystatus");
    $stmt->execute();
    $data  = $stmt->fetchAll();
	
    $stmt1 = $pdo->query("SELECT * FROM systemuser");
    $stmt1->execute();
    $agent = $stmt1->fetchAll();
	
	$stmt2 = $pdo->query("SELECT * FROM company");
    $stmt2->execute();
    $agent = $stmt2->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyVehicles.lk | Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php include("common/head.php");?>
 </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("common/header.php");?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include("common/leftsidebar.php");?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Company Registration
            <small>Create new company here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Company Registration</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
      
          <div class="row">
            <div class="col-md-3">
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
					<table class="table table-striped">
						<tbody>
						<?php foreach ($data as $row):?>
					  <tr><td><?= $row["Name"] ?></td></tr>
					<?php endforeach;?>
							
						</tbody>
					</table>
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box">
                  
                    <div class="box-header with-border">
                      <?php display_msg($msg, $result);?>
                   </div>
                    <div class="box-body">
					<div class="col-md-12">
					<div class="form-group">
							  <label>Company Name</label>
							  <input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Enter Company Name">
							</div>
					</div>
						  <div class="col-md-6">
							<div class="form-group">
							  <label>Company Name</label>
							  <input type="text" class="form-control" id="CompanyName" name="CompanyName" placeholder="Enter Company Name">
							</div>
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
							<div class="form-group">
							  <label>Phone No</label>
							  <input type="text" class="form-control" id="PhoneNo" name="PhoneNo" placeholder="Enter Phone No">
							</div>
							<div class="form-group">
							  <label>Agent Id</label>
								<select class="form-control" id="AgentId" name="AgentId">
									<option>Select Agent</option>
									<?php foreach ($agent as $row1):?>
									  <option value='<?= $row1["Id"] ?>'><?= $row1["UserName"] ?> ( <?= $row1["UserId"] ?> )</option>n
									<?php endforeach;?>
								</select>
							</div>
						  </div>
						  
						  
						  <div class="col-md-6">
                        <div class="form-group">
                          <label>Latitude</label>
                          <input type="text" class="form-control" id="Latitude" name="Latitude" placeholder="Enter Latitude">
                        </div>
                        <div class="form-group">
                          <label>Longitude</label>
                          <input type="text" class="form-control" id="Longitude" name="Longitude" placeholder="Enter Longitude">
                        </div>
                        <div class="form-group">
                            <label>Company Status</label>
                            <select class="form-control" id="Status" name="Status">
                                <option>Select Company Status</option>
                                <?php foreach ($data as $row):?>
                                  <option value='<?= $row["Id"] ?>'><?= $row["Name"] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label>Contact Person</label>
                          <input type="text" class="form-control" id="ContactPerson" name="ContactPerson" placeholder="Enter Contact Person">
                        </div>
                        <div class="form-group">
                          <label>Mobile No</label>
                          <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="Enter Mobile No">
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" id="Email" name="Email" placeholder="Enter Email">
                        </div>
                      </div>
					</div><!-- /.box-body -->
                    <div class="box-footer">
                      <input type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-success pull-right" value="Add Company"/>
                    </div><!-- /.box-footer-->
                  </form>
              </div><!-- /.box -->
            </div><!-- /.col -->            
          </div>
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
<!-- Scripts Area -->
    <script src="plugins/image-preview-jquery/jquery.min.js"></script>
    <script src="plugins/image-preview-jquery/img.js"></script>
<?php
    include("common/scripts.php");
?>
<!-- Scripts Area End -->
  </body>
</html>
<?php
}
?> 