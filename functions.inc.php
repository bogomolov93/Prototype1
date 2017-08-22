<?php
session_start();

include_once('conf.php');
include_once('sys/class.phpmailer.php');
include_once('sys/Parsedown.php');
//require 'library/HTMLPurifier.auto.php';
date_default_timezone_set('Etc/GMT+3');
$dbConnection = new PDO(
    'mysql:host='.$CONF_DB['host'].';dbname='.$CONF_DB['db_name'],
    $CONF_DB['username'],
    $CONF_DB['password'],
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$CONF = array (
	'title_header'	=> get_conf_param('title_header'),
	'hostname'		=> get_conf_param('hostname'),
	'mail'			=> get_conf_param('mail'),
	'days2arch'		=> get_conf_param('days2arch'),
	'name_of_firm'	=> get_conf_param('name_of_firm'),
	'fix_subj'		=> get_conf_param('fix_subj'),
	'first_login'	=> get_conf_param('first_login'),
	'file_uploads'	=> get_conf_param('file_uploads'),
	'file_types'	=> '('.get_conf_param('file_types').')',
	'file_size'		=> get_conf_param('file_size')
	);

function validate_user($user_id, $input) {

    global $dbConnection;

    if (!isset($_SESSION['code'])) {

        if (isset($_COOKIE['authhash_code'])) {

            $user_id=$_COOKIE['authhash_uid'];
            $input=$_COOKIE['authhash_code'];
            $_SESSION['code']=$input;
            $_SESSION['service_user_id']=$user_id;

        }


    }


    $stmt = $dbConnection->prepare('SELECT pass,login,fio from users where id_user=:user_id LIMIT 1');
    $stmt->execute(array(':user_id' => $user_id));



    if ($stmt -> rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);







        //$row = mysql_fetch_assoc($sql);
        $dbpass=md5($row['pass']);
        $_SESSION['service_user_login'] = $row['login'];
        $_SESSION['service_user_fio'] = $row['fio'];
        //$_SESSION['service_sort_prio'] == "none";
        if ($dbpass == $input) { return true;}
        else { return false;}
    }
}

function get_conf_param($in) {
    global $dbConnection;
    $stmt = $dbConnection->prepare('SELECT value FROM settings where param=:in');
    $stmt->execute(array(':in' => $in));
    $fio = $stmt->fetch(PDO::FETCH_ASSOC);

return $fio['value'];

}

function calculate_age($birthday) {
  $birthday_timestamp = strtotime($birthday);
  $age = date('Y') - date('Y', $birthday_timestamp);
  if (date('md', $birthday_timestamp) > date('md')) {
    $age--;
  }
  return $age;
}
/*
function get_fio_user($in) {
    global $dbConnection;

    $stmt = $dbConnection->prepare('SELECT fio from users where id=:user_id LIMIT 1');
    $stmt->execute(array(':user_id' => $in));
			$fio = $stmt->fetch(PDO::FETCH_ASSOC);
			return $fio['fio'];	
}
*/
?>
