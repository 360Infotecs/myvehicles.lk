<?php
include_once ('common/DBConnect.php');
require_once 'common/functions.php';
$result = false;
global $msg, $result, $pdo;
$currentuser = $_SESSION['UserLevelId'];
$currentuserid = $_SESSION['UserId'];
$query = 'SELECT * FROM userlevel ';

//Bind Dropdown
if ($currentuser === '1') //Super Admin
{
    $query.= 'WHERE id!=1';
} else if ($currentuser === '2') //System Admin
{
    $query.= 'WHERE Id!=1 AND Id!=2';
} else if ($currentuser === '3') //Level 1 User
{
    $query.= 'WHERE Id!=1 AND Id!=2 AND Id!=3';
} else if ($currentuser === '4') //Level 2 User
{
    $query.= 'WHERE Id=5';
}

$stmt = $pdo->query($query);
$stmt->execute();
$data = $stmt->fetchAll();

/*if (isset($_POST["operation"])) {*/
	
	//Add
    /*if ($_POST["operation"] == "Add") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        }
        $statement = $connection->prepare("
   			INSERT INTO users (first_name, last_name, image) 
   			VALUES (:first_name, :last_name, :image)
   		");
        $result = $statement->execute(array(':first_name' => $_POST["first_name"], ':last_name' => $_POST["last_name"], ':image' => $image));
        if (!empty($result)) {
            echo 'Data Inserted';
        }
    }*/
    
    //Edit
  /*  if ($_POST["operation"] == "Edit") {
        $image = '';
        if ($_FILES["user_image"]["name"] != '') {
            $image = upload_image();
        } else {
            $image = $_POST["hidden_user_image"];
        }
        $statement = $connection->prepare("UPDATE users 
   			SET first_name = :first_name, last_name = :last_name, image = :image  
   			WHERE id = :id
   			");
        $result = $statement->execute(array(':first_name' => $_POST["first_name"], ':last_name' => $_POST["last_name"], ':image' => $image, ':id' => $_POST["user_id"]));
        if (!empty($result)) {
            echo 'Data Updated';
        }
    }*/
/*}*/
?>
   
   
<!-- Add New -->
<div class="modal modal-primary fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <center>
               <h4 class="modal-title" id="myModalLabel"></h4>
            </center>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <form id="addForm" onsubmit="return checkall();">
                  <div class="box-header with-border">
                     <?php//display_msg($msg, $result);?>
                  </div>
                  <div class="box-body">
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>User Name</label>
                           <input type="text" class="form-control" id="username" name="username" placeholder="Enter UserName" onkeyup="checkuser();">
                           <span id="user_status"></span>
                        </div>
                        <div class="form-group">
                           <label>Phone No</label>
                           <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter phone No" onkeyup="checkphone();">
                           <span id="phone_status"></span>
                        </div>
                        <div class="form-group">
                           <label>User Level</label>
                           <select class="form-control" id="userlevel" name="userlevel">
                              <option>Select User Level</option>
                              <?php foreach ($data as $row):?>
                              <option value='<?= $row["Id"] ?>'><?= $row["Name"] ?></option>
                              <?php endforeach;?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                  	<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
                     <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                     <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- Edit -->
<div class="modal model-warning fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <center>
               <h4 class="modal-title" id="myModalLabel">Edit Member</h4>
            </center>
         </div>
         <form id="editForm">
            <div class="container-fluid">
               <div class="box-header with-border">
                  <?php//display_msg($msg, $result);?>
               </div>
               <div class="modal-body">
                  <input type="hidden" class="id" name="id">
                  <div class="row form-group">
                     <div class="col-sm-2">
                        <label class="control-label" style="position:relative; top:7px;">Firstname:</label>
                     </div>
                     <div class="col-sm-10">
                        <input type="text" class="form-control firstname" name="firstname">
                     </div>
                  </div>
                  <div class="row form-group">
                     <div class="col-sm-2">
                        <label class="control-label" style="position:relative; top:7px;">Lastname:</label>
                     </div>
                     <div class="col-sm-10">
                        <input type="text" class="form-control lastname" name="lastname">
                     </div>
                  </div>
                  <div class="row form-group">
                     <div class="col-sm-2">
                        <label class="control-label" style="position:relative; top:7px;">Address:</label>
                     </div>
                     <div class="col-sm-10">
                        <input type="text" class="form-control address" name="address">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
               <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- Delete -->
<div class="modal model-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <center>
               <h4 class="modal-title" id="myModalLabel">Delete Member</h4>
            </center>
         </div>
         <div class="modal-body">
            <p class="text-center">Are you sure you want to Delete</p>
            <h2 class="text-center fullname"></h2>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            <button type="button" class="btn btn-danger id"><span class="glyphicon glyphicon-trash"></span> Yes</button>
         </div>
      </div>
   </div>
</div>
