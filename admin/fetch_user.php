<?php
session_start();
$currentuser = $_SESSION['UserLevelId'];
$currentuserid=$_SESSION['UserId'];
include_once('common/DBConnect.php');
include('function.php');
$query = '';
$output = array();

if($currentuser==='1')//Super Admin
{
	//$query .='where su.UserId!="'.$currentuserid.'" ';
	$query .='select su.Id,su.UserId,su.UserName,su.PhoneNo,su.UserLevel as UserLevelId,ul.Name as UserLevel,su.Status as UserStatusId,us.Name as UserStatus,su.StatusUpdatedBy,su.StatusUpdatedDate,su.CreatedBy,su.CreatedDate from systemuser su left join userlevel ul on ul.Id = su.UserLevel left join userstatus us on us.Id = su.Status where su.UserId!="'.$currentuserid.'" ';
}
else if($currentuser==='2')//System Admin
{
	//$query .='where su.Status != 3 and su.UserLevel!=1 and su.UserLevel!=2 ';
	$query .='select su.Id,su.UserId,su.UserName,su.PhoneNo,su.UserLevel as UserLevelId,ul.Name as UserLevel,su.Status as UserStatusId,us.Name as UserStatus,su.StatusUpdatedBy,su.StatusUpdatedDate,su.CreatedBy,su.CreatedDate from systemuser su left join userlevel ul on ul.Id = su.UserLevel left join userstatus us on us.Id = su.Status where su.Status != 3 and su.UserLevel!=1 and su.UserLevel!=2 ';
}
else if($currentuser==='3')//Level 1 User
{
	//$query .='where su.Status != 3 and su.UserLevel!=1 and su.UserLevel!=2 and su.UserLevel!=3 and su.CreatedBy="'.$currentuserid.'" ';
	$query .='select su.Id,su.UserId,su.UserName,su.PhoneNo,su.UserLevel as UserLevelId,ul.Name as UserLevel,su.Status as UserStatusId,us.Name as UserStatus,su.StatusUpdatedBy,su.StatusUpdatedDate,su.CreatedBy,su.CreatedDate from systemuser su left join userlevel ul on ul.Id = su.UserLevel left join userstatus us on us.Id = su.Status where su.Status != 3 and su.UserLevel!=1 and su.UserLevel!=2 and su.UserLevel!=3 and su.CreatedBy="'.$currentuserid.'" ';
}
else if($currentuser==='4')//Level 2 User
{
	//$query .='where su.Status != 3 and su.UserLevel=5 and su.CreatedBy="'.$currentuserid.'" ';
	$query .='select su.Id,su.UserId,su.UserName,su.PhoneNo,su.UserLevel as UserLevelId,ul.Name as UserLevel,su.Status as UserStatusId,us.Name as UserStatus,su.StatusUpdatedBy,su.StatusUpdatedDate,su.CreatedBy,su.CreatedDate from systemuser su left join userlevel ul on ul.Id = su.UserLevel left join userstatus us on us.Id = su.Status where su.Status != 3 and su.UserLevel=5 and su.CreatedBy="'.$currentuserid.'" ';
}
else //Site User
{
	//$query .='where su.UserId!="'.$currentuserid.'" ';
	$query .='select su.Id,su.UserId,su.UserName,su.PhoneNo,su.UserLevel as UserLevelId,ul.Name as UserLevel,su.Status as UserStatusId,us.Name as UserStatus,su.StatusUpdatedBy,su.StatusUpdatedDate,su.CreatedBy,su.CreatedDate from systemuser su left join userlevel ul on ul.Id = su.UserLevel left join userstatus us on us.Id = su.Status where su.UserId!="'.$currentuserid.'" ';
}


if(isset($_POST["search"]["value"]))
{
	$query .= 'and (su.UserId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR su.UserName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR su.PhoneNo LIKE "%'.$_POST["search"]["value"].'%") ';
}

	//$query .='and su.Status != 3 and su.UserId!="'.$currentuserid.'" ';





if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY su.Id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
//echo $query;

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$activeClass='';
$activeTitle='';
$hidden='';
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["Id"];
	$sub_array[] = $row["UserId"];
	$sub_array[] = $row["UserName"];
	$sub_array[] = $row["PhoneNo"];
	//$sub_array[] = $row["UserLevelId"];
	$sub_array[] = $row["UserLevel"];
	//$sub_array[] = $row["UserStatusId"];
	$sub_array[] = $row["UserStatus"];
	$sub_array[] = $row["StatusUpdatedBy"];
	$sub_array[] = $row["StatusUpdatedDate"];
	$sub_array[] = $row["CreatedBy"];
	$sub_array[] = $row["CreatedDate"];
	
	if($row["UserStatusId"]==='1')
	{
		$hidden="";
		$activeClass="btn btn-primary btn-sm update";
		$activeTitle="Disable";
	}
	else if($row["UserStatusId"]==='2')
	{
		$hidden="";
		$activeClass="btn btn-info btn-sm update";
		$activeTitle="Activate";
		
	}
	else{
		$hidden=" hidden";
		$activeClass="btn btn-info btn-sm update";
		$activeTitle="Deleted";
		
		
	}
	$sub_array[] = '<button type="button" name="update" id="'.$row["Id"].'" class="'.$activeClass.$hidden.'"><span class="glyphicon glyphicon-trash"></span> '.$activeTitle.'</button>';
	$sub_array[] = '<button class="btn btn-warning btn-sm update'.$hidden.'" id="'.$row["Id"].'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
	$sub_array[] = '<button class="btn btn-danger btn-sm delete'.$hidden.'" id="'.$row["Id"].'"><span class="glyphicon glyphicon-trash"></span> Delete</button>';

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
