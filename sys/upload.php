<?php
include_once("../functions.inc.php");
$output_dir = "../upload_avatars/";

$iscom=$_POST['iscomm'];
if ($iscom === null)
{$iscom = '0';}
$new_hn=$_POST['new_hash'];
if ($new_hn === null)
{$new_hn = '0';}
$hn=$_POST['hashname'];
$maxsize    = 30097152;





if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	$flag  = false;
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
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
 	 	
 	 	
 	 	$fhash=randomhash();
 	 	$ext = pathinfo($fileName, PATHINFO_EXTENSION);
 	 	$fileName_norm = $fhash.".".$ext;
 	 	
 	 	
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName_norm);
 		
 		
 		$stmt = $dbConnection->prepare('insert into clients 
 		(avatar) values 
 		(:original_name)');
		$stmt->execute(array(':original_name'=>$fileName));
 		}
    	$ret[]= $fileName_norm;
	}

    echo json_encode($ret);
 }
 ?>