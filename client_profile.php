<?php
session_start();
include("functions.inc.php");
if (validate_user($_SESSION['service_user_id'], $_SESSION['code'])) {
    include("inc/head.php");
    include("inc/head.inc.php");
    ?>
    <div class="container" style="position:relative;width:90%; height: 100%;";>
	<input type="hidden" id="id_client" value="<?=$_GET['id'];?>">
        <div class="input-group-btn">
            <button type="button" class="btn btn-default">Вернуться к списку клиентов</button>
            <button type="button" class="btn btn-default" style="position:absolute;  right: 175px;">Печатать штрих код</button>
            <button type="button" class="btn btn-default" style="position:absolute;  right: 0px;">печатать страницу</button>
        </div>
        <div id="profile_box">
				<div id="photo_profile">
					<?php
					$stmt = $dbConnection->prepare('SELECT avatar from clients where id_client=:id');
					$stmt->execute(array(':id'=>$_GET['id']));
					$avatar = $stmt->fetch(PDO::FETCH_ASSOC);
					if($afatar['avatar'] == NULL){
						$avatar = "img/photo_profile.png";
					}
					else {
						$avatar = $avatar['avatar'];
					}
					?>
					<img id="avatar" src="<?=$avatar;?>" width="200" height="200" alt="lorem">
					<button id="add_photo" type="button" class="btn btn-default">Добавить фотографию</button>
					<div class="container">
      	 				 <div class="modal fade" id="modal_add_photo" role="dialog">
         	 				 <div class="modal-dialog">
					  			 <div class="modal-content">
              	  	   				 <div class="modal-header">
                	       				 <button type="button" class="close" data-dismiss="modal">&times;</button>
                	       				 <h5>Добавьте фотографию</h5>
									</div>
                	   				 <div class="modal-body">
									 	<form enctype="multipart/form-data" action="sys/upload_avatar.php" method="post">
											<input type="file" name="myfile">
											<input type="submit" value="Добавить файл">
										</form>
                    				</div>
								</div>
				 			</div>
				 		</div>
			 		</div>
					<button id="edit_profile" type="button" class="btn btn-default">Редактировать профиль</button>
				</div>
				<div id="content_profile">
					<h6>Личные данные</h6>
					<?php
						$stmt = $dbConnection->prepare('SELECT  cl.id_client,cl.bonus,cl.tel,cl.skype,cl.email,cl.adr,cl.friend,usr.fio,cl.area,cl.first_name,cl.last_name,middle_name,birthday,st_c.value 
															FROM clients cl 
																join status_clients st_c
																on cl.id_status=st_c.id_status 
																	left join users usr
        															on cl.id_user=usr.id_user		
															where cl.id_client=:id');
						$stmt->execute(array(':id'=>$_GET['id']));
        				$res = $stmt->fetchAll();

						foreach($res as $row) {
							$first_name=$row['first_name'];
							$last_name=$row['last_name'];
							$middle_name=$row['middle_name'];
							$birthday=$row['birthday'];
							$tel = strval($row['tel']);
							$tel = '+' . substr($tel, 0, 1) . '(' . substr($tel, 1, 3) . ')' . substr($tel, 4, 3) . '-' . substr($tel, 7, 2) . '-' . substr($tel, 9, 2);
							$adr=$row['adr'];
							$email=$row['email'];
							$skype=$row['skype'];
							$area=row['area'];
							if($row['friend'] != null){
								$stmt = $dbConnection->prepare('SELECT first_name,last_name from clients		
																where id_client=:id');
								$stmt->execute(array(':id'=>$row['friend']));
        						$ro = $stmt->fetch(PDO::FETCH_ASSOC);
									$friend_name=$ro['first_name'];
									$friend_fam=$ro['last_name'];	
							}
							$stmt = $dbConnection->prepare('select 
												id_client
												,sum( case when is_come = 1 then 1  else 0 end ) 			as count_in
												,sum( case when is_come = 0 then 1  else 0 end ) 			as count_lose
											from visits
											where id_client=:id
											group by id_client');
							$stmt->execute(array(':id' => $row['id_client']));
						 	$count = $stmt->fetch(PDO::FETCH_ASSOC);
							
							$stmt = $dbConnection->prepare('SELECT count(friend) as count FROM SERVICE2.clients where friend =:id');
							$stmt->execute(array(':id' => $row['id_client']));
						 	$friend = $stmt->fetch(PDO::FETCH_ASSOC);
							
							$stmt = $dbConnection->prepare('select count(id_client) as count from purchases where id_client = :idd');
						 	$stmt->execute(array(':idd' => $row['id_client']));
						   	$purchase = $stmt->fetch(PDO::FETCH_ASSOC);
							
							$cons=$row['fio'];
							$status=$row['value'];
							$area=$row['area'];
						}
					?>
					<p><?php echo $first_name.' '.$last_name.' '.$middle_name;?></p>
					<p id="text_profile_up"><?php echo 'День рождения - '.DateTime::createFromFormat('Y-m-d', $birthday)->format('d-m-Y');?></p>
					<p id="text_profile_down"><?php echo $tel;?></p>
					<p class="text_profile"><?php echo $area.', '.$adr;?></p>
					<p class="text_profile"><?php echo $email;?></p>
					<p class="text_profile"><?php echo 'Skype - '.$skype;?></p>
					<p class="text_profile"><?php echo 'Привёл - '.$friend_name.' '.$friend_fam;?></p>
					<p class="text_profile"><?php echo 'Консультант - '.$cons;?></p>
				</div>
				
			<div id="stats">
				<div class="stats">
					<span>Статус</span>
						<div><?=$status;?></div>
				</div>
				<div class="stats">
					<span>Посещений</span>
						<div><?=$count['count_in'];?></div>
				</div>
				<div class="stats">
					<span>Пропусков</span>
						<div><?=$count['count_lose'];?></div>
				</div>
				<div class="stats">
					<span>Привёл клиентов</span>
						<div><?=$friend['count'];?></div>
				</div>
				<div class="stats">
					<span>Покупок</span>
						<div><?=$purchase['count'];?></div>
				</div>
				<div class="stats">
					<span>Бонусов</span>
						<div><?=$row['bonus'];?></div>
				</div>
			</div>
			
		</div>
        <div class="history">
			<h6>История</h6>
			<?php 
				$stmt = $dbConnection->prepare("SELECT history, date_create from history where id_client=:id_client");
				$stmt->execute(array(':id_client'=>$_GET['id']));
				$res= $stmt->fetchAll();
				foreach($res as $row){
			?>
					<p><?=$row['date_create'];?></p>
					<text><?=$row['history'];?></text>
			<?php 
				}
			?>
			<button id="add_history" type="button" class="btn btn-default">Добавить запись</button>
			<div class="container">
      	 		 <div class="modal fade" id="modal_add_history" role="dialog">
         	 		 <div class="modal-dialog">
					   <div class="modal-content">
              	  	    <div class="modal-header">
                	        <button type="button" class="close" data-dismiss="modal">&times;</button>
                	        <h5>Добавьте запись</h5>
               	    	 </div>
                	   		 <div class="modal-body">
									<textarea rows="4" cols="45" id="text_history"></textarea>
                    		</div>
                   		 <div class="modal-footer" style="position: relative">
                      	 	 <button type="button" id="modal_add_history" style="position: absolute; left: 15px" class="btn btn-primary">Добавить</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						</div>
					</div>

				 	</div>
				 </div>
			 </div>
		</div>
        <div id="purchases">Покупки</div>
       <!-- <div id="symptoms">Симптомы и улучшения</div>
        <div id="visitss">Посещения</div>
        <div id="relation">Отношение к товарам</div> -->
    </div>
    <?php
} else {
    include 'auth.php';
}
?>
