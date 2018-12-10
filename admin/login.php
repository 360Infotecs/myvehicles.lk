<?php
session_start();
if (isset($_SESSION['UserName'])) {
    header("location: index.php");
    }
require_once 'common/functions.php';

if (isset($_POST['login'])) {
    require_once 'common/DBConnect.php';
    
    
    try {
        $result = create_func();
        
        display_form();
        
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    // display form
    display_form();
}

/**
 * login user
 * @param string $msg message 
 * @return boolean return true on success, false on failure
 */
function create_func()
{
    $un        = trim($_POST['username']);
    $phone_no = validate_empty($un, 'Username');
    if ($phone_no) {
        $pwd      = trim($_POST['password']);
        $password = validate_empty($pwd, 'Password');
        if ($password) {
            // check if the user exists
            if (record_exist($phone_no)) {
                return login_func($phone_no, $pwd);
            }
        }
    }
    return false;
}




/**
 * Check if a user exists
 * @param string $dept_name user name
 * @return NULL|boolean return true if user exists, false
 *         if it does not exist, and NULL on failure
 */
function record_exist($phone_no)
{
    global $msg, $pdo;
    
    $sql_select = "SELECT `Id` FROM `systemuser` 
            WHERE `Status`= 1 and `PhoneNo` = " . $pdo->quote($phone_no) . " 
            LIMIT 1";
    
    $stmt = $pdo->query($sql_select);
    
    if ($stmt === false) {
        $msg = 'Error finding user';
        return NULL;
    }
    
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r !== false) {
        return true;
    } else {
        $msg = "The user with user name <b>$phone_no</b> is unavailable";
        return false;
    }
}

/**
 * insert a new department table
 * @param string $dept_name department name
 * @return boolean return true on success or false on failure
 */
function login_func($phone_no, $password)
{
    global $pdo, $msg;
    // construct SQL insert statement
    $sql_select = "select su.Id,su.UserId,su.UserName,su.Password,su.PhoneNo,ul.Id as UserLevelId,
    ul.Name as UserLevel,us.Id as UserStatusId,us.Name as UserStatus, su.CreatedDate from systemuser su 
    left join userlevel ul on ul.Id = su.UserLevel 
    left join userstatus us on us.Id = su.Status WHERE su.Status = 1 and
     su.PhoneNo ='" . $phone_no . "'
    LIMIT 1";
    
    $stmt = $pdo->query($sql_select);
    
    if ($stmt === false) {
        $msg = 'Error login';
        return NULL;
    }

    if(!empty($_POST["remember"])) {
        setcookie ("login",$phone_no,time()+ (10 * 365 * 24 * 60 * 60));
        setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
    } else {
        if(isset($_COOKIE["login"])) {
            setcookie ("login","");
        }
        if(isset($_COOKIE["password"])) {
            setcookie ("password","");
        }
    }



    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (md5($password) === $user['Password']) {
        //Provide the user with a login session.
        $_SESSION['Id']             = $user['id'];
        $_SESSION['UserId']         = $user['UserId'];
        $_SESSION['UserName']       = $user['UserName'];
        $_SESSION['Password']       = $user['Password'];
        $_SESSION['PhoneNo']        = $user['PhoneNo'];
        $_SESSION['UserLevelId']    = $user['UserLevelId'];
        $_SESSION['UserLevel']      = $user['UserLevel'];
        $_SESSION['UserStatusId']   = $user['UserStatusId'];
        $_SESSION['UserStatus']     = $user['UserStatus'];
        $_SESSION['CreatedDate']    = $user['CreatedDate'];
        $_SESSION['LoggedInTime']   = time();
        
        //Redirect to our protected page, which we called home.php
        header('Location: index.php');
        exit;
    } else {
        //$validPassword was FALSE. Passwords do not match.
        $msg = "Password Incorrect.";
        return false;
        //die('Incorrect username / password combination!');
    }
    if ($r === false) {
        $msg = "Password Incorrect.";
        return false;
    } else {
        return true;
    }
}



/**
 * display the create new department form
 */
function display_form()
{
    global $msg, $result;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyVehicles.lk | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
    include("common/head.php");
?>
<!-- iCheck -->
<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
 </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>My</b>Vehicle.lk</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <!--<p class="login-box-msg">Sign in to start your session</p>-->
        <form action="<?php
    $_SERVER['PHP_SELF'];
?>" method="post">
        <?php
    display_msg($msg, $result);
?>
         <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="07XXXXXXXX"id="username" name="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password"id="password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
               
               
              <label class="">
                  <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                  <input type="checkbox" type="checkbox" id="remember" name="remember" style="position: absolute; top: -20%; left: -20%; display: block; 
                  width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); 
                  border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; 
                  top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; 
                  padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                  </ins></div> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
            <input type="submit" name="login" value="Log in" class="btn btn-primary btn-block btn-flat">
            </div><!-- /.col -->
          </div>
        </form>

        <!--<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div>--><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
<?php
    
}