<?php
include('common/DBConnect.php');
include('common/functions.php');

if(isset($_POST["user_id"]))
{
	$status='';
	$select = $pdo->prepare(
		"SELECT * FROM `systemuser`
		WHERE Id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$select->execute();
	$response = $select->fetchAll();
	foreach($response as $row)
	{
		$status = $row["Status"];
	}
	
	$query="";
	$updmsg="";
	if($status == '1')
	{
		$query="UPDATE systemuser SET Status = 2 WHERE Id = :id";
		$updmsg="User account Deactivated.";
	}
	else if($status == '2')
	{
		$query="UPDATE systemuser SET Status = 1 WHERE Id = :id";
		$updmsg="User account Activated.";
	}
	$statement = $pdo->prepare($query);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo $updmsg;
	}
}
?>