<?php
session_start();
include('common/DBConnect.php');
include('function.php');
include('common/functions.php');
global $pdo, $msg;

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
        $msg = 'Error querying Users. ';
        echo $msg;
        return NULL;
    }
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r !== false)
    {
        $msg = "User with Phone No $phoneNo already exists. ";
        echo $msg;
        return true;
    }
    else
        return false;
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
                return Insert_User($userLevel, $username, $password, $phoneNo);
            }
        }
    }
    return false;
}

function Insert_User($userLevel, $username, $password, $phoneNo)
{
	global $pdo, $msg;
	$statement = $pdo->prepare("
			INSERT INTO systemuser(UserId, UserLevel, UserName, Password, PhoneNo, Status, StatusUpdatedBy, StatusUpdatedDate, CreatedBy, CreatedDate) 
			VALUES (:UserId, :UserLevel, :UserName, :Password, :PhoneNo, :Status, :StatusUpdatedBy, :StatusUpdatedDate, :CreatedBy, :CreatedDate)
		");

		$crypt_pass        = md5($password);
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
    
		$output='';
    	
            $output = $statement->execute(
				array(
					':UserId' =>	GenerateRandomId(5, $phrase),
					':UserLevel' =>	$userLevel,
					':UserName' =>	$username,
					':Password' =>	$crypt_pass, 
					':PhoneNo' =>	$phoneNo,
					':Status' =>	1,
					':StatusUpdatedBy' =>	$_SESSION['UserId'],
					':StatusUpdatedDate' =>	date('Y-m-d H:i:s'),
					':CreatedBy' =>	$_SESSION['UserId'],
					':CreatedDate'=>	date('Y-m-d H:i:s')
				)
			);

		$message1   = 'Congratulations! Your Phone has successfully registerd with www.myvehicle.lk. ';
    	$message2   = 'UserName:' . $username . ' Password:' . $password.'. ';
    	
		if ($output === false)
	    {
	        $msg = 'Error creating the user.';
	        return false;
	        echo $msg;
	    }
	    else
	    {
	    	
	        $msg = "The new user $phoneNo is created. ";
	        SMS($message1, $phoneNo);
	        SMS($message2, $phoneNo);
	        echo $msg;
	        return true;
	    }
	    
}


if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		try
		{
			$result = create_user();
		}
	    catch (PDOException $e)
	    {
	        echo $e->getMessage();
	    }	
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE users 
			SET first_name = :first_name, last_name = :last_name, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>