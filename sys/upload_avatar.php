<?php
include_once("../functions.inc.php");
$output_dir = "/img/";

$maxsize    = 30097152;
//$id_client=$_GET['id'];
move_uploaded_file($_FILES["myfile"]["name"],$output_dir);


if(isset($_FILES["myfile"]))
{

	/*$ret = array();

	$error =$_FILES["myfile"]["error"];
	$flag  = false; 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	$filetype = $_FILES["myfile"]["type"];
 	 	$filesize = $_FILES["myfile"]["size"];
 	if($_FILES["myfile"]["size"]>$maxsize)
	{
	$flag=true;	
	}
 if ((!in_array($_FILES["myfile"]["type"], $acceptable)) && (!empty($_FILES["myfile"]["type"]))) {
    $flag=true;
}
 	 	
 	 	if($flag == false) {
 		$stmt = $dbConnection->prepare('update files SET avatar = :original_name where id_client=:id');
		$stmt->execute(array(':original_name'=>$fileName, ':id_client'=>$id_client));
 		}
	} */
 }
 ?>