<?php
session_start();
include('common/DBConnect.php');
include('function.php');

//$userid = $_SESSION['UserId'];

	//echo '<script>console.log('.  $_POST["user_id"] .')</script>';

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
		//$output["UserId"] = $row["UserId"];
		$output["userlevel"] =2;// $row["userlevel"];
		$output["UserName"] = $row["UserName"];
		//$output["Password"] = $row["Password"];
		$output["PhoneNo"] = $row["PhoneNo"];
		//$output["Status"] = $row["Status"];
		//$output["StatusUpdatedBy"] = $userid;
		//$output["StatusUpdatedDate"] = date('Y-m-d H:i:s');
		//$output["CreatedBy"] = $row["CreatedBy"];
		//$output["CreatedDate"] = $row["CreatedDate"];
	}
	echo json_encode($output);
}
?>