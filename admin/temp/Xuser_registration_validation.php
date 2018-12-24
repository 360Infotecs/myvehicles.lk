<?php

require 'common/DBConnect.php';
require_once 'common/functions.php';

if(isset($_POST['username']))
{

 global $msg, $pdo;
    
    $user=$_POST['username'];
    
    $sql_select = "SELECT `UserName` FROM `systemuser` WHERE `UserName` = " . $pdo->quote($user) . "
        LIMIT 1";
    $stmt       = $pdo->query($sql_select);
    if ($stmt === false)
    {
        $msg = 'Error querying Users';
        return NULL;
    }
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r !== false)
    {
        $msg = "User with User Name $user already exists.";
        return true;
    }
    else
        return false;
 
 
}








if(isset($_POST['phoneno']))
{
	global $msg, $pdo;
    
    $phone=$_POST['phoneno'];
    
    $sql_select = "SELECT PhoneNo
        FROM systemuser
        WHERE PhoneNo = " . $pdo->quote($phone) . "
        LIMIT 1";
    $stmt       = $pdo->query($sql_select);
    if ($stmt === false)
    {
        $msg = 'Error querying Users';
        return NULL;
    }
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r !== false)
    {
        $msg = "User with Phone No $phone already exists.";
        return true;
    }
    else
        return false;
        
}



?>