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
	$query .='SELECT po.Id, po.PostId,po.PostTitle,br.Name AS Brand,cl.Name AS ClassOfVehicle,ve.Name AS VehicleCondition,col.Name AS Colour, fu.Name AS FualType, tr.Name AS TransmissionType,po.ModelYear, co.CompanyId, co.CompanyName, su.UserId as AgentNo, po.SubAgentName,col.ColourCode
		FROM posts po 
		LEFT JOIN company co ON co.Id = po.companyId
		LEFT JOIN systemuser su ON su.Id = po.AgentId
		LEFT JOIN classofvehicle cl ON cl.Id = po.ClassOfVehicleId
		LEFT JOIN brand br ON br.Id = po.BrandId
		LEFT JOIN colour col ON col.Id = po.ColourId
		LEFT JOIN vehiclecondition ve ON ve.Id=po.VehicleConditionId
		LEFT JOIN fualtype fu ON fu.Id=po.FuelTypeId
		LEFT JOIN transmissiontype tr ON tr.Id = po.TransmissionTypeId WHERE ';
}
else if($currentuser==='2')//System Admin
{
	$query .='SELECT po.Id, po.PostId,po.PostTitle,br.Name AS Brand,cl.Name AS ClassOfVehicle,ve.Name AS VehicleCondition,col.Name AS Colour, fu.Name AS FualType, tr.Name AS TransmissionType,po.ModelYear, co.CompanyId, co.CompanyName, su.UserId as AgentNo, po.SubAgentName,col.ColourCode
		FROM posts po 
		LEFT JOIN company co ON co.Id = po.companyId
		LEFT JOIN systemuser su ON su.Id = po.AgentId
		LEFT JOIN classofvehicle cl ON cl.Id = po.ClassOfVehicleId
		LEFT JOIN brand br ON br.Id = po.BrandId
		LEFT JOIN colour col ON col.Id = po.ColourId
		LEFT JOIN vehiclecondition ve ON ve.Id=po.VehicleConditionId
		LEFT JOIN fualtype fu ON fu.Id=po.FuelTypeId
		LEFT JOIN transmissiontype tr ON tr.Id = po.TransmissionTypeId WHERE ';
}
else if($currentuser==='3')//Level 1 User
{
	$query .='SELECT po.Id, po.PostId,po.PostTitle,br.Name AS Brand,cl.Name AS ClassOfVehicle,ve.Name AS VehicleCondition,col.Name AS Colour, fu.Name AS FualType, tr.Name AS TransmissionType,po.ModelYear, co.CompanyId, co.CompanyName, su.UserId as AgentNo, po.SubAgentName,col.ColourCode
		FROM posts po 
		LEFT JOIN company co ON co.Id = po.companyId
		LEFT JOIN systemuser su ON su.Id = po.AgentId
		LEFT JOIN classofvehicle cl ON cl.Id = po.ClassOfVehicleId
		LEFT JOIN brand br ON br.Id = po.BrandId
		LEFT JOIN colour col ON col.Id = po.ColourId
		LEFT JOIN vehiclecondition ve ON ve.Id=po.VehicleConditionId
		LEFT JOIN fualtype fu ON fu.Id=po.FuelTypeId
		LEFT JOIN transmissiontype tr ON tr.Id = po.TransmissionTypeId WHERE po.CreatedBy ="'.$currentuserid.'" and ';
}
else if($currentuser==='4')//Level 2 User
{
	$query .='SELECT po.Id, po.PostId,po.PostTitle,br.Name AS Brand,cl.Name AS ClassOfVehicle,ve.Name AS VehicleCondition,col.Name AS Colour, fu.Name AS FualType, tr.Name AS TransmissionType,po.ModelYear, co.CompanyId, co.CompanyName, su.UserId as AgentNo, po.SubAgentName,col.ColourCode
		FROM posts po 
		LEFT JOIN company co ON co.Id = po.companyId
		LEFT JOIN systemuser su ON su.Id = po.AgentId
		LEFT JOIN classofvehicle cl ON cl.Id = po.ClassOfVehicleId
		LEFT JOIN brand br ON br.Id = po.BrandId
		LEFT JOIN colour col ON col.Id = po.ColourId
		LEFT JOIN vehiclecondition ve ON ve.Id=po.VehicleConditionId
		LEFT JOIN fualtype fu ON fu.Id=po.FuelTypeId
		LEFT JOIN transmissiontype tr ON tr.Id = po.TransmissionTypeId WHERE co.Status!=3 AND co.CreatedBy ="'.$currentuserid.'" and ';
}
else //Site User
{
	$query .=' ';
}


