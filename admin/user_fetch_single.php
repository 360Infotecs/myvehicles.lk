<?php
session_start();
include('common/DBConnect.php');
include('function.php');

if(isset($_POST["user_id"]))
{
	
	$output = array();
	$statement = $pdo->prepare(
		"SELECT * FROM `systemuser`
		WHERE Id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["UserId"] = $row["UserId"];
		$output["UserLevel"] = $row["UserLevel"];
		$output["UserName"] = $row["UserName"];
		$output["Password"] = $row["Password"];
		$output["PhoneNo"] = $row["PhoneNo"];
		$output["Status"] = $row["Status"];
		$output["StatusUpdatedBy"] = $row["StatusUpdatedBy"];
		$output["StatusUpdatedDate"] = $row["StatusUpdatedDate"];
		$output["CreatedBy"] = $row["CreatedBy"];
		$output["CreatedDate"] = $row["CreatedDate"];
	}
	echo json_encode($output);
}
?>