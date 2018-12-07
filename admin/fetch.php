<?php
include_once('common/DBConnect.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM systemuser ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE UserId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR UserName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR PhoneNo LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY Id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["Id"];
	$sub_array[] = $row["UserId"];
	$sub_array[] = $row["UserLevel"];
	$sub_array[] = $row["UserName"];
	$sub_array[] = $row["Password"];
	$sub_array[] = $row["PhoneNo"];
	$sub_array[] = $row["Status"];
	$sub_array[] = $row["StatusUpdatedBy"];
	$sub_array[] = $row["StatusUpdatedDate"];
	$sub_array[] = $row["CreatedBy"];
	$sub_array[] = $row["CreatedDate"];
	//$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
	//$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>