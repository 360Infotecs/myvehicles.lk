<?php
session_start();
include('common/DBConnect.php');
include('function.php');

if(isset($_POST["company_id"]))
{
	
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM company
		WHERE Id = '".$_POST["company_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["CompanyId"] = $row["CompanyId"];
		$output["AgentId"] = $row["AgentId"];
		$output["CompanyName"] = $row["CompanyName"];
		$output["AddressLine1"] = $row["AddressLine1"];
		$output["AddressLine2"] = $row["AddressLine2"];
		$output["AddressLine3"] = $row["AddressLine3"];
		$output["ContactPerson"] = $row["ContactPerson"];
		$output["PhoneNo"] = $row["PhoneNo"];
		$output["Mobile"] = $row["Mobile"];
		$output["Email"] = $row["Email"];
		$output["Latitude"] = $row["Latitude"];
		$output["Longitude"] = $row["Longitude"];
		$output["StatusUpdatedBy"] = $row["StatusUpdatedBy"];
		$output["StatusUpdatedDate"] = $row["StatusUpdatedDate"];
		
		$image = glob('images/companyLogo/'.$row["CompanyId"].'.*');
		
		if($image != NULL)
		{
			foreach ($image as $img) {

				$output['imgs'] = $img;
			}
			
		}
		else
		{
			$output['imgs'] = '';
		}
		


	}
	echo json_encode($output);
}
?>