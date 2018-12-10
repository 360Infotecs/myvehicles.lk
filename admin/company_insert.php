<?php
session_start();
include('common/DBConnect.php');
include('function.php');
include('common/functions.php');
global $pdo, $msg;

function company_exist($phoneNo)
{
    global $msg, $pdo;
    $sql_select = "SELECT *
        FROM company
        WHERE CompanyName = " . $pdo->quote($phoneNo) . "
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
        $msg = "$phoneNo already exists. ";
        echo $msg;
        return true;
    }
    else
        return false;
}

function create_company()
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
            if (!company_exist($phoneNo))
            {
                return Insert_Company($userLevel, $username, $password, $phoneNo);
            }
        }
    }
    return false;
}

function edit_company()
{
	$user_id = $_POST['user_id'];
    $un       = $_POST['username'];
    $username = validate_empty($un, 'User Name');
    if ($username !== false)
    {
        $tpNo      = $_POST['phoneno'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $userLevel = validate_selection($_POST['userlevel'], 'User Level');
        
        if ($phoneNo)
        {
        /*    if (!company_exist($phoneNo))
            {*/
                return Update_User($user_id,$userLevel, $username, $phoneNo);
            /*}*/
        }
    }
    return false;
}

function active_company()
{
	$user_id = $_POST['user_id'];



    if ($username !== false)
    {
        $tpNo      = $_POST['phoneno'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $userLevel = validate_selection($_POST['userlevel'], 'User Level');
        
        if ($phoneNo)
        {
        /*    if (!company_exist($phoneNo))
            {*/
                return Update_User($user_id,$userLevel, $username, $phoneNo);
            /*}*/
        }
    }
    return false;
}

function Insert_Company($userLevel, $username, $password, $phoneNo)
{
	global $pdo, $msg;
	$statement = $pdo->prepare("
			INSERT INTO company(Id, CompanyId, AgentId, CompanyName, AddressLine1, AddressLine2, AddressLine3, ContactPerson, PhoneNo, Mobile, Email, Latitude, Longitude, Status, StatusUpdatedBy, StatusUpdatedDate, CreatedBy, CreatedDate) 
			VALUES (:CompanyId, :AgentId, :CompanyName, :AddressLine1, :AddressLine2, :AddressLine3, :ContactPerson, :PhoneNo, :Mobile, :Email, :Latitude, :Longitude, :Status, :StatusUpdatedBy, :StatusUpdatedDate, :CreatedBy, :CreatedDate)
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

function Update_User($user_id, $userLevel, $username, $phoneNo)
{
	global $pdo, $msg;
	
	$statement = $pdo->prepare(		
			"UPDATE company SET CompanyId=:CompanyId,AgentId=:AgentId,CompanyName=:CompanyName,AddressLine1=:AddressLine1,AddressLine2=:AddressLine2,AddressLine3=:AddressLine3,ContactPerson=:ContactPerson,PhoneNo=:PhoneNo,Mobile=:Mobile,Email=Email,Latitude=:Latitude,Longitude=:Longitude,Status=:Status,StatusUpdatedBy=:StatusUpdatedBy,StatusUpdatedDate=:StatusUpdatedDate,CreatedBy=:CreatedBy,CreatedDate=:CreatedDate WHERE Id=:id"			
		);
		
		$result = $statement->execute(
			array(
			 ':CompanyId'	=>	,
			 ':AgentId'	=>	,
			 ':CompanyName'	=>	,
			 ':AddressLine1'	=>	,
			 ':AddressLine2'	=>	,
			 ':AddressLine3'	=>	,
			 ':ContactPerson'	=>	,
			 ':PhoneNo'	=>	,
			 ':Mobile'	=>	,
			 ':Email'	=>	,
			 ':Latitude'	=>	,
			 ':Longitude'	=>	,
			 ':Status'	=>	,
			 ':StatusUpdatedBy'	=>	,
			 ':StatusUpdatedDate'	=>	,
			 ':CreatedBy'	=>	,
			 ':CreatedDate'	=>	,
 
				':UserLevel'	=>	$userLevel,
				':UserName'	=>	$username,
				':PhoneNo'		=>	$phoneNo,
				':StatusUpdatedBy'		=>	$_SESSION['UserId'],
				':StatusUpdatedDate'		=>	date('Y-m-d H:i:s'),
				':id'			=>	$user_id
			)
		);
    	
		if ($result === false)
	    {
	        $msg = 'Error Updating the Company.';
	        return false;
	        echo $msg;
	    }
	    else
	    {	    	
	        $msg = "Your Company information has successfully updated.";
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
			$result = create_company();
		}
	    catch (PDOException $e)
	    {
	        echo $e->getMessage();
	    }	
	}
	if($_POST["operation"] == "Edit")
	{
		try
		{
			$result = edit_company();
		}
	    catch (PDOException $e)
	    {
	        echo $e->getMessage();
	    }
	}
	if($_POST["operation"] == "Activate")
	{
		try
		{
			$result = active_company();
		}
	    catch (PDOException $e)
	    {
	        echo $e->getMessage();
	    }
	}
}

?>