if(isset($_POST["search"]["value"]))
{
	$query .= '(po.PostId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR po.PostTitle LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR br.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cl.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR ve.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR col.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR fu.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR tr.Name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR po.ModelYear LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.CompanyId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR su.UserId LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR po.SubAgentName LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR co.CompanyName LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
	$orderCol =1+(int)$_POST['order']['0']['column'];
	$query .= 'ORDER BY '.$orderCol.' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY po.Id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

//echo '<script>console.log('.$query.')</script>';
$statement=mysqli_query($con, $query);


 

//$statement = $con->prepare($query);
//$statement->execute();
$result = $statement->fetchAll();

$data = array();
$filtered_rows = mysqli_num_rows($statement);
$activeClass='';
$activeTitle='';
$hidden='';

/*while ($row = $statement->fetch_assoc())
 {
 		$sub_array = array();
	$sub_array[] = $row["Id"];
	//$sub_array[] = $image;
	$sub_array[] = $row["PostId"];
	$sub_array[] = $row["PostTitle"];
	$sub_array[] = $row["Brand"];
	$sub_array[] = $row["ClassOfVehicle"];
	$sub_array[] = $row["VehicleCondition"];
	$sub_array[] = '<span href="#" style="display: inline-block; height: 20px; width: 20px; background-color:'.$row["ColourCode"].';"> </span> '.$row["Colour"];
	$sub_array[] = $row["FualType"];
	$sub_array[] = $row["TransmissionType"];
	$sub_array[] = $row["ModelYear"];
	$sub_array[] = $row["CompanyId"];
	$sub_array[] = $row["CompanyName"];
	$sub_array[] = $row["AgentNo"];
	$sub_array[] = $row["SubAgentName"];
	
	$data[] = $sub_array;
 }*/
 //exit;
 
 
foreach($result as $row)
{

	/*$image = '';
	$files = glob('images/companyLogo/'.$row["PostId"].'.*');
 	if($files !=NULL)
 	{
		foreach ($files as $item) {
			$image ='<img src="'.$item.'" class="img-thumbnail" style="max-width:50px; height:auto;"/>';
		}
	}
	else
	{
		$image = '';
	}*/

	$sub_array = array();
	$sub_array[] = $row["Id"];
	//$sub_array[] = $image;
	$sub_array[] = $row["PostId"];
	$sub_array[] = $row["PostTitle"];
	$sub_array[] = $row["Brand"];
	$sub_array[] = $row["ClassOfVehicle"];
	$sub_array[] = $row["VehicleCondition"];
	$sub_array[] = '<span href="#" style="display: inline-block; height: 20px; width: 20px; background-color:'.$row["ColourCode"].';"> </span> '.$row["Colour"];
	$sub_array[] = $row["FualType"];
	$sub_array[] = $row["TransmissionType"];
	$sub_array[] = $row["ModelYear"];
	$sub_array[] = $row["CompanyId"];
	$sub_array[] = $row["CompanyName"];
	$sub_array[] = $row["AgentNo"];
	$sub_array[] = $row["SubAgentName"];*/
	
	$data[] = $sub_array;
	
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_post_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>
