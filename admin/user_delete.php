<?php

include('common/DBConnect.php');
include('common/functions.php');

if(isset($_POST["user_id"]))
{
	$statement = $pdo->prepare(
		"UPDATE systemuser SET Status = 3 WHERE Id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'User Deleted';
	}
}
?>