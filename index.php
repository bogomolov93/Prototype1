<?php 
session_start();

include_once("conf.php");
include("functions.inc.php");

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION);
	session_unset();
	setcookie('authhash_uid', "");
	setcookie('authhash_code', "");
	unset($_COOKIE['authhash_uid']);
	unset($_COOKIE['authhash_code']);
	session_regenerate_id();
	header("Location: ".$CONF['hostname']);
	//setcookie('id', '', 0, "/");
	//setcookie('ps', '', 0, "/");
	// ТУТ УДАЛИТЬ КУКИ
}
if(isset($_POST['login']) && isset($_POST['password'])){
		$rq=1;
		$req_url=$_POST['req_url'];
		$rm=$_POST['remember_me'];
		$userlogin=$_POST['login'];
		$userpass=md5($_POST['password']);
		$stmt = $dbConnection->prepare('SELECT id_user, fio, login status FROM users where login=:log and pass=:pas');
		$stmt->execute(array(':log' => $userlogin,':pas' => $userpass));
	   if($stmt -> rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC); 
			$_SESSION['service_user_id'] = $row['id_user'];
			$_SESSION['service_user_login'] = $row['login'];
			$_SESSION['service_user_fio'] = $row['fio'];
			$_SESSION['code'] = md5($userpass);
			if ($rm == "1") {		
				setcookie('authhash_uid', $_SESSION['service_user_id'], time()+60*60*24*7);
				setcookie('authhash_code', $_SESSION['code'], time()+60*60*24*7);
			}
		} 
}

if (validate_user($_SESSION['service_user_id'], $_SESSION['code'])) {
	$url = parse_url($CONF['hostname']);

    if ($rq==1) { header("Location: http://".$url['host'].$req_url);}
	include("inc/head.php");

	if (isset($_GET[''])) {
		
		
		switch($_GET) {
	case 'clients': 	include('clients.php');		break;
	default: include('404.php');
}	
		}

} else {
    include 'auth.php';
}
?>
