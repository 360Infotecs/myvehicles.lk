<?php
session_start();
require 'common/DBConnect.php';
require_once 'common/functions.php';
$result = false;
if (isset($_POST['btnsubmit']))
{
    try
    {
        $result = insert_company();
        if (!isset($_SESSION['UserName']))
        {
            header("location: login.php");
        }
        else
        {
            display_form();
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
}
else
{
    if (!isset($_SESSION['UserName']))
    {
        header("location: login.php");
    }
    else
    {
        display_form();
    }
}

function company_exist($company)
{
    global $msg, $pdo;
    $sql_select = "SELECT * FROM `company` 
    WHERE `CompanyName` = " . $pdo->quote($company) . "
        LIMIT 1";
    $stmt       = $pdo->query($sql_select);
    if ($stmt === false)
    {
        $msg = 'Error querying Users';
        return NULL;
    }
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r !== false)
    {
        $msg = "User with Phone No <b>$company</b> already exists.";
        return true;
    }
    else
        return false;
}

function insert_company()
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
    $CompanyId         = GenerateRandomId(5, 'MVC');
    $statusUpdatedBy   = $_SESSION['UserLevelId'];
    $statusUpdatedDate = date('Y-m-d H:i:s');
    $createdBy         = $_SESSION['UserLevelId'];
    $createdDate       = date('Y-m-d H:i:s');
    //image section start
    $imagename         = $_FILES['image']['name'];
    $imagetemp         = $_FILES['image']['tmp_name'];
    $imagetype         = $_FILES['image']['type'];
    $imagesize         = $_FILES["image"]["size"];
    $imageext          = pathinfo($imagename, PATHINFO_EXTENSION);
    $newimagename      = $CompanyId . "." . $imageext;
    
    if (!file_exists('images/companyLogo')) //create directory if not exist
    {
    	mkdir('images/companyLogo', 0777, true);
	}
    $imagepath         = "images/companyLogo/" . $newimagename;

    if (empty($imagename))
    {
        $msg = "Please Select Image";
        return false;
    }
    else if ($imagetype == "image/jpg" || $imagetype == 'image/jpeg' || $imagetype == 'image/png' || $imagetype == 'image/gif')
    {
        if (!file_exists($imagepath))
        {
            if ($imagesize < 5000000) //check file size 5MB
            {
                if ($CompanyName)
                {
                    if (!company_exist($CompanyName))
                    {
                        // construct SQL insert statement
                        $sql_insert = "INSERT INTO `company`(`CompanyId`, `AgentId`, `CompanyName`, 
                        `AddressLine1`, `AddressLine2`, `AddressLine3`, `ContactPerson`, 
                        `PhoneNo`, `Mobile`, `Email`, `Latitude`, `Longitude`, `Status`, 
                        `StatusUpdatedBy`, `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`)
                        VALUES(" . $pdo->quote($CompanyId) . "," . $pdo->quote($AgentId) . "," . $pdo->quote($CompanyName) . "," . $pdo->quote($AddressLine1) . "," . $pdo->quote($AddressLine2) . "," . $pdo->quote($AddressLine3) . "," . $pdo->quote($ContactPerson) . "," . $pdo->quote($PhoneNo) . "," . $pdo->quote($Mobile) . "," . $pdo->quote($Email) . "," . $pdo->quote($Latitude) . "," . $pdo->quote($Longitude) . "," . $pdo->quote($Status) . "," . $pdo->quote($statusUpdatedBy) . "," . $pdo->quote($statusUpdatedDate) . "," . $pdo->quote($createdBy) . "," . $pdo->quote($createdDate) . ")";
                                
                        if ($pdo->exec($sql_insert) === false)
                        {
                            $msg = 'Error creating the company.';
                            return false;
                        }
                        else
                        {
                            move_uploaded_file($imagetemp, $imagepath);
                            $msg = "The new company <b>$CompanyName</b> is created";
                            return true;
                            //display_form();
                        }
                    }
                }
                else
                {
                    $msg = "Enter Company Name";
                    return false;
                }
            }
            else
            {
                $msg = "Your File To large Please Upload 5MB Size.";
                return false;
            }
        }
        else
        {
            $msg = "File Already Exists.";
            return false;
        }
    }
    else
    {
        $msg = "Upload JPG , JPEG , PNG & GIF File Formate.";
        return false;
    }
    //image section end
}



function display_form()
{
    global $msg, $result, $pdo;
    $stmt = $pdo->query("SELECT * FROM companystatus");
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    $stmt1 = $pdo->query("SELECT * FROM systemuser");
    $stmt1->execute();
    $agent = $stmt1->fetchAll();
    
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyVehicles.lk | Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <?php
    include("common/head.php");
?>
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
            <div class="col-md-12">
              <div class="box">
                  <form role="form"action = "<?php
    $_SERVER['PHP_SELF'];
?>" method = "POST" enctype="multipart/form-data">
                    <div class="box-header with-border">
                      <?php
    display_msg($msg, $result);
?>
             </div>
                    <div class="box-body">
                      <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" disabled class="pull-right" style="background:white; 
                            border:0; color:red; font-weight: bold; font-size:18px;" value=""/>
                          </div>
                      </div>
                    
                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Company Logo</label>
                            <img id="imgs" style="max-width:250px;margin:10px;"class="img-responsive"/>
                            <input type="file" class="coverimage form-control" id="image" name="image">
                            <input type="hidden" name="companyId" id="companyId"/>
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
                                <?php
    foreach ($agent as $row1):
?>
                            <option value='<?= $row1["Id"] ?>'><?= $row1["UserName"] ?> ( <?= $row1["UserId"] ?> )</option>n
                                <?php
    endforeach;
?>
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
                            <?php
    foreach ($data as $row):
?>
                        <option value='<?= $row["Id"] ?>'><?= $row["Name"] ?></option>
                            <?php
    endforeach;
?>
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
<!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
<!-- Scripts Area End -->
  </body>
</html>
<?php
}
?> 