<?php
//session_start();

include_once('common/DBConnect.php');
$user_level = $_SESSION['UserLevelId'];
$currentuserid=$_SESSION['UserId'];
//User

function get_total_user_records()
{
	global $pdo, $user_level, $currentuserid;
	//$sql = 'SELECT * FROM systemuser';
	$sql = 'SELECT * FROM systemuser where Status != 3 and UserLevel=5 and CreatedBy='.$currentuserid;
/*    switch ($user_level) {
    case "1"://Super Admin
        $sql = 'SELECT * FROM systemuser where UserId!='.$currentuserid;
        break;
    case "2"://System Admin
        $sql = 'SELECT * FROM systemuser where Status != 3 and UserLevel!=1 and UserLevel!=2';
        break;
    case "3"://Level 1 User
        $sql = 'SELECT * FROM systemuser where Status != 3 and UserLevel!=1 and UserLevel!=2 and UserLevel!=3 and CreatedBy='.$currentuserid;
        break;
    case "4"://Level 2 User
        $sql = 'SELECT * FROM systemuser where Status != 3 and UserLevel=5 and CreatedBy='.$currentuserid;
        break;
    default://Site User
        $sql = 'SELECT * FROM systemuser where UserId!='.$currentuserid;
}*/
    
	$statement = $pdo->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
	
	return $statement->rowCount();
}
//User End


//Company

function get_total_company_records()
{
		global $pdo, $user_level, $currentuserid;
		//$sql = 'SELECT * FROM company';
		$sql = '';
	    switch ($user_level) {
		    case "1"://Super Admin
		        $sql = 'SELECT * FROM company';
		        break;
		    case "2"://System Admin
		        $sql = 'SELECT * FROM company where Status != 3';
		        break;
		    case "3"://Level 1 User
		        $sql = 'SELECT * FROM company where Status != 3 and CreatedBy='.$currentuserid;
		        break;
		    case "4"://Level 2 User
		        $sql = 'SELECT * FROM company where Status != 3 and CreatedBy='.$currentuserid;
		        break;
		    default://Site User
		        $sql = 'SELECT * FROM company where Status != 3 and CreatedBy='.$currentuserid;
		}
    
	$statement = $pdo->prepare($sql);
	$statement->execute();
	$result = $statement->fetchAll();
	
	return $statement->rowCount();
}
//Company End
?>