
<?php
$res='';
echo GenerateRandomId();

function GenerateRandomId(){
	global $res;
  $random_id_length = 5; 
  $stamp = date("ymd");
  $rnd_id = uniqid(rand(),1); 
  $rnd_id = strip_tags(stripslashes($rnd_id));
  $rnd_id = str_replace(".","",$rnd_id); 
  $rnd_id = strrev(str_replace("/","",$rnd_id)); 
  $rnd_id = substr($rnd_id,0,$random_id_length);
   return "$stamp$rnd_id";
}
?>

<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-ban"></i> Alert!</h4>
Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.
</div>