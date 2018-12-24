<?php

include('common/DBConnect.php');
include('common/functions.php');

if(isset($_POST["company_id"]))
{
	$statement = $pdo->prepare(
		"UPDATE company SET Status = 3 WHERE Id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["company_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Company Deleted';
	}
}
?>