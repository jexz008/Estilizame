<?php
$username = (empty($_POST['login_mail']))?false:trim($_POST['login_mail']);
$password = (empty($_POST['login_password']))?false:trim($_POST['login_password']);


$verify = Login::signIn($username, $password);

if($verify) {
	echo "{'status': true,'url':'".TARGET."'}";
} else {
	echo "{'status': false}";
}
?>