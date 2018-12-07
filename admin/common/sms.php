<?php
/*include_once("telerivet.php");
$API_KEY="2IrOU_WEWKmeyykxLxe7boJ2WBOw0lsmFRIx";
$project_id="PJ5ea64779e932c763";
$tr = new Telerivet_API($API_KEY);
$project = $tr->initProjectById($project_id);
$sent_msg = $project->sendMessage(array(
'content' => "This is an auto generated SMS from website", 
'to_number' => "+94783177468"
));*/

    $message1   = 'Congratulations! Your Phone has successfully registerd with www.myvehicles.lk.';
$phoneNo='0756902268';

SMS($message1, $phoneNo);

function SMS($message,$to)
{
	$phoneNo="+94".(int)$to;
	include_once("telerivet.php");
	$API_KEY="2IrOU_WEWKmeyykxLxe7boJ2WBOw0lsmFRIx";
	$project_id="PJ5ea64779e932c763";
	$tr = new Telerivet_API($API_KEY);
	$project = $tr->initProjectById($project_id);
	$sent_msg = $project->sendMessage(array(
	'content' => $message, 
	'to_number' => $phoneNo
	));
	return false;
}
?>