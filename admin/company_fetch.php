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
	$query .='SELECT co.Id, co.CompanyId, co.AgentId, co.CompanyName, co.AddressLine1, co.AddressLine2, co.AddressLine3, 
	co.ContactPerson, co.PhoneNo, co.Mobile, co.Email, co.Latitude, co.Longitude, co.Status as StatusId, 
	cs.Name as Status, co.StatusUpdatedBy, co.StatusUpdatedDate, co.CreatedBy, co.CreatedDate 
	FROM company co left join companystatus cs on cs.Id = co.Status WHERE ';
}
else if($currentuser==='2')//System Admin
{
	$query .='SELECT co.Id, co.CompanyId, co.AgentId, co.CompanyName, co.AddressLine1, co.AddressLine2, co.AddressLine3, 
	co.ContactPerson, co.PhoneNo, co.Mobile, co.Email, co.Latitude, co.Longitude, co.Status as StatusId, 
	cs.Name as Status, co.StatusUpdatedBy, co.StatusUpdatedDate, co.CreatedBy, co.CreatedDate 
	FROM company co left join companystatus cs on cs.Id = co.Status WHERE co.Status!=3 and ';
}
else if($currentuser==='3')//Level 1 User
{
	$query .='SELECT co.Id, co.CompanyId, co.AgentId, co.CompanyName, co.AddressLine1, co.AddressLine2, co.AddressLine3, 
	co.ContactPerson, co.PhoneNo, co.Mobile, co.Email, co.Latitude, co.Longitude, co.Status as StatusId, 
	cs.Name as Status, co.StatusUpdatedBy, co.StatusUpdatedDate, co.CreatedBy, co.CreatedDate 
	FROM company co left join companystatus cs on cs.Id = co.Status WHERE co.Status!=3 AND co.CreatedBy ="'.$currentuserid.'" and ';
}
/*else if($currentuser==='4')//Level 2 User
{
	$query .=' ';
}
else //Site User
{
	$query .=' ';
}*/


if(isset($_POST["search"]["value"]))
{
	$query .= '(co.CompanyId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.AgentId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.ContactPerson LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.PhoneNo LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.Mobile LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.Email LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.StatusUpdatedBy LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.StatusUpdatedDate LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.CreatedBy LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.CreatedDate LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.CompanyName LIKE "%'.$_POST["search"]["value"].'%") ';
}

	//$query .='and su.Status != 3 and su.UserId!="'.$currentuserid.'" ';





if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY co.Id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

//echo '<script>console.log('.$query.')</script>';

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
	$image = '';
	$files = glob('images/companyLogo/'.$row["CompanyId"].'.*');
 	if($files !=NULL)
 	{
		foreach ($files as $item) {
			$image ='<img src="'.$item.'" class="img-thumbnail" style="max-width:50px; height:auto;"/>';
		}
	}
	else
	{
		$image = '';
	}

	$sub_array = array();
	$sub_array[] = $row["Id"];
	$sub_array[] = $image;
	$sub_array[] = $row["CompanyId"];
	$sub_array[] = $row["AgentId"];
	$sub_array[] = $row["CompanyName"];
	$sub_array[] = $row["AddressLine1"];
	$sub_array[] = $row["AddressLine2"];
	$sub_array[] = $row["AddressLine3"];
	$sub_array[] = $row["ContactPerson"];
	$sub_array[] = $row["PhoneNo"];
	$sub_array[] = $row["Mobile"];
	$sub_array[] = $row["Email"];
	$sub_array[] = $row["Latitude"];
	$sub_array[] = $row["Longitude"];
	$sub_array[] = $row["Status"];
	$sub_array[] = $row["StatusUpdatedBy"];
	$sub_array[] = $row["StatusUpdatedDate"];
	$sub_array[] = $row["CreatedBy"];
	$sub_array[] = $row["CreatedDate"];
	
	
	if($row["StatusId"]==='1')
	{
		$hidden="";
		$activeClass="btn btn-primary btn-sm activate";
		$activeTitle="Disable";
	}
	else if($row["StatusId"]==='2')
	{
		$hidden="";
		$activeClass="btn btn-info btn-sm activate";
		$activeTitle="Activate";
		
	}
	else{
		$hidden=" hidden";
		$activeClass="btn btn-info btn-sm activate";
		$activeTitle="Deleted";
		
		
	}
	$sub_array[] = '<button class="'.$activeClass.$hidden.'" type="button" name="active" value="'.$activeTitle.'" id="'.$row["Id"].'"><span class="glyphicon glyphicon-off"></span> '.$activeTitle.'</button>';
	$sub_array[] = '<button class="btn btn-warning btn-sm update'.$hidden.'" id="'.$row["Id"].'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
	$sub_array[] = '<button class="btn btn-danger btn-sm delete'.$hidden.'" id="'.$row["Id"].'"><span class="glyphicon glyphicon-trash"></span> Delete</button>';

	$data[] = $sub_array;
	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_company_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>
