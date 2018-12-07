<?php
$msg = '';
$msgresult = false;
 require_once 'DBConnect.php';

/**
 * Validate Empty Fields
 * @param string $param is the input value to validate
 * @param string $func_name is used to display on the message
  */
 function validate_empty($param,$func_name)
 {
   global $msg;
   
   if($param != '')
   {
     $param = filter_var($param,FILTER_SANITIZE_STRING);
     return $param;
   }
   else
   {
     $msg =  'Please enter the '.$func_name.'. ';
     echo $msg;
     return false;
   }
  }

function validate_selection($value,$func_name)
{
  global $msg;
  if($value>=1)
  {
    return $value;
  }
  else
  {
    $msg =  'Invalid '.$func_name.' Selection. ';
    echo $msg;
    return false;
  }
}

  function GenerateRandomId($random_id_length,$phrase) {
    global $res;
    //$random_id_length= 5;
    $stamp = date("ymd");
    $rnd_id = uniqid(rand(), 1);
    $rnd_id = strip_tags(stripslashes($rnd_id));
    $rnd_id = str_replace(".", "", $rnd_id);
    $rnd_id = strrev(str_replace("/", "", $rnd_id));
    $rnd_id = substr($rnd_id, 0, $random_id_length);
    return "$phrase$stamp$rnd_id";
}


function display_msg($msg, $type)
{
    $type === true ? $cssClass = "alert-success" : $cssClass = "alert-error";
    if ($msg != '') {
?>
 <div class="alert <?php
        echo $cssClass;
?>">
 <?php
        echo $msg;
?>
 </div>
 <?php
    }
}


// Function to generate OTP 
function generateNumericOTP($n) { 
  $generator = "1357902468abcdefghijklmnopqrstuvwxyz"; 
  $result = ""; 

  for ($i = 1; $i <= $n; $i++) { 
      $result .= substr($generator, (rand()%(strlen($generator))), 1); 
  } 
  return $result; 
}

function SMS($message,$to)
{
	$phoneNo="+94".(int)$to;
	include_once("telerivet.php");
	$API_KEY="2IrOU_WEWKmeyykxLxe7boJ2WBOw0lsmFRIx";
	$project_id="PJ5ea64779e932c763";
	$tr = new Telerivet_API($API_KEY);
	$project = $tr->initProjectById($project_id);
	$sent_msg = $project->sendMessage(array(
	'content' => $message, 
	'to_number' => $phoneNo
	));
}

function E_mail()
{

}

function set_cookie()
{
  if(!empty($_POST["remember"])) {
    setcookie ("login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
    setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
  } else {
    if(isset($_COOKIE["login"])) {
      setcookie ("login","");
    }
    if(isset($_COOKIE["password"])) {
      setcookie ("password","");
    }
  }
}
?>