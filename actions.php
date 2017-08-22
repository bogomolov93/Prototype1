<?php
session_start();
include("functions.inc.php");
if (isset($_POST['mode'])){
    
    $mode=($_POST['mode']);
		
		if($mode == "add_new_client"){
			$fn=$_POST['name_client'];
			$ln=$_POST['last_name_client'];
			$md=$_POST['middle_name_client'];
			$birth=$_POST['birthday_client'];
			$tel=$_POST['tel_client'];
			$email=$_POST['email_client'];
			$skype=$_POST['skype_client'];
			$area=$_POST['area_client'];
			$adr=$_POST['adr_client'];
			$id_le=$_POST['learned_client'];
			$id_us=$_POST['cons_client'];
			$id_ev=$_POST['event_client'];
			$status=$_POST['client_status'];
			$date_cr=date("Y-m-d h:i:s");
			$stmt = $dbConnection->prepare('insert into clients (id_learned,first_name, last_name, middle_name, birthday, tel, email, skype, area, adr, id_user, id_event,date_create, id_status) values (:id_le, :fn, :ln, :md, :birth, :tel, :email, :skype, :area, :adr, :id_us, :id_ev, :date_cr, :id_st)');
            $stmt->execute(array(':id_le' => $id_le,':fn' => $fn, ':ln'=> $ln, ':md'=>$md,':birth' => $birth,':tel' => $tel,':email' => $email,':skype' => $skype,':area' => $area,':adr' => $adr,':id_us' => $id_us,':id_ev' => $id_ev,':date_cr' => $date_cr,':id_st' => $status));
			
		}
       	
		if($mode == "add_new_history"){
			$history=$_POST['history'];
			$id_client=$_POST['id_client'];
			$stmt = $dbConnection->prepare('insert into history (id_client,history,date_create) values (:id_client,:history,now())');
			$stmt->execute(array(':id_client'=>$id_client,':history'=>$history));
		}

    }
?>
