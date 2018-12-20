<?php
session_start();
include('common/DBConnect.php');
include('function.php');
include('common/functions.php');
global $pdo, $msg;

function company_exist($phoneNo)
{
    global $msg, $pdo;
    $sql_select = "SELECT * FROM company 
    	WHERE PhoneNo = " . $pdo->quote($phoneNo) . "
        LIMIT 1";
    $stmt       = $pdo->query($sql_select);
    if ($stmt === false)
    {
        $msg = 'Error querying Company. ';
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
    $cn       = $_POST['CompanyName'];
    $companyname = validate_empty($cn, 'Company Name');
    if ($companyname !== false)
    {
        $tpNo      = $_POST['PhoneNo'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $agentId = validate_selection($_POST['AgentId'], 'Agent');
        $CompanyId = GenerateRandomId(5, 'MVC');
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
	            	if ($phoneNo)
			        {
			            if (!company_exist($phoneNo))
			            {
			                return Insert_Company($agentId,$companyname,$phoneNo,$imagetemp,$imagepath,$CompanyId);
			            }
			        }
	            }
	        }
	    }
    }
    return false;
}

function edit_company()
{
	$company_id = $_POST['company_id'];
    $cn       = $_POST['CompanyName'];
    $companyname = validate_empty($cn, 'Company Name');
    if ($companyname !== false)
    {
        $tpNo      = $_POST['PhoneNo'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $agentId = validate_selection($_POST['AgentId'], 'Agent');
        
        if ($phoneNo)
        {
        	if($agentId)
        	{
				return Update_Company($company_id,$agentId, $companyname, $phoneNo);
			}
        }
    }
    return false;
}

function active_company()
{
	$company_id = $_POST['company_id'];



    if ($companyname !== false)
    {
        $tpNo      = $_POST['phoneno'];
        $phoneNo   = validate_empty($tpNo, 'Phone No');
        $agentId = validate_selection($_POST['userlevel'], 'User Level');
        
        if ($phoneNo)
        {
        /*    if (!company_exist($phoneNo))
            {*/
                return Update_Company($company_id,$agentId, $companyname, $phoneNo);
            /*}*/
        }
    }
    return false;
}

function Insert_Company($agentId,$companyname,$phoneNo,$imagetemp,$imagepath,$CompanyId)
{
	global $pdo, $msg;
	$statement = $pdo->prepare("
			INSERT INTO `company`(`CompanyId`, `AgentId`, `CompanyName`, 
            `AddressLine1`, `AddressLine2`, `AddressLine3`, `ContactPerson`, 
            `PhoneNo`, `Mobile`, `Email`, `Latitude`, `Longitude`, `Status`, 
            `StatusUpdatedBy`, `StatusUpdatedDate`, `CreatedBy`, `CreatedDate`)
			VALUES (:CompanyId, :AgentId, :CompanyName, :AddressLine1, :AddressLine2, 
			:AddressLine3, :ContactPerson, :PhoneNo, :Mobile, :Email, 
			:Latitude, :Longitude, :Status, :StatusUpdatedBy, :StatusUpdatedDate, 
			:CreatedBy, :CreatedDate)
		");

		$output='';
    	
            $output = $statement->execute(
				array(
					':CompanyId' =>	$CompanyId,
					':AgentId' => $agentId,
					':CompanyName' => $companyname,
					':AddressLine1' => $_POST['AddressLine1'],
					':AddressLine2' => $_POST['AddressLine2'],
					':AddressLine3' => $_POST['AddressLine3'],
					':ContactPerson' => $_POST['ContactPerson'],
					':PhoneNo' => $phoneNo,
					':Mobile' => $_POST['Mobile'],
					':Email' => $_POST['Email'],
					':Latitude' => $_POST['Latitude'],
					':Longitude' => $_POST['Longitude'],
					':Status' =>	2,
					':StatusUpdatedBy' =>	$_SESSION['UserId'],
					':StatusUpdatedDate' =>	date('Y-m-d H:i:s'),
					':CreatedBy' =>	$_SESSION['UserId'],
					':CreatedDate'=>	date('Y-m-d H:i:s')
				)
			);

		if ($output === false)
	    {
	        $msg = 'Error creating the Company.';
	        return false;
	        echo $msg;
	    }
	    else
	    {
	    	move_uploaded_file($imagetemp, $imagepath);
	        $msg = "The new Company $companyname is created. ";
	        echo $msg;
	        return true;
	    }
}

function Update_Company($company_id,$agentId, $companyname, $phoneNo)
{
	global $pdo, $msg;
	
	$statement = $pdo->prepare(		
			"UPDATE company SET CompanyName=:CompanyName,AddressLine1=:AddressLine1,
			AddressLine2=:AddressLine2,AddressLine3=:AddressLine3,
			ContactPerson=:ContactPerson,PhoneNo=:PhoneNo,Mobile=:Mobile,Email=Email,
			Latitude=:Latitude,Longitude=:Longitude,StatusUpdatedBy=:StatusUpdatedBy,
			StatusUpdatedDate=:StatusUpdatedDate 
			WHERE Id=:id"			
		);
		
		$result = $statement->execute(
			array(
				':CompanyName' => $companyname,
				':AddressLine1' => $_POST['AddressLine1'],
				':AddressLine2' => $_POST['AddressLine2'],
				':AddressLine3' => $_POST['AddressLine3'],
				':ContactPerson' => $_POST['ContactPerson'],
				':PhoneNo' => $phoneNo,
				':Mobile' => $_POST['Mobile'],
				':Email' => $_POST['Email'],
				':Latitude' => $_POST['Latitude'],
				':Longitude' => $_POST['Longitude'],
				':StatusUpdatedBy' =>	$_SESSION['UserId'],
				':StatusUpdatedDate' =>	date('Y-m-d H:i:s'),
				':id'			=>	$company_id
			)
		);
    	echo "<script>console.log( 'Debug Objects: " . $result . "' );</script>";
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