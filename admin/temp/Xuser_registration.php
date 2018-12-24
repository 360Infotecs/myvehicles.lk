<?php
session_start();

require 'common/DBConnect.php';
require_once 'common/functions.php';
$result = false;
if (isset($_POST['btnsubmit']))
{
    try
    {
        $result = create_user();
        if (!isset($_SESSION['UserName']))
        {
            header("location: login.php");
        }
        else
        {
           // display_form();
           header("location: user_manager.php");
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


function phoneno_exist($phoneNo)
{
    global $msg, $pdo;
    $sql_select = "SELECT *
        FROM systemuser
        WHERE PhoneNo = " . $pdo->quote($phoneNo) . "
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
        $msg = "User with Phone No $phoneNo already exists.";
        return true;
    }
    else
        return false;
}


function insert_user($userLevel, $username, $password, $phoneNo)
{
    global $pdo, $msg;
    $phrase = '';
    if ($userLevel === '1')
    {
        $phrase = 'MVSU';
    }
    else if ($userLevel === '2')
    {
        $phrase = 'MVSY';
    }
    else if ($userLevel === '3')
    {
        $phrase = 'MV1';
    }
    else if ($userLevel === '4')
    {
        $phrase = 'MV2';
    }
    else
    {
        $phrase = 'MVU';
    }
    
    $userId            = GenerateRandomId(5, $phrase);
    $status            = 1;
    $statusUpdatedBy   = $_SESSION['UserId'];
    $statusUpdatedDate = date('Y-m-d H:i:s');
    $createdBy         = $_SESSION['UserId'];
    $createdDate       = date('Y-m-d H:i:s');
    $crypt_pass        = md5($password);
    
    $message1   = 'Congratulations! Your Phone has successfully registerd with www.myvehicle.lk.';
    $message2   = 'UserName:' . $username . ' Password:' . $password;
    $sql_insert = "INSERT INTO systemuser(`UserId`, `UserLevel`, `UserName`, `Password`, `PhoneNo`, 
        `Status`, `StatusUpdatedBy`, `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`) 
        VALUES(" . $pdo->quote($userId) . "," . $pdo->quote($userLevel) . "," . $pdo->quote($username) . "," . $pdo->quote($crypt_pass) . "," . $pdo->quote($phoneNo) . "," . $pdo->quote($status) . "," . $pdo->quote($statusUpdatedBy) . "," . $pdo->quote($statusUpdatedDate) . "," . $pdo->quote($createdBy) . "," . $pdo->quote($createdDate) . ")";
    if ($pdo->exec($sql_insert) === false)
    {
        $msg = 'Error creating the user.';
        return false;
    }
    else
    {
        $msg = "The new user $phoneNo is created";
        SMS($message1, $phoneNo);
        SMS($message2, $phoneNo);
        return true;
    }
}



function create_user()
{
    $un       = $_POST['username'];
    $username = validate_empty($un, 'User Name');
    if ($username !== false)
    {
        $tpNo      = $_POST['phoneno'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $userLevel = validate_selection($_POST['userlevel'], 'User Level');
        
        $password = generateNumericOTP(10); //md5(uniqid($phoneNo, true));
        
        if ($phoneNo)
        {
            if (!phoneno_exist($phoneNo))
            {
                return insert_user($userLevel, $username, $password, $phoneNo);
            }
        }
    }
    return false;
}



function display_form()
{
    global $msg, $result, $pdo;
    $stmt = $pdo->query("SELECT * FROM userlevel");
    $stmt->execute();
    $data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyVehicles.lk | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
            User Registration
            <small>Create new user here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Registration</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content col-lg-6 col-md-6 col-sm-12 col-xs-12">

          <div class="box box-warning">
                
                <form role="form"action = "<?php
    $_SERVER['PHP_SELF'];
?>" method = "POST" class = "form-horizontal">
                <div class="box-header with-border">
                  <!--<h3 class="box-title"></h3>-->
                  <?php
    display_msg($msg, $result);
?>
           </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label>User Name</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Enter UserName">
                            </div><div class="form-group">
                              <label>Phone No</label>
                              <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter phone No">
                            </div>
                            <div class="form-group">
                              <label>User Level</label>
                              <select class="form-control" id="userlevel" name="userlevel">
                                <option>Select User Level</option>
                                <?php
    foreach ($data as $row):
?>
                               <option value='<?= $row["Id"] ?>'><?= $row["Name"] ?></option>n
                                <?php
    endforeach;
?>
                         </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                       <input type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-success pull-right" value="Create User"/>
                     </div>
                    </form>
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

<?php
    include("common/scripts.php");
?>
<!-- Scripts Area End -->
  </body>
</html>
<?php
}
?> 