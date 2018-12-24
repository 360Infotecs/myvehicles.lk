<?php
include('common/DBConnect.php');
include('common/functions.php');

if(isset($_POST["company_id"]))
{
	$status='';
	$select = $pdo->prepare(
		"SELECT * FROM company
		WHERE Id = '".$_POST["company_id"]."' 
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
		$query="UPDATE company SET Status = 2 WHERE Id = :id";
		$updmsg="Company Deactivated.";
	}
	else if($status == '2')
	{
		$query="UPDATE company SET Status = 1 WHERE Id = :id";
		$updmsg="Company Activated.";
	}

	$statement = $pdo->prepare($query);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["company_id"]
		)
	);
	
	if(!empty($result))
	{
		echo $updmsg;
	}
}
?